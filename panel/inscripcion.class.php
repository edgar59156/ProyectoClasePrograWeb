<?php
require_once('sistema.class.php');

class Inscripcion extends Sistema
{
    // Declaración de una propiedad
    public $id_evento;
    public $evento;
    public $nombre;
    public $fecha_inicio;
    public $fecha_fin;
    public $conferencias;
    public $conferencistas;
    public $participantes;


    

    public function inscritos($id_conferencia_programacion){
        $this->connect();
        $sql="SELECT p.id_participante,p.nombre,p.apaterno,p.amaterno
         from participante p join inscripcion_participante ip on p.id_participante=ip.id_participante 
         JOIN conferencia_programacion cp on ip.id_conferencia_programacion= cp.id_conferencia_programacion 
         where cp.id_conferencia_programacion=:id_conferencia_programacion 
         order by p.apaterno,p.amaterno;";
        $stmt=$this->con->prepare($sql);
        $stmt->bindParam(':id_conferencia_programacion',$id_conferencia_programacion,PDO::PARAM_INT);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
    public function conferencias_en_evento($id_evento){
        $this->connect();
        $sql = "SELECT c.id_conferencia,c.titulo,c.sinopsis,c.imagen,c.id_ponente from conferencia c right join conferencia_programacion cp on c.id_conferencia=cp.id_conferencia WHERE cp.id_evento =:id_evento;";
        $stmt=$this->con->prepare($sql);
        $stmt->bindParam(':id_evento',$id_evento,PDO::PARAM_INT);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    public function eliminar($id_conferencia_programacion,$id_participante){
        $this->connect();
        $sql = "DELETE FROM inscripcion_participante 
        WHERE id_conferencia_programacion =:id_conferencia_programacion AND id_participante =:id_participante";
        $stmt=$this->con->prepare($sql);
        $stmt->bindParam(':id_conferencia_programacion',$id_conferencia_programacion,PDO::PARAM_INT);
        $stmt->bindParam(':id_participante',$id_participante,PDO::PARAM_INT);
        $rs = $stmt->execute();
        //$datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function eliminar_conferencia($id_conferencia,$id_evento){
        $this->connect();
        $sql = "DELETE FROM conferencia_programacion 
                WHERE id_evento =:id_evento AND id_conferencia =:id_conferencia";
        $stmt=$this->con->prepare($sql);
        $stmt->bindParam(':id_conferencia',$id_conferencia,PDO::PARAM_INT);
        $stmt->bindParam(':id_evento',$id_evento,PDO::PARAM_INT);
        $rs = $stmt->execute();
        //$datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function participantes_disponinbles(){
        $this->connect();
        $sql = "SELECT p.id_participante,p.nombre,p.apaterno,p.amaterno from participante p left join inscripcion_participante ip on p.id_participante=ip.id_participante where ip.id_participante is null order by p.apaterno,p.amaterno,p.nombre;";
        $stmt=$this->con->prepare($sql);
        $rs = $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
    public function conferencias_disponinbles(){
        $this->connect();
        $sql = "SELECT c.id_conferencia,c.titulo,c.sinopsis,c.imagen,c.id_ponente from conferencia c left join conferencia_programacion cp on c.id_conferencia=cp.id_conferencia WHERE cp.id_conferencia is null ;";
        $stmt=$this->con->prepare($sql);
        $rs = $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
  
  
    /**
     * Recuperar un arreglo de ponentes
     *
     * @return  arreglo
     */
    public function read()
    {
        $this->connect();
        $sql = "SELECT * from vw_evento";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    public function agregar($id_conferencia_programacion,$id_participante)
    {
        $this->connect();
        $sql = "INSERT INTO inscripcion_participante (id_conferencia_programacion,id_participante) values (:id_conferencia_programacion,:id_participante)";
        $stmt=$this->con->prepare($sql);
        $stmt->bindParam(':id_conferencia_programacion',$id_conferencia_programacion,PDO::PARAM_INT);
        $stmt->bindParam(':id_participante',$id_participante,PDO::PARAM_INT);
        $rs = $stmt->execute();
    }
    public function agregar_conferencia($id_evento,$id_conferencia,$datos)
    {
        $this->connect();
        $sql = "INSERT INTO conferencia_programacion (id_conferencia,id_evento,fecha,hora_inicio,hora_fin) values (:id_conferencia,:id_evento,:fecha,:hora_inicio,:hora_fin)";
        $stmt=$this->con->prepare($sql);
        $stmt->bindParam(':id_evento',$id_evento,PDO::PARAM_INT);
        $stmt->bindParam(':id_conferencia',$id_conferencia,PDO::PARAM_INT);
        $stmt->bindParam(':fecha', $datos['fecha'], PDO::PARAM_STR);
        $stmt->bindParam(':hora_inicio', $datos['hora_inicio'], PDO::PARAM_STR);
        $stmt->bindParam(':hora_fin', $datos['hora_fin'], PDO::PARAM_STR);
        $rs = $stmt->execute();
    }

    /**
     * Recuperar un ponente
     *@integar id_ponente
     * @return  self
     */
    public function readOne($id_ponente)
    {
        $this->connect();
        $sql = "SELECT *,p.id_ponente,concat(p.nombre,' ',p.primer_apellido) as nombre_completo,t.tipo,p.fotografia from ponente p inner join tipo t on p.id_tipo=t.id_tipo where p.id_ponente = :id_ponente";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_ponente', $id_ponente, PDO::PARAM_INT);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $datos=(isset($datos[0]))?$datos[0]:null;
        return $datos;
    }

    /**
     * Crear un ponente e insertarlo en la base de datos
     *
     * @return  boolean
     */
    public function create($datos)
    {
        $this->connect();
        $archivo = $this->cargarImagen("fotografia", "image/ponentes/");
        if (is_null($archivo)) {
            $sql = "INSERT into ponente (nombre,primer_apellido,segundo_apellido,tratamiento,correo,resumen,id_tipo) values (:nombre,:primer_apellido,:segundo_apellido,:tratamiento,:correo,:resumen,:id_tipo)";
        } else {
            $sql = "INSERT into ponente (nombre,primer_apellido,segundo_apellido,tratamiento,correo,resumen,id_tipo,fotografia) values (:nombre,:primer_apellido,:segundo_apellido,:tratamiento,:correo,:resumen,:id_tipo,:fotografia)";
        }
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_tipo', $datos['id_tipo'], PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
        $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
        $stmt->bindParam(':tratamiento', $datos['tratamiento'], PDO::PARAM_STR);
        $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
        $stmt->bindParam(':resumen', $datos['resumen'], PDO::PARAM_STR);
        if (!is_null($archivo)) {
            $stmt->bindParam(':fotografia', $archivo, PDO::PARAM_STR);
        }

        $rs = $stmt->execute();
        return $rs;
    }

    /**
     * Modificar los datos de un poenente
     *
     * @return  boolean
     */
    public function update($datos, $id_ponente)
    {
        $this->connect();
        $archivo = $this->cargarImagen("fotografia", "image/ponentes/");
        if (is_null($archivo)) {
        $sql = "UPDATE ponente set nombre=:nombre ,primer_apellido=:primer_apellido ,segundo_apellido=:segundo_apellido ,
                                  tratamiento=:tratamiento ,correo=:correo ,resumen=:resumen ,id_tipo=:id_tipo
                                  where id_ponente=:id_ponente";
        }else {
            $sql = "UPDATE ponente set nombre=:nombre ,primer_apellido=:primer_apellido ,segundo_apellido=:segundo_apellido ,
                                  tratamiento=:tratamiento ,correo=:correo ,resumen=:resumen ,id_tipo=:id_tipo, fotografia=:fotografia
                                  where id_ponente=:id_ponente";
        }
                                  
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':primer_apellido', $datos['primer_apellido'], PDO::PARAM_STR);
        $stmt->bindParam(':segundo_apellido', $datos['segundo_apellido'], PDO::PARAM_STR);
        $stmt->bindParam(':tratamiento', $datos['tratamiento'], PDO::PARAM_STR);
        $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
        $stmt->bindParam(':resumen', $datos['resumen'], PDO::PARAM_STR);
        $stmt->bindParam(':id_tipo', $datos['id_tipo'], PDO::PARAM_INT);
        $stmt->bindParam(':id_ponente', $id_ponente, PDO::PARAM_INT);
        
        if (!is_null($archivo)) {
            $stmt->bindParam(':fotografia', $archivo, PDO::PARAM_STR);
        }
        $rs = $stmt->execute();

        return $rs;
        // print_r ($rs);
        //die();


    }
    /**
     * Eliminar un ponente
     *
     * @return  boolean
     */
    public function delete($id_ponente)
    {
        $this->connect();
        $sql = "delete from ponente where id_ponente=:id_ponente";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_ponente', $id_ponente, PDO::PARAM_INT);
        $rs = $stmt->execute();
        return $stmt->rowCount();
    }

    /**
     * Get the value of id_evento
     */ 
    public function getId_evento()
    {
        return $this->id_evento;
    }

    /**
     * Set the value of id_evento
     *
     * @return  self
     */ 
    public function setId_evento($id_evento)
    {
        $this->id_evento = $id_evento;

        return $this;
    }

    /**
     * Get the value of evento
     */ 
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * Set the value of evento
     *
     * @return  self
     */ 
    public function setEvento($evento)
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of fecha_inicio
     */ 
    public function getFecha_inicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * Set the value of fecha_inicio
     *
     * @return  self
     */ 
    public function setFecha_inicio($fecha_inicio)
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    /**
     * Get the value of fecha_fin
     */ 
    public function getFecha_fin()
    {
        return $this->fecha_fin;
    }

    /**
     * Set the value of fecha_fin
     *
     * @return  self
     */ 
    public function setFecha_fin($fecha_fin)
    {
        $this->fecha_fin = $fecha_fin;

        return $this;
    }

    /**
     * Get the value of conferencias
     */ 
    public function getConferencias()
    {
        return $this->conferencias;
    }

    /**
     * Set the value of conferencias
     *
     * @return  self
     */ 
    public function setConferencias($conferencias)
    {
        $this->conferencias = $conferencias;

        return $this;
    }

    /**
     * Get the value of conferencistas
     */ 
    public function getConferencistas()
    {
        return $this->conferencistas;
    }

    /**
     * Set the value of conferencistas
     *
     * @return  self
     */ 
    public function setConferencistas($conferencistas)
    {
        $this->conferencistas = $conferencistas;

        return $this;
    }

    /**
     * Get the value of participantes
     */ 
    public function getParticipantes()
    {
        return $this->participantes;
    }

    /**
     * Set the value of participantes
     *
     * @return  self
     */ 
    public function setParticipantes($participantes)
    {
        $this->participantes = $participantes;

        return $this;
    }
}

$inscripcion = new Inscripcion;


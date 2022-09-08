<?php
require_once('sistema.class.php');

class Conferencia extends Sistema{
    public $id_conferencia;
    public $titulo;
    public $sinopsis;
    public $imagen;
    public $id_ponente;


    /**
     * Get the value of id_conferencia
     */ 
    public function getId_conferencia()
    {
        return $this->id_conferencia;
    }

    /**
     * Set the value of id_conferencia
     *
     * @return  self
     */ 
    public function setId_conferencia($id_conferencia)
    {
        $this->id_conferencia = $id_conferencia;

        return $this;
    }

    /**
     * Get the value of titulo
     */ 
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */ 
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of sinopsis
     */ 
    public function getSinopsis()
    {
        return $this->sinopsis;
    }

    /**
     * Set the value of sinopsis
     *
     * @return  self
     */ 
    public function setSinopsis($sinopsis)
    {
        $this->sinopsis = $sinopsis;

        return $this;
    }

    /**
     * Get the value of imagen
     */ 
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set the value of imagen
     *
     * @return  self
     */ 
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get the value of id_ponente
     */ 
    public function getId_ponente()
    {
        return $this->id_ponente;
    }

    /**
     * Set the value of id_ponente
     *
     * @return  self
     */ 
    public function setId_ponente($id_ponente)
    {
        $this->id_ponente = $id_ponente;

        return $this;
    }

      /**
     * Recuperar un arreglo de ponentes
     *
     * @return  arreglo
     */
    public function read()
    {
        $this->connect();
        $sql = "SELECT * from conferencia c inner join ponente p on c.id_ponente=p.id_ponente;";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    public function readEvento($id_evento)
    {
        $this->connect();
        $sql = "SELECT cp.id_evento,c.id_conferencia,c.titulo,cp.fecha,cp.hora_inicio,cp.hora_fin,cp.id_conferencia_programacion ,COUNT(DISTINCT ip.id_participante) as inscritos FROM conferencia_programacion cp JOIN conferencia c on cp.id_conferencia=c.id_conferencia JOIN inscripcion_participante ip on cp.id_conferencia_programacion=ip.id_conferencia_programacion WHERE cp.id_evento=:id_evento;";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
    /**
     * Recuperar un ponente
     *@integar id_ponente
     * @return  self
     */
    public function readOne($id_conferencia)
    {
        $this->connect();
        $sql = "SELECT * from conferencia c inner join ponente p on c.id_ponente=p.id_ponente where c.id_conferencia = :id_conferencia";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_conferencia', $id_conferencia, PDO::PARAM_INT);
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
        $archivo = $this->cargarImagen("imagen", "image/conferencia/");
        if (is_null($archivo)) {
            $sql = "INSERT into conferencia (titulo,sinopsis,id_ponente) values (:titulo,:sinopsis,:id_ponente)";
        } else {
            $sql = "INSERT into conferencia (titulo,sinopsis,imagen,id_ponente) values (:titulo,:sinopsis,:imagen,:id_ponente)";
        }
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':titulo', $datos['titulo'], PDO::PARAM_STR);
        $stmt->bindParam(':sinopsis', $datos['sinopsis'], PDO::PARAM_STR);
        $stmt->bindParam(':id_ponente', $datos['id_ponente'], PDO::PARAM_INT);
        if (!is_null($archivo)) {
            $stmt->bindParam(':imagen', $archivo, PDO::PARAM_STR);
        }
        $rs = $stmt->execute();
        return $rs;
    }

 /**
     * Modificar los datos de un poenente
     *
     * @return  boolean
     */
    public function update($datos, $id_conferencia)
    {
        $this->connect();
        $archivo = $this->cargarImagen("imagen", "image/conferencia/");
        if (is_null($archivo)) {
        $sql = "UPDATE conferencia set titulo=:titulo, sinopsis=:sinopsis, id_ponente=:id_ponente            
                                  where id_conferencia=:id_conferencia";
        }else {
            $sql = "UPDATE conferencia set titulo=:titulo ,sinopsis=:sinopsis ,id_ponente=:id_ponente,imagen=:imagen            
                                    where id_conferencia=:id_conferencia";
        }
                                  
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':titulo', $datos['titulo'], PDO::PARAM_STR);
        $stmt->bindParam(':sinopsis', $datos['sinopsis'], PDO::PARAM_STR);
        $stmt->bindParam(':id_ponente', $datos['id_ponente'], PDO::PARAM_INT);
        $stmt->bindParam(':id_conferencia', $id_conferencia, PDO::PARAM_INT);
        
        if (!is_null($archivo)) {
            $stmt->bindParam(':imagen', $archivo, PDO::PARAM_STR);
        }
        $rs = $stmt->execute();
       
        return $rs;
       
    }

    public function delete($id_conferencia)
    {
        $this->connect();
        $sql = "delete from conferencia where id_conferencia=:id_conferencia";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_conferencia', $id_conferencia, PDO::PARAM_INT);
        $rs = $stmt->execute();
        return $stmt->rowCount();
    }

}
$conferencia = new Conferencia;

<?php
require_once ('sistema.class.php');

class Ponente extends Sistema
{
    // Declaración de una propiedad
    public $id_ponente;
    public $id_tipo;
    public $nombre;
    public $primer_apellido;
    public $segundo_apellido;
    public $tratamiento;
    public $correo;
    public $fotografia;
    public $resumen;
/*
public function getId_Ponente()
{
    return $this->id_ponente;
}

    public function setId_Ponente($id_ponente)
    {
$this->id_ponente = $id_ponente;
    

}
*/



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
     * Get the value of id_tipo
     */ 
    public function getId_tipo()
    {
        return $this->id_tipo;
    }

    /**
     * Set the value of id_tipo
     *
     * @return  self
     */ 
    public function setId_tipo($id_tipo)
    {
        $this->id_tipo = $id_tipo;

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
     * Get the value of primer_apellido
     */ 
    public function getPrimer_apellido()
    {
        return $this->primer_apellido;
    }

    /**
     * Set the value of primer_apellido
     *
     * @return  self
     */ 
    public function setPrimer_apellido($primer_apellido)
    {
        $this->primer_apellido = $primer_apellido;

        return $this;
    }

    /**
     * Get the value of segundo_apellido
     */ 
    public function getSegundo_apellido()
    {
        return $this->segundo_apellido;
    }

    /**
     * Set the value of segundo_apellido
     *
     * @return  self
     */ 
    public function setSegundo_apellido($segundo_apellido)
    {
        $this->segundo_apellido = $segundo_apellido;

        return $this;
    }

    /**
     * Get the value of tratamiento
     */ 
    public function getTratamiento()
    {
        return $this->tratamiento;
    }

    /**
     * Set the value of tratamiento
     *
     * @return  self
     */ 
    public function setTratamiento($tratamiento)
    {
        $this->tratamiento = $tratamiento;

        return $this;
    }

    /**
     * Get the value of correo
     */ 
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */ 
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of fotografia
     */ 
    public function getFotografia()
    {
        return $this->fotografia;
    }

    /**
     * Set the value of fotografia
     *
     * @return  self
     */ 
    public function setFotografia($fotografia)
    {
        $this->fotografia = $fotografia;

        return $this;
    }

    /**
     * Get the value of resumen
     */ 
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Set the value of resumen
     *
     * @return  self
     */ 
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;

        return $this;
    }

     /**
     * Recuperar un arreglo de ponentes
     *
     * @return  arreglo
     */ 
    public function read(){
        $this->connect();
        $sql = "SELECT p.id_ponente,concat(p.nombre,' ',p.primer_apellido) as nombre,t.tipo,p.fotografia from ponente p inner join tipo t on p.id_tipo=t.id_tipo;";
        $stmt = $this->con->prepare($sql);
        $stmt -> execute();
        //$rs = $this->query($sql);

        //$datos = $rs->fetch_all(MYSQLI_ASSOC);
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datos;

    }

    /**
     * Recuperar un ponente
     *@integar id_ponente
     * @return  self
     */ 
    public function readOne($id_ponente){
        $this->connect();
        $sql="SELECT *,p.id_ponente,concat(p.nombre,' ',p.primer_apellido) as nombre_completo,t.tipo,p.fotografia from ponente p inner join tipo t on p.id_tipo=t.id_tipo where p.id_ponente = :id_ponente";
        
        $stmt=$this->con->prepare($sql);
        $stmt->bindParam(':id_ponente',$id_ponente,PDO::PARAM_INT);

        $stmt->execute();


        
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $datos = $datos[0];
        return $datos;
    }

    /**
     * Crear un ponente e insertarlo en la base de datos
     *
     * @return  boolean
     */ 
    public function create($datos){
        $this->connect();
        $archivo = $this->cargarImagen("fotografia","image/ponentes/");
        $sql="INSERT into ponente (nombre,primer_apellido,segundo_apellido,tratamiento,correo,resumen,id_tipo) values (:nombre,:primer_apellido,:segundo_apellido,:tratamiento,:correo,:resumen,:id_tipo)";
        $stmt=$this->con->prepare($sql);
        $stmt->bindParam(':id_tipo',$datos['id_tipo'],PDO::PARAM_INT);
        $stmt->bindParam(':nombre',$datos['nombre'],PDO::PARAM_STR);
        $stmt->bindParam(':primer_apellido',$datos['primer_apellido'],PDO::PARAM_STR);
        $stmt->bindParam(':segundo_apellido',$datos['segundo_apellido'],PDO::PARAM_STR);
        $stmt->bindParam(':tratamiento',$datos['tratamiento'],PDO::PARAM_STR);
        $stmt->bindParam(':correo',$datos['correo'],PDO::PARAM_STR);
        $stmt->bindParam(':resumen',$datos['resumen'],PDO::PARAM_STR);
        $rs = $stmt->execute();
        return $rs;
}
    
    /**
     * Modificar los datos de un poenente
     *
     * @return  boolean
     */ 
    public function update($datos,$id_ponente){
        $this->connect();

        $sql="UPDATE ponente set nombre=:nombre ,primer_apellido=:primer_apellido ,segundo_apellido=:segundo_apellido ,
                                  tratamiento=:tratamiento ,correo=:correo ,resumen=:resumen ,id_tipo=:id_tipo
                                  where id_ponente=:id_ponente";
        $stmt=$this->con->prepare($sql);
        $stmt->bindParam(':nombre',$datos['nombre'],PDO::PARAM_STR);
        $stmt->bindParam(':primer_apellido',$datos['primer_apellido'],PDO::PARAM_STR);
        $stmt->bindParam(':segundo_apellido',$datos['segundo_apellido'],PDO::PARAM_STR);
        $stmt->bindParam(':tratamiento',$datos['tratamiento'],PDO::PARAM_STR);
        $stmt->bindParam(':correo',$datos['correo'],PDO::PARAM_STR);
        $stmt->bindParam(':resumen',$datos['resumen'],PDO::PARAM_STR);
        $stmt->bindParam(':id_tipo',$datos['id_tipo'],PDO::PARAM_INT);
        $stmt->bindParam(':id_ponente',$id_ponente,PDO::PARAM_INT);
        //die($sql);

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
    public function delete($id_ponente){
        $this->connect();
        $sql = "delete from ponente where id_ponente=:id_ponente";
        $stmt=$this->con->prepare($sql);
        $stmt->bindParam(':id_ponente',$id_ponente,PDO::PARAM_INT);
        $rs = $stmt->execute();
        return $rs;
}

}

$ponente = new Ponente;

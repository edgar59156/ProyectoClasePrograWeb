<?php
    require_once('sistema.class.php');

    class Rol extends Sistema{
        public $id_rol;
        public $rol;
    
        
   


     /**
     * Recuperar un arreglo de ponentes
     *
     * @return  arreglo
     */
    public function read()
    {
        $this->connect();
        $sql = "SELECT  *  from rol";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    /**
     * Recuperar un ponente
     *@integar id_ponente
     * @return  self
     */
    public function readOne($id_rol)
    {
        $this->connect();
        $sql = "SELECT id_rol,rol from rol where id_rol = :id_rol";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
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
        $sql = "INSERT into rol (rol) values (:rol)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':rol', $datos['rol'], PDO::PARAM_STR);
        $rs = $stmt->execute();
        return $rs;
    }

    /**
     * Modificar los datos de un poenente
     *
     * @return  boolean
     */
    public function update($datos, $id_rol)
    {
        $this->connect();
    
            $sql = "UPDATE rol set rol=:rol
            where id_rol=:id_rol";
        
                                  
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':rol', $datos['rol'], PDO::PARAM_STR);
        $stmt->bindParam(':id_rol', $datos, PDO::PARAM_INT);
        
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
    public function delete($id_rol)
    {
        $this->connect();
        $sql = "DELETE from rol where id_rol=:id_rol";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $rs = $stmt->execute();
        return $stmt->rowCount();
    }






        /**
         * Get the value of rol
         */ 
        public function getRol()
        {
                return $this->rol;
        }

        /**
         * Set the value of rol
         *
         * @return  self
         */ 
        public function setRol($rol)
        {
                $this->rol = $rol;

                return $this;
        }

        /**
         * Get the value of id_rol
         */ 
        public function getId_rol()
        {
                return $this->id_rol;
        }

        /**
         * Set the value of id_rol
         *
         * @return  self
         */ 
        public function setId_rol($id_rol)
        {
                $this->id_rol = $id_rol;

                return $this;
        }
    }

$rol = new Rol;

?>
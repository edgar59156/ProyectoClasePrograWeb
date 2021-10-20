<?php
require_once('C:\xampp\htdocs\ProyectoClase\panel\sistema.class.php');
require_once('usuario_rol.class.php');




class Usuario extends Sistema
{

    public $id_usuario;
    public $correo;
    public $contrasena;




    /**
     * Recuperar un arreglo de ponentes
     *
     * @return  arreglo
     */
    public function read()
    {
        $this->connect();
        $sql = "SELECT  *  from usuario";
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
    public function readOne($id_usuario)
    {
        $this->connect();
        $sql = "SELECT id_usuario,correo,contrasena  from usuario where id_usuario = :id_usuario";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $datos = (isset($datos[0])) ? $datos[0] : null;
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
        $sql = "INSERT into usuario (correo,contrasena) values (:correo,:contrasena)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
        $datos['contrasena'] = md5($datos['contrasena']);
        $stmt->bindParam(':contrasena', $datos['contrasena'], PDO::PARAM_STR);
        $rs = $stmt->execute();
        return $rs;
    }

    /**
     * Modificar los datos de un poenente
     *
     * @return  boolean
     */
    public function update($datos, $id_usuario)
    {
        require_once('usuario_rol.class.php');
        $usuarioRol = new UsuarioRol;

        $this->connect();
        $rs = $usuarioRol->delete($id_usuario);
        if (isset($datos['roles'])) {
            foreach ($datos['roles'] as $key => $value) {
                $usuarioRol->create($id_usuario, $value);
            }
        }
        $sql = "UPDATE usuario set correo=:correo where id_usuario=:id_usuario";
        if (strlen($datos['contrasena']) > 0) {
            $sql = "UPDATE usuario set correo=:correo, contrasena=:contrasena where id_usuario=:id_usuario";
        }
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':correo', $datos['correo'], PDO::PARAM_STR);
        if (strlen($datos['contrasena']) > 0) {
            $datos['contrasena'] = md5($datos['contrasena']);
            $stmt->bindParam(':contrasena', $datos['contrasena'], PDO::PARAM_STR);
        }
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->rowCount();
    }


    /**
     * Eliminar un ponente
     *
     * @return  boolean
     */
    public function delete($id_usuario)
    {
        $this->connect();
        $sql = "delete from usuario where id_usuario=:id_usuario";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $rs = $stmt->execute();
        return $stmt->rowCount();
    }

    public function credentials($correo){
        $_SESSION['correo'] = $correo;
        $this -> connect();
        $sql = "SELECT r.rol from rol r inner join usuario_rol u on r.id_rol=u.id_rol INNER JOIN usuario us on u.id_usuario= us.id_usuario where us.correo=:correo";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();
        $datos = array();
        $_SESSION['roles'] = array();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($datos as $key => $value){
            array_push($_SESSION['roles'],$value['rol']);
        }
        $_SESSION['validado'] = true;
        
  
    }
    /**
     * Get the value of contrasena
     */
    public function getContrasena()
    {
        return $this->contrasena;
    }

    /**
     * Set the value of contrasena
     *
     * @return  self
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;

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
     * Get the value of id_usuario
     */
    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    /**
     * Set the value of id_usuario
     *
     * @return  self
     */
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;

        return $this;
    }
}
$usuario = new Usuario;

<?php 
require_once('sistema.class.php');
class UsuarioRol extends Sistema {

  public  function create($id_usuario,$id_rol){
        $this->connect();
        $sql = "INSERT into usuario_rol (id_usuario,id_rol) values (:id_usuario,:id_rol)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $rs = $stmt->execute();
        return $rs;
    }

    public function delete($id_usuario){
        $this->connect();
        $sql = "DELETE from usuario_rol WHERE id_usuario=:id_usuario";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $rs = $stmt->execute();
        return $rs;
    }

    public function read($id_usuario){
        $this->connect();
        $sql = "SELECT id_rol from usuario_rol WHERE id_usuario=:id_usuario";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    public function rolesUsuario($id_usuario){
        $datos = $this -> read($id_usuario);
        $roles = array();
        foreach ($datos as $key => $value){
            array_push($roles,$value['id_rol']);    
        }
        return $roles;
    }

}
$usuarioRol = new UsuarioRol;

?>
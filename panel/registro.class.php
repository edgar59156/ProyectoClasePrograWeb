<?php 
    require_once('sistema.class.php');

    Class Registro extends Sistema{

        public function register($datos){
            if($this->validarCorreo($datos['correo'])){
                if(isset($datos['nombre']) && isset($datos['contrasena'])){
                    $this->connect();
                    $this->con->beginTransaction();

                    try{
                        $sql = "INSERT into usuario (correo,contrasena) values (:correo, :contrasena)";
                        $stmt = $this->con->prepare($sql);
                        $datos['contrasena'] = md5($datos['contrasena']);
                        $stmt->bindParam(':correo', $datos['correo'],PDO::PARAM_STR);
                        $stmt->bindParam(':contrasena', $datos['contrasena'],PDO::PARAM_STR);
                        $rs = $stmt -> execute();
                        if($stmt->rowcount()>0){
                            $sql = "SELECT * from usuario where correo = :correo";
                            $stmt = $this->con->prepare($sql);
                            $stmt->bindParam(':correo', $datos['correo'],PDO::PARAM_STR);
                            $rs = $stmt -> execute();
                            $usuario = $stmt -> fetchAll(PDO::FETCH_ASSOC);
                            $sql = "INSERT into usuario_rol(id_usuario, id_rol) values (:id_usuario,2) , (:id_usuario,6 )";
                            $stmt = $this->con->prepare($sql);
                            $stmt -> bindParam(':id_usuario',$usuario[0]['id_usuario'],PDO::PARAM_INT);
                            $stmt -> execute();
                            if($stmt->rowcount()>1){
                                $sql = "INSERT into participante (nombre, apaterno, amaterno, id_tipo, id_usuario) 
                                values (:nombre, :apaterno, :amaterno, 6, :id_usuario)";
                                $stmt = $this->con->prepare($sql);
                                $stmt ->bindParam(':nombre', $datos['nombre'],PDO::PARAM_STR);
                                $stmt ->bindParam(':apaterno', $datos['apaterno'],PDO::PARAM_STR);
                                $stmt ->bindParam(':amaterno', $datos['amaterno'],PDO::PARAM_STR);
                                $stmt ->bindParam(':id_usuario', $usuario[0]['id_usuario'],PDO::PARAM_INT);
                               
                                $rs = $stmt-> execute();
                                if($stmt->rowcount()>0){
                                    $this->sendMail($datos['correo'],"Bienvenido al congreso","Bienvenodp al congreso y demas cosas");
                                    $this->con->commit();
                                    return true;
                                }
                            }
                            
                        }   
                    }catch(Exception $e){
                        $this->con->rollback();
                        return false;
                    }
                }
            }
            return false;
        }
    }
$registro = New Registro;
?>
<?php
session_start();
class Sistema
{
    public $con;

    public function connect()
    {
        $dbDriver = "mysql";
        $dbHost = "localhost";
        $db = "congreso";
        $dbUser = "congreso";
        $dbPass = "123";
        // $this->con = new mysqli($dbHost, $dbUser, $dbPass, $db);

        $this->con = new PDO($dbDriver . ':host=' . $dbHost . ';dbname=' . $db, $dbUser, $dbPass);
    }

    public function query($sql)
    {
        $this->connect();
        $rs = $this->con->query($sql);
        return $rs;
    }
    
    public function cargarImagen($dimension, $destino)
    {
        if ($_FILES[$dimension]['error'] == 0) {
            $tiposPermitidos = array("image/gif", "image/jpeg", "image/png");
            if (in_array($_FILES[$dimension]['type'], $tiposPermitidos)) {
                if ($_FILES[$dimension]['size'] <= 512000) {
                    $nombre = md5(time());
                    $extension = explode("/", $_FILES[$dimension]['type']);
                    $nombre = $nombre . "." . $extension[1];
                    $destino = $destino . $nombre;
                    if (move_uploaded_file($_FILES[$dimension]['tmp_name'], $destino)) {
                        return $nombre;
                    }
                }
            }
        }
        return null;
    }


    public function mensaje($tipo,$texto){
        switch($tipo){
            case '1':
                $color = "success";
                break;
            case '0':
                $color = "danger";
                break;   
            default:
             $color = "dark";
             break;
    }
    require_once("views/mensaje.php");
  }

  public function login($correo,$contrasena){
    $this->connect();
    
    if($this->validarCorreo($correo)){
        $contrasena = md5($contrasena);
        $sql = "SELECT * FROM usuario where correo=:correo and contrasena=:contrasena";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(isset($datos[0])){
            return true;
        }
        return false;
    }
    
  }
  public function validarCorreo($correo){
    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return false;
  }

 public function logout(){
     unset($_SESSION);
     session_destroy();
 }
 public function validarRol($rol){
    $roles=array();
    if (isset($_SESSION['roles'])) {
        $roles=$_SESSION['roles'];
    }
    if (!in_array($rol,$roles)){
        require_once('views/header.php');
        $this->mensaje(0,"Usted no tiene el rol necesario, consulte al administrador");
        require_once('views/footer.php');
        die();
    }
}

}
$sistema = new Sistema;
?>
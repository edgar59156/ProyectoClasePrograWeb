<?php
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
    include("views/mensaje.php");
  }
}
?>
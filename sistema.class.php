<?php
class Sistema{
    public $con;

    public function connect (){
        $dbDriver = "mysql";
        $dbHost = "localhost";
        $db = "congreso";
        $dbUser = "congreso";
        $dbPass = "123";
       // $this->con = new mysqli($dbHost, $dbUser, $dbPass, $db);
    
       $this->con = new PDO($dbDriver.':host='.$dbHost.';dbname='.$db, $dbUser, $dbPass);
       
    }

    public function query($sql){
        $this->connect();
        $rs = $this->con->query($sql);
        return $rs;
    }
    public function cargarImagen($dimension,$destino)
    {
        if(move_uploaded_file($_FILES[$dimension]['tmp_name'],$destino.$_FILES[$dimension]['name']))
        {
            return $_FILES[$dimension]['name'];
        }
        return null;
    }
  }
?>
<?php
class Sistema{
    public $con;

    public function connect (){
        $dbHost = "localhost";
        $db = "congreso";
        $dbUser = "congreso";
        $dbPass = "123";
        $this->con = new mysqli($dbHost, $dbUser, $dbPass, $db);

    }

    public function query($sql){
        $this->connect();
        $rs = $this->con->query($sql);
        return $rs;
    }
            }
?>
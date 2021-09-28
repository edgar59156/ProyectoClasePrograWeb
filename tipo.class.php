<?php
require_once('sistema.class.php');
class Tipo extends Sistema{
    public function read(){
        $sql = "SELECT * from tipo;";
        $rs = $this->query($sql);

        $datos = $rs->fetch_all(MYSQLI_ASSOC);
        return $datos;
    }
    public function readOne(){

    }
    public function create(){

    }
    public function update(){

    }
    public function delete(){

    }
}
$tipo = new Tipo;
?>
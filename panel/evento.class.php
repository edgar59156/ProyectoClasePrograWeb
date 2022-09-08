<?php
require_once('sistema.class.php');

class Evento extends Sistema
{
    public function nuevoEvento($datos){
        
        $this->connect();
        $sql="INSERT INTO evento (evento,fecha_inicio,fecha_fin) values (:evento,:fecha_inicio,:fecha_fin)";
        $stmt=$this->con->prepare($sql);
        $stmt->bindParam(':evento',$datos['evento'],PDO::PARAM_STR);
        $stmt->bindParam(':fecha_inicio',$datos['fecha_inicio'],PDO::PARAM_STR);
        $stmt->bindParam(':fecha_fin',$datos['fecha_fin'],PDO::PARAM_STR);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }
    public function readOne($id_evento)
    {
        $this->connect();
        $sql = "SELECT * from evento where id_evento=:id_evento";
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $datos=(isset($datos[0]))?$datos[0]:null;
        return $datos;
    }
}
$evento = new Evento;
<?php
require_once('inscripcion.class.php');
require_once('conferencia.class.php');
require_once('evento.class.php');

$accion = null;
if (isset($_GET['accion'])) {
    $id_evento = isset($_GET['id_evento']) ? $_GET['id_evento'] : null;
    $accion = $_GET['accion'];
}
require_once('views/header.php');
switch($accion){
    case 'read':
        $datos = $inscripcion ->read();
        require_once('views/inscipcion/index.php');
        break;

    case 'inscribir':
        $datos = $conferencia -> readEvento($id_evento);
        require_once('views/inscripcion/inscribir.php');
        break;

    case 'participante':
       
        $id_conferencia = $_GET['id_conferencia'];
        $id_conferencia_programacion = $_GET['id_conferencia_programacion'];
        $accion_participante=null;
        if (isset($_GET['accion_participante'])) {
            $id_participante = isset($_GET['id_participante']) ? $_GET['id_participante'] : null;
            $accion_participante = $_GET['accion_participante'];
        }
        switch ($accion_participante){
            
            case 'eliminar':
                $inscripcion -> eliminar($id_conferencia_programacion,$id_participante);
                break;
            case 'agregar':
                $inscripcion -> agregar($id_conferencia_programacion,$id_participante); 
                break;
        }
        $datos = $conferencia->readEvento($id_evento);
        $inscritos = $inscripcion->inscritos($id_conferencia_programacion);
        $conferencias = $conferencia->readOne($id_conferencia);
        $participantes_disponibles = $inscripcion->participantes_disponinbles();
        require_once('views/inscripcion/participante.php');
        break;

    case 'nuevaConferencia':
        
        //$id_conferencia_programacion = $_GET['id_conferencia_programacion'];
        //$id_evento = $_GET['id_conferencia'];
        
        $accion_conferencia=null;
        if (isset($_GET['accion_conferencia'])) {
            $id_conferencia = isset($_GET['id_conferencia']) ? $_GET['id_conferencia'] : null;
            $accion_conferencia = $_GET['accion_conferencia'];
        }
        switch ($accion_conferencia){
            
            case 'eliminar':
                //echo ($id_conferencia);
                //echo($id_evento);
                $inscripcion -> eliminar_conferencia($id_conferencia,$id_evento);
                break;
            case 'agregar':
                //echo('evento: '."".$id_evento);
                //print_r($_GET);
                $datos = $_GET;
                $inscripcion -> agregar_conferencia($id_evento,$id_conferencia,$datos); 
                break;
        }
        $datosEvento = $evento->readOne($id_evento);
        $conferencias_disponibles = $inscripcion->conferencias_disponinbles();
        $conferencias_en_evento = $inscripcion->conferencias_en_evento($id_evento);
        require_once('views/inscripcion/conferencia.php');
        break;

    

    default:
    $datos = $inscripcion -> read();
    require_once('views/inscripcion/index.php');
}
require_once('views/footer.php');

?>
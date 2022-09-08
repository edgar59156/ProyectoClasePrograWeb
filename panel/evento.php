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

    case 'nuevoEvento':
        require_once('views/evento/form.php');
        break;

    case 'addEvento':
        $datos = $_POST;
        $evento -> nuevoEvento($datos);
        
        $datos = $inscripcion -> read();
        $datos=$inscripcion->read();
        require_once('views/inscripcion/index.php');
        break;

    default:
    $datos = $inscripcion -> read();
    require_once('views/inscripcion/index.php');
}
require_once('views/footer.php');

?>
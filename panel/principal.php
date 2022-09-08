<?php
require_once('ponente.class.php');
//require_once('tipo.class.php');
//$sistema->validarRol('Usuario');
$id_ponente = null;
$accion = null;
if (isset($_GET['accion'])) {
    $id_ponente = isset($_GET['id_ponente']) ? $_GET['id_ponente'] : null;
    $accion = $_GET['accion'];
}

require_once('views/headersinmenu.php');

switch ($accion) {

    default:
        $datos = $ponentes->read();
        print_r($datos);
        require_once('views/index/principal1.php');
}
require_once('views/footer.php');
?>
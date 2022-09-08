<?php

require_once('registro.class.php');
$accion = NULL;
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
}

require_once('views\headersinmenu.php');

switch ($accion) {
    case 'register':
        $datos = $_POST;
        print_r($datos);
        if($registro->register($datos)){
            $sistema->mensaje(1,"Se ha registrado al participante");
            require_once('./views/login/login.php');
        }else{
            $sistema->mensaje(0,"Ocurrio un error");
        }
        break;

        default:
    require_once('./views/registro/form.php');

}

require_once('views/footer.php');

?>
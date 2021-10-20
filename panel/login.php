<?php
require_once('usuario.class.php');

$accion = null;
if (isset($_GET['accion'])) {
    $accion = $_GET['accion'];
}
require_once('views/headersinmenu.php');
switch($accion){
    case 'recovery':
        require_once('views/login/recuperacion.php');
        break;

    case 'change':
        require_once('views/login/cambio.php');
        break;
    case 'login':
        $datos=$_POST;
        
        if( $usuario ->login($datos['correo'],$datos['contrasena'])){
                $usuario->credentials($datos['correo']);
                header('Location: inicio.php');
        }else{
            $sistema->mensaje(0,"Usuario y contraseña invalido");
            $sistema -> logout();
            require_once('views/login/login.php');
        }
        break;
            
    case 'logout':
        $sistema->mensaje(1,"Se ha cerrado la sesion");
        $sistema -> logout();
        require_once('views/login/login.php');
        break;   

    default:
    require_once('views/login/login.php');
}
require_once('views/footer.php');

?>
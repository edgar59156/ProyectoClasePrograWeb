<?php
require_once('sistema.class.php');
require_once('usuario.class.php');
require_once('rol.class.php');
$sistema->validarRol('Administrador');
$id_usuario = null;
$accion = null;
if (isset($_GET['accion'])) {
    $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null;
    $accion = $_GET['accion'];
}

require_once('views\header.php');

switch ($accion) {
    case 'readOne':
        $datos = $usuario->readOne($id_usuario);
        if(is_array($datos))
        {
        require_once('views/usuario/index.php');
        }
        else{
        $usuario->mensaje(0,"Ocurrió un error, la usuario no exixte.");
        $datos = $usuario->read();
        require_once('views/usuario/index.php');
        }
        break;

    case 'new':
            require_once('views/usuario/form.php');       
        break;

    case 'add':
        $datos = $_POST;
        $resultado = $usuario->create($datos);
        $usuario->mensaje($resultado,($resultado)?"La usuario se agrego correctamente":"Ocurrió un error");
        $datos = $usuario->read();
            require_once('views/usuario/index.php');
        break;

    case 'modify':
        
        $datos = $usuario->readOne($id_usuario);
        $datos_roles = $rol ->read();
        $datos_usuario_rol = $usuarioRol->rolesUsuario($id_usuario);
        if(is_array($datos))
        {
        require_once('views/usuario/form.php');
        }
        else{
        $usuario->mensaje(0,"Ocurrió un error, la usuario no exixte.");
        $datos = $usuario->read();
            require_once('views/usuario/index.php');
        }
        break;

    case 'update':
        $datos = $_POST;
        $resultado = $usuario->update($datos, $id_usuario);
        $usuario->mensaje($resultado,($resultado)?"La usuario se actualizo correctamente":"Ocurrió un error");
        $datos = $usuario->read();
            require_once('views/usuario/index.php');
        break;

    case 'delete':
        $resultado = $usuario->delete($id_usuario);
        $usuario->mensaje($resultado,($resultado)?"La usuario se eliminó correctamente":"Ocurrió un error");

    default:
        $datos = $usuario->read();
        
        require_once('views/usuario/index.php');
}
require_once('views/footer.php');
?>
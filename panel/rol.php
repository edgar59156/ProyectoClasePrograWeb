<?php

require_once('sistema.class.php');
$sistema->validarRol('Administrador');
require_once('rol.class.php');

$id_rol = null;
$accion = null;
if (isset($_GET['accion'])) {
    $id_rol = isset($_GET['id_rol']) ? $_GET['id_rol'] : null;
    $accion = $_GET['accion'];
}

require_once('views\header.php');

switch ($accion) {
    case 'readOne':
        $datos = $rol->readOne($id_rol);
        if(is_array($datos))
        {
        require_once('views/rol/index.php');
        }
        else{
        $rol->mensaje(0,"Ocurrió un error, la rol no exixte.");
        $datos = $rol->read();
        require_once('views/rol/index.php');
        }
        break;

    case 'new':
            require_once('views/rol/form.php');       
        break;

    case 'add':
        $datos = $_POST;
        $resultado = $rol->create($datos);
        $rol->mensaje($resultado,($resultado)?"La rol se agrego correctamente":"Ocurrió un error");
        $datos = $rol->read();
            require_once('views/rol/index.php');
        break;

    case 'modify':
        $datos = $rol->readOne($id_rol);
    
        if(is_array($datos))
        {
        require_once('views/rol/form.php');
        }
        else{
        $rol->mensaje(0,"Ocurrió un error, la rol no exixte.");
        $datos = $rol->read();
            require_once('views/rol/index.php');
        }
        break;

    case 'update':
        $datos = $_POST;
        $resultado = $rol->update($datos, $id_rol);
        $rol->mensaje($resultado,($resultado)?"La rol se actualizo correctamente":"Ocurrió un error");
        $datos = $rol->read();
            require_once('views/rol/index.php');
        break;

    case 'delete':
        $resultado = $rol->delete($id_rol);
        $rol->mensaje($resultado,($resultado)?"La rol se eliminó correctamente":"Ocurrió un error");

    default:
        $datos = $rol->read();
        
        require_once('views/rol/index.php');
}
require_once('views/footer.php');
?>
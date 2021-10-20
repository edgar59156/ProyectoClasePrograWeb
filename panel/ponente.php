<?php
require_once('ponente.class.php');
require_once('tipo.class.php');
$sistema->validarRol('Usuario');
$id_ponente = null;
$accion = null;
if (isset($_GET['accion'])) {
    $id_ponente = isset($_GET['id_ponente']) ? $_GET['id_ponente'] : null;
    $accion = $_GET['accion'];
}

require_once('views/header.php');

switch ($accion) {
    case 'readOne':
        $datos = $ponente->readOne($id_ponente);
        if(is_array($datos))
        {
        require_once('views/ponente/index.php');
        }
        else{
        $ponente->mensaje(0,"Ocurrió un error, el ponente no exixte.");
        $datos = $ponente->read();
        require_once('views/ponente/index.php');
        }
        break;

    case 'new':
        $sistema->validarRol('Administrador');
        $datostipo = $tipo->read();
        require_once('views/ponente/form.php');
        break;

    case 'add':
        $sistema->validarRol('Administrador');
        $datos = $_POST;
        $resultado = $ponente->create($datos);
        //echo $resultado;
        $ponente->mensaje($resultado,($resultado)?"El ponente se agrego correctamente":"Ocurrió un error");
        $datos = $ponente->read();
        require_once('views/ponente/index.php');
        break;

    case 'modify':
        $datos = $ponente->readOne($id_ponente);
        $datostipo = $tipo->read();

        if(is_array($datos))
        {
        require_once('views/ponente/form.php');
        }
        else{
        $ponente->mensaje(0,"Ocurrió un error, el ponente no exixte.");
        $datos = $ponente->read();
        require_once('views/ponente/index.php');
        }
        break;

    case 'update':
        $sistema->validarRol('Administrador');
        $datos = $_POST;
        $resultado = $ponente->update($datos, $id_ponente);
        // echo $resultado;
        $ponente->mensaje($resultado,($resultado)?"El ponente se actualizo correctamente":"Ocurrió un error");
        $datos = $ponente->read();
        require_once('views/ponente/index.php');
        break;

    case 'delete':
        $sistema->validarRol('Administrador');
        $resultado = $ponente->delete($id_ponente);
        $ponente->mensaje($resultado,($resultado)?"El ponente se eliminó correctamente":"Ocurrió un error");

    default:
        $datos = $ponente->read();
        require_once('views/ponente/index.php');
}
require_once('views/footer.php');
?>
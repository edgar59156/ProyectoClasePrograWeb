<?php
require_once('ponente.class.php');
require_once('tipo.class.php');
$id_ponente = null;
$accion = null;
if (isset($_GET['accion'])) {
    $id_ponente = isset($_GET['id_ponente']) ? $_GET['id_ponente'] : null;
    $accion = $_GET['accion'];
}

include('views/header.php');

switch ($accion) {
    case 'readOne':
        $datos = $ponente->readOne($id_ponente);
        if(is_array($datos))
        {
        include('views/ponente/index.php');
        }
        else{
        $ponente->mensaje(0,"Ocurrió un error, el ponente no exixte.");
        $datos = $ponente->read();
        include('views/ponente/index.php');
        }
        break;

    case 'new':
        $datostipo = $tipo->read();
        include('views/ponente/form.php');
        break;

    case 'add':
        $datos = $_POST;
        $resultado = $ponente->create($datos);
        //echo $resultado;
        $ponente->mensaje($resultado,($resultado)?"El ponente se agrego correctamente":"Ocurrió un error");
        $datos = $ponente->read();
        include('views/ponente/index.php');
        break;

    case 'modify':
        $datos = $ponente->readOne($id_ponente);
        $datostipo = $tipo->read();

        if(is_array($datos))
        {
        include('views/ponente/form.php');
        }
        else{
        $ponente->mensaje(0,"Ocurrió un error, el ponente no exixte.");
        $datos = $ponente->read();
        include('views/ponente/index.php');
        }
        break;

    case 'update':
        $datos = $_POST;
        $resultado = $ponente->update($datos, $id_ponente);
        // echo $resultado;
        $ponente->mensaje($resultado,($resultado)?"El ponente se actualizo correctamente":"Ocurrió un error");
        $datos = $ponente->read();
        include('views/ponente/index.php');
        break;

    case 'delete':
        $resultado = $ponente->delete($id_ponente);
        $ponente->mensaje($resultado,($resultado)?"El ponente se eliminó correctamente":"Ocurrió un error");

    default:
        $datos = $ponente->read();
        include('views/ponente/index.php');
}
include('views/footer.php');
?>
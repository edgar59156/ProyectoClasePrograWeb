<?php
require_once('conferencia.class.php');
require_once('ponente.class.php');

$id_conferencia = null;
$accion = null;
if (isset($_GET['accion'])) {
    $id_conferencia = isset($_GET['id_conferencia']) ? $_GET['id_conferencia'] : null;
    $accion = $_GET['accion'];
}

include('views/header.php');

switch ($accion) {
    case 'readOne':
        $datos = $conferencia->readOne($id_conferencia);
        $datosponentes = $ponentes->read();
        if(is_array($datos))
        {
        include('views/conferencia/index.php');
        }
        else{
        $conferencia->mensaje(0,"Ocurrió un error, la conferencia no exixte.");
        $datos = $conferencia->read();
        include('views/conferencia/index.php');
        }
        break;

    case 'new':
        $datosponentes = $ponentes->read();
        include('views/conferencia/form.php');       
        break;

    case 'add':
        $datos = $_POST;
        $resultado = $conferencia->create($datos);
        $conferencia->mensaje($resultado,($resultado)?"La conferencia se agrego correctamente":"Ocurrió un error");
        $datos = $conferencia->read();
        $datosponentes = $ponentes->read();
        include('views/conferencia/index.php');
        break;

    case 'modify':
        $datos = $conferencia->readOne($id_conferencia);
        $datosponentes = $ponentes->read();

        if(is_array($datos))
        {
        include('views/conferencia/form.php');
        }
        else{
        $conferencia->mensaje(0,"Ocurrió un error, la conferencia no exixte.");
        $datos = $conferencia->read();
        $datosponentes = $ponentes->read();
        include('views/conferencia/index.php');
        }
        break;

    case 'update':
        $datos = $_POST;
        $resultado = $conferencia->update($datos, $id_conferencia);
        $conferencia->mensaje($resultado,($resultado)?"La conferencia se actualizo correctamente":"Ocurrió un error");
        $datos = $conferencia->read();
        $datosponentes = $ponentes->read();
        include('views/conferencia/index.php');
        break;

    case 'delete':
        $resultado = $conferencia->delete($id_conferencia);
        $conferencia->mensaje($resultado,($resultado)?"La conferencia se eliminó correctamente":"Ocurrió un error");

    default:
    $datosponentes = $ponentes->read();
        $datos = $conferencia->read();
        
        include('views/conferencia/index.php');
}
include('views/footer.php');
?>
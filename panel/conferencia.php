<?php
require_once('conferencia.class.php');
require_once('ponente.class.php');
$sistema->validarRol('Usuario');

$id_conferencia = null;
$accion = null;
if (isset($_GET['accion'])) {
    $id_conferencia = isset($_GET['id_conferencia']) ? $_GET['id_conferencia'] : null;
    $accion = $_GET['accion'];
}

require_once('views/header.php');

switch ($accion) {
    case 'readOne':
        $datos = $conferencia->readOne($id_conferencia);
        $datosponentes = $ponentes->read();
        if(is_array($datos))
        {
        require_once('views/conferencia/index.php');
        }
        else{
        $conferencia->mensaje(0,"Ocurrió un error, la conferencia no exixte.");
        $datos = $conferencia->read();
        require_once('views/conferencia/index.php');
        }
        break;

    case 'new':
        $sistema->validarRol('Administrador');
        $datosponentes = $ponentes->read();
        require_once('views/conferencia/form.php');       
        break;

    case 'add':
        $sistema->validarRol('Administrador');
        $datos = $_POST;
        $resultado = $conferencia->create($datos);
        $conferencia->mensaje($resultado,($resultado)?"La conferencia se agrego correctamente":"Ocurrió un error");
        $datos = $conferencia->read();
        $datosponentes = $ponentes->read();
        require_once('views/conferencia/index.php');
        break;

    case 'modify':
        $sistema->validarRol('Administrador');
        $datos = $conferencia->readOne($id_conferencia);
        $datosponentes = $ponentes->read();

        if(is_array($datos))
        {
        require_once('views/conferencia/form.php');
        }
        else{
        $conferencia->mensaje(0,"Ocurrió un error, la conferencia no exixte.");
        $datos = $conferencia->read();
        $datosponentes = $ponentes->read();
        require_once('views/conferencia/index.php');
        }
        break;

    case 'update':
        $sistema->validarRol('Administrador');
        $datos = $_POST;
        $resultado = $conferencia->update($datos, $id_conferencia);
        $conferencia->mensaje($resultado,($resultado)?"La conferencia se actualizo correctamente":"Ocurrió un error");
        $datos = $conferencia->read();
        $datosponentes = $ponentes->read();
        require_once('views/conferencia/index.php');
        break;

    case 'delete':
        $sistema->validarRol('Administrador');
        $resultado = $conferencia->delete($id_conferencia);
        $conferencia->mensaje($resultado,($resultado)?"La conferencia se eliminó correctamente":"Ocurrió un error");

    default:
    $datosponentes = $ponentes->read();
        $datos = $conferencia->read();
        
        require_once('views/conferencia/index.php');
}
require_once('views/footer.php');
?>
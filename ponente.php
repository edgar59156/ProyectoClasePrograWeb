<?php
require_once('ponente.class.php');
require_once('tipo.class.php');
$id_ponente = null;
$accion = null;
if(isset($_GET['accion'])){
    $id_ponente = isset($_GET['id_ponente']) ? $_GET['id_ponente'] : null;
    $accion = $_GET['accion'];
}

include('views/header.php');

switch($accion){
    case 'readOne':
        $datos = $ponente->readOne($id_ponente);
        include('views/ponente/index.php');
    break;

    case 'new':
        $datostipo = $tipo->read();
        include('views/ponente/form.php');
        break;

    case 'add' : 
            $datos = $_POST;
            $resultado = $ponente->create($datos);
            echo $resultado;
           
        
    break;

    case 'delete':
        $resultado = $ponente->delete($id_ponente);
        echo $resultado;

           

    default:
        $datos = $ponente->read();
        include('views/ponente/index.php');
    

}
include('views/footer.php');
?>


<?php
header('Content-Type: application/json; charset=utf-8');
require_once('ponente.class.php');
require_once('tipo.class.php');
//$sistema->validarRol('Usuario');
$id_ponente = null;
$accion = null;
$id_ponente = isset($_GET['id_ponente']) ? $_GET['id_ponente'] : null;
$accion = $_SERVER['REQUEST_METHOD'];
$data = array();
switch ($accion) {

    case 'POST':
        $i = 0;
        $cont = 0;
        $data_input = file_get_contents('php://input');
        $data_input = json_decode($data_input, true);
        if (is_numeric($id_ponente)) {
            foreach ($data_input['ponentes'] as $key => $datos) {
                $resultado = $ponente->update($datos, $id_ponente);
                if ($resultado) {
                    $data[$i]['mensaje'] = "ponente actualizado";
                    $data[$i]['datos'] = $datos;
                    $cont++;
                } else {
                    $data[$i]['mesaje'] = 'error ponente no actualidao';
                }
                $i++;
            }
            $data['mensaje'] = "El metodo de insecion se mandó llamar (" . $cont . ")";
            $data['mensaje'] = "actualizar";
        } else {
            foreach ($data_input['ponentes'] as $key => $datos) {
                $resultado = $ponente->create($datos);
                if ($resultado) {
                    $data[$i]['mensaje'] = "ponente insertado";
                    $data[$i]['datos'] = $datos;
                    $cont++;
                } else {
                    $data[$i]['mesaje'] = 'error ponente no insertado';
                }
                $i++;
            }
            $data['mensaje'] = "El metodo de insecion se mandó llamar (" . $cont . ")";
        }
        break;

    case 'DELETE':
        if (is_numeric($id_ponente)) {
            $n = $ponente->delete($id_ponente);
            if ($n > 0) {
                $data['mensaje'] = 'se elimino el ponente ' . $id_ponente;
            } else {
                $data['mensaje'] = 'no existe el ponente';
            }
        }
        break;
    case 'GET':
    default:
        if (is_numeric($id_ponente)) {
            $data = $ponente->readOne($id_ponente);
        } else {
            $data = $ponente->read();
        }
}

$data = json_encode($data);
echo $data;
?>
<?php
require_once('inicio.class.php');
$sistema->validarRol('Usuario');
$accion=NULL;
require_once('views/header.php');

switch ($accion) {
    default:
    $participante['ponente'] = $inicio->conteoParticipante(1);
    $participante['panelista'] = $inicio->conteoParticipante(2);
    $participante['moderador'] = $inicio->conteoParticipante(3);
    $participante['conferencias'] = $inicio->conteoConferencias();
    require_once('index/index.php');
}


require_once('views/footer.php');
?>
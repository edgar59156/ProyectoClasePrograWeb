<h1><?php echo (isset($id_evento)) ? "Modificar" : "Nueva"; ?> Evento</h1>


<form style="padding: 2%;" method="POST" action="evento.php?accion=<?php echo (isset($id_evento)) ? "updateEvento&id_evento=" . $id_evento : "addEvento"; ?>" enctype='multipart/form-data'>
    <div class="row">
        <div class="col">
            <input type="text" class="form-control" placeholder="Nombre del Evento" name="evento" value="<?php echo (isset($id_evento)) ? $datos['evento'] : "" ?>">
        </div>
    </div>
    <div class="col">
        <input type="date" class="form-control"  name="fecha_inicio" value="<?php echo (isset($id_evento)) ? $datos['fecha_inicio'] : "" ?>">
    </div>
    <div class="col">
        <input type="date" class="form-control"  name="fecha_fin" value="<?php echo (isset($id_evento)) ? $datos['fechar_fin'] : "" ?>">
    </div>
    <input class="btn btn-success" type="submit" name="Guardar" value="Guardar" >
    <a href="inscripcion.php" class="btn btn-danger">Regresar</a>
</form>
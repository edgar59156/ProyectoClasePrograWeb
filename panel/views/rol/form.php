

<h1><?php echo(isset($id_rol))?"Modificar":"Nuevo"; ?> rol</h1>


<form style="padding: 2%;" method="POST" action="rol.php?accion=<?php echo (isset($id_rol)) ? "update&id_rol=" . $id_rol : "add"; ?>" enctype='multipart/form-data' >

    
    <div class="row">
        <div class="col">
            <input type="text" class="form-control" placeholder="Rol" name="rol" value="<?php echo (isset($id_rol)) ? $datos['rol'] : "" ?>">
        </div>
    </div>   

    <input class="btn btn-success" type="submit" name="Guardar" value="Guardar">
    <a href="rol.php" class="btn btn-danger">Regresar</a>
</form>

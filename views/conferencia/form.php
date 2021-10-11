
<h1><?php echo(isset($id_conferencia))?"Modificar":"Nueva"; ?> Conferencia</h1>
<?php 
if(isset($id_conferencia)){
    ?>
        <div class="text-center">
            <img src="image/conferencia/<?php echo $datos['imagen']; ?>" class="rounded-circle" width="200" height="210" alt="...">
        </div>
    <?php
}
?>

<form style="padding: 2%;" method="POST" action="conferencia.php?accion=<?php echo (isset($id_conferencia)) ? "update&id_conferencia=" . $id_conferencia : "add"; ?>" enctype='multipart/form-data' >
    <div class="row">
        <div class="col">
            <input type="text" class="form-control" placeholder="Titulo" name="titulo" value="<?php echo (isset($id_conferencia)) ? $datos['titulo'] : "" ?>">
        </div>
    </div>



    <div class="form-group">
        <label for="exampleFormControlTextarea1">Sinopsis</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="sinopsis"><?php echo (isset($id_conferencia)) ? $datos['sinopsis'] : "" ?></textarea>
    </div>

    <div class="form-group">
        <div>
        <label for="exampleFormControlFile1">Imagen</label>   
        </div>
        <div>
        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="imagen">
        </div> 
    </div>

    <div class="form-group col-md-4">
        <label for="inputState">Elige Ponente:</label>
        <select id="inputState" class="form-control" name="id_ponente">
            <?php foreach ($datosponentes as $key => $value) :
                $selected = "";
                if ($value['id_ponente'] == $datos['id_ponente']) :
                    $selected = "Selected";
                endif;
            ?>
                <option value="<?php echo $value['id_ponente']; ?>" <?php echo $selected; ?>><?php echo $value['nombre']; ?></option>

            <?php endforeach; ?>
        </select>
    </div>

    <input class="btn btn-success" type="submit" name="Guardar" value="Guardar">
    <a href="conferencia.php" class="btn btn-danger">Regresar</a>
</form>

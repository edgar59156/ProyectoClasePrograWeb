<?php if (isset($id_ponente)) : ?>
    <h1>Modificar Ponente</h1>
<?php else : ?>
    <h1>Nuevo Ponente</h1>
<?php endif ?>



<form method="POST" action="ponente.php?accion=<?php echo (isset($id_ponente)) ? "update&id_ponente=" . $id_ponente : "add"; ?>" enctype='multipart/form-data'>
    <div class="row">
        <div class="col">
            <input type="text" class="form-control" placeholder="Nombre" name="nombre" value="<?php echo (isset($id_ponente)) ? $datos['nombre'] : "" ?>">
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="Primer Apellido" name="primer_apellido" value="<?php echo (isset($id_ponente)) ? $datos['primer_apellido'] : "" ?>">
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="Segundo Apellido" name="segundo_apellido" value="<?php echo (isset($id_ponente)) ? $datos['segundo_apellido'] : "" ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="formGroupExampleInput">Tratamiento</label>
        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Subdirector de tal" name="tratamiento" value="<?php echo (isset($id_ponente)) ? $datos['tratamiento'] : "" ?>">
    </div>
    <div class="form-group">
        <label for="inputEmail4">Correo</label>
        <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="correo" value="<?php echo (isset($id_ponente)) ? $datos['correo'] : "" ?>">
    </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Imagen</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fotografia">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">Info</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="resumen"><?php echo (isset($id_ponente)) ? $datos['resumen'] : "" ?></textarea>
    </div>
    <div class="form-group col-md-4">
        <label for="inputState">Elige</label>
        <select id="inputState" class="form-control" name="id_tipo">
            <?php foreach ($datostipo as $key => $value) :
                $selected = "";
                if ($value['id_tipo'] == $datos['id_tipo']) :
                    $selected = "Selected";
                endif;
            ?>

                <option value="<?php echo $value['id_tipo']; ?>" <?php echo $selected; ?>><?php echo $value['tipo']; ?></option>

            <?php endforeach; ?>
        </select>
    </div>
    <input class="btn btn-success" type="submit" name="Guardar" value="Guardar">
    <a href="ponente.php" class="btn btn-danger">Regresar</a>
</form>
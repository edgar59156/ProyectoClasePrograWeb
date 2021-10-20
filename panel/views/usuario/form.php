<h1><?php echo (isset($id_usuario)) ? "Modificar" : "Nuevo"; ?> usuario</h1>


<form style="padding: 2%;" method="POST" action="usuario.php?accion=<?php echo (isset($id_usuario)) ? "update&id_usuario=" . $id_usuario : "add"; ?>" enctype='multipart/form-data'>


    <div class="form-group">
        <label for="inputEmail4">Correo</label>
        <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="correo" value="<?php echo (isset($id_usuario)) ? $datos['correo'] : "" ?>">
    </div>

    <div class="row">
        <div class="col">
            <input type="password" class="form-control" placeholder="Contraseña" name="contrasena" value="">
        </div>
    </div>
    <?php if(isset($id_usuario)): ?> 
        <h3>Roles del usuario:</h3>
        <?php foreach ($datos_roles as $key => $values):
        $checked = '';
        if(in_array($values['id_rol'],$datos_usuario_rol)){
            $checked = 'checked';
        }
        ?>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="<?php  echo($values['id_rol']); ?>" id="flexCheckDefault" name="roles[]" <?php echo $checked; ?> >
            <label class="form-check-label" for="flexCheckDefault">
                <?php echo($values['rol']) ?> 
            </label>
        </div>
        <?php 
           // echo 'aguja ' .$values['id_rol'];
           // echo("<pre>");
           // print_r($datos_usuario_rol);
           // echo("</pre>");
            endforeach;
        ?>
    <?php endif; ?>
    <input class="btn btn-success" type="submit" name="Guardar" value="Guardar">
    <a href="usuario.php" class="btn btn-danger">Regresar</a>
</form>
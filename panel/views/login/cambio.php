<form method="POST" action="login.php?accion=update">
<h1>Reestablecer contraseña</h1>  
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Nueva Contraseña</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="contrasena">
  </div>
  <input type="hidden"  name="correo" value="">
  <input type="hidden"  name="token" value="">
  <input type="submit" class="btn btn-primary" name="enviar" value="Cambiar contraseña"/>
</form>
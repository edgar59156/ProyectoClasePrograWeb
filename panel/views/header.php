<!doctype html>
<html lang="en">


<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<!-- <link rel="stylesheet" href="main.css">-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<title>Congreso Virtual</title>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/ProyectoClase/panel/inicio.php">Conferencia</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/ProyectoClase/panel/ponente.php">Ponentes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/ProyectoClase/panel/conferencia.php">Conferencias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/ProyectoClase/panel/usuario.php">Usuario</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/ProyectoClase/panel/rol.php">Roles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/ProyectoClase/panel/inscripcion.php">Inscripciones</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Cuenta
          </a>
          <div class="dropdown-menu" >
            <label class="dropdown-item"><?php echo $_SESSION['correo']; ?></label>
            <div class="dropdown-divider"></div>
            <a class="btn btn-primary dropdown-item" href="login.php?accion=logOut">Log Out</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
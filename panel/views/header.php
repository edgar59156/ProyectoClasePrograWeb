<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="main.css">-->
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
            <a class="nav-link active" aria-current="page" href="login.php?accion=logOut">Logout</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Cuenta
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <label class="dropdown-item"><?php echo $_SESSION['correo']; ?></label>
              <div class="dropdown-divider"></div>
              <a class="btn btn-primary dropdown-item" href="login.php?accion=logOut">Log Out</a>
            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Administracion
            </a>
          </li>
          <div class="container">

        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
</head>

<body>
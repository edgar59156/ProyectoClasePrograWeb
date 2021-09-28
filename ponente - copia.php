<?php
$mysqli = new mysqli("localhost", "congreso", "123", "congreso");
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>
  <h1>Ponentes</h1>
  <?php
  $resultado = $mysqli->query("SELECT p.id_ponente,concat(p.nombre,' ',p.primer_apellido) as nombre,t.tipo,p.fotografia from ponente p inner join tipo t on p.id_tipo=t.id_tipo;")
  ?>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Tipo</th>
        <th scope="col">Fotografia</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($obj = $resultado->fetch_object()) {
      ?>
        <tr>
          <th scope="row"><?php echo $obj->id_ponente; ?></th>
          <td><?php echo $obj->nombre; ?></td>
          <td><?php echo $obj->tipo; ?></td>
          <td>
            <div class="text-center">
              <img src="image/<?php echo $obj->fotografia; ?>" class="rounded" alt="...">
            </div>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>

<!--

$mysqli = new mysqli("localhost","congreso","123","congreso");

if($resultado = $mysqli-> query("SELECT * FROM ponente")){
    while($obj = $resultado -> fetch_object())
    {
        print_r ($obj);
        print("<br>");
        
    }
    $resultado->close();
}
-->
<?php
$mysqli->close();
?>
<h1>Conferencias</h1>
  <a href="conferencia.php?accion=new" class="btn btn-primary">Añadir Conferencia</a>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Imagen</th>
        <th scope="col">Titulo</th>
        <th scope="col">Sinopsis</th>
        <th scope="col">Impartida por:</th>
        <th scope="col"> </th>
        <th scope="col">Editar</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($datos as $key => $dato) :
      ?>
        <tr>
          <th scope="row"><?php echo $dato['id_conferencia'] ?></th>
          <td>
            <div class="text-center">
              <img src="image/conferencia/<?php echo $dato['imagen'] ?>" class="rounded-circle" width="100" height="110">
            </div>
          </td>
          <td><?php echo $dato['titulo'] ?></td>
          <td><?php echo $dato['sinopsis'] ?></td>
          
          <td>
            <div class="text-center">
              <img src="image/ponentes/<?php echo $dato['fotografia'] ?>" class="rounded-circle" width="100" height="110">
            </div>
          </td>
          <td><?php echo $dato['nombre'].' '.$dato['primer_apellido'] ?></td>
          <td>
            <ul>
              <i class="btn btn-success bi bi-pencil"><a href="conferencia.php?accion=modify&id_conferencia=<?php echo $dato['id_conferencia']; ?>" style="color: black;">Modificar</a></i>
              <i class="btn btn-danger bi bi-trash-fill"><a href="conferencia.php?accion=delete&id_conferencia=<?php echo $dato['id_conferencia']; ?>" style="color: black;">Eliminar</a></i>
            </ul>
          </td>
        </tr>
      <?php
      endforeach
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
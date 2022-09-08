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
              <img alt="..." src="image/conferencia/<?php echo $dato['imagen'] ?>" class="rounded-circle" width="100" height="110">
            </div>
          </td>
          <td><?php echo $dato['titulo'] ?></td>
          <td><?php echo $dato['sinopsis'] ?></td>
          
          <td>
            <div class="text-center">
              <img alt="..." src="image/ponentes/<?php echo $dato['fotografia'] ?>" class="rounded-circle" width="100" height="110">
            </div>
          </td>
          <td><?php echo $dato['nombre'].' '.$dato['primer_apellido'] ?></td>
          <td>
            <ul>
            <li style="list-style: none;"><a class="btn btn-success bi bi-pencil" href="conferencia.php?accion=modify&id_conferencia=<?php echo $dato['id_conferencia']; ?>" style="color: black;">Modificar</a></li>
            <li style="list-style: none;"><a class="btn btn-danger bi bi-pencil" href="conferencia.php?accion=delete&id_conferencia=<?php echo $dato['id_conferencia']; ?>" style="color: black;">Eliminar</a></li>
            </ul>
          </td>
        </tr>
      <?php
      endforeach
      ?>
    </tbody>
  </table>
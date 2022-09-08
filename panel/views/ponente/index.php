
  <h1>Ponentes</h1>
  <a href="ponente.php?accion=new" class="btn btn-primary">Añadir Ponente</a>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Fotografia</th>
        <th scope="col">Nombre</th>
        <th scope="col">Tipo</th>
        <th scope="col">Editar</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($datos as $key => $dato) :
      ?>
        <tr>
          <th scope="row"><?php echo $dato['id_ponente'] ?></th>
          <td>
            <div class="text-center">
              <img alt="..." src="image/ponentes/<?php echo $dato['fotografia'] ?>" class="rounded-circle" width="100" height="110">
            </div>
          </td>
          <td><?php echo $dato['nombre'] ?></td>
          <td><?php echo $dato['tipo'] ?></td>
          <td>
            <ul>
            <li style="list-style: none;"><a class="btn btn-success bi bi-pencil" href="ponente.php?accion=modify&id_ponente=<?php echo $dato['id_ponente']; ?>" style="color: black;">Modificar</a></li>
            <li style="list-style: none;"><a class="btn btn-danger bi bi-pencil" href="ponente.php?accion=delete&id_ponente=<?php echo $dato['id_ponente']; ?>" style="color: black;">Eliminar</a></li>
            </ul>
          </td>
        </tr>
      <?php
      endforeach
      ?>
    </tbody>
  </table>


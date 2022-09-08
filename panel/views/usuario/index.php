<h1>usuarios</h1>
  <a href="usuario.php?accion=new" class="btn btn-primary">Añadir usuario</a>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">correo</th>
        <th scope="col">Editar</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($datos as $key => $dato) :
      ?>
        <tr>
          <th scope="row"><?php echo $dato['id_usuario'] ?></th>
          <td><?php echo $dato['correo'] ?></td>
          <td>
            <ul>
            <li style="list-style: none;"><a class="btn btn-success bi bi-pencil" href="usuario.php?accion=modify&id_usuario=<?php echo $dato['id_usuario']; ?>" style="color: black;">Modificar</a></li>
            <li style="list-style: none;"><a class="btn btn-danger bi bi-danger" href="usuario.php?accion=delete&id_usuario=<?php echo $dato['id_usuario']; ?>" style="color: black;">Eliminar</a></li>
            </ul>
          </td>
        </tr>
      <?php
      endforeach
      ?>
    </tbody>
  </table>
<h1>Conferencia</h1>
  <a href="evento.php?accion=new" class="btn btn-primary">Añadir evento</a>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Titulo</th>
        <th scope="col">Fecha</th>
        <th scope="col">hora inicio</th>
        <th scope="col">hora fin</th>
        <th scope="col">Num participantes</th>
        <th scope="col">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($datos as $key => $dato) :
      ?>
        <tr>
          <th scope="row"><?php echo $dato['id_evento'] ?></th>
          <td><?php echo $dato['titulo'] ?></td>
          <td><?php echo $dato['fecha'] ?></td>
          <td><?php echo $dato['hora_inicio'] ?></td>
          <td><?php echo $dato['hora_fin'] ?></td>
          <td><?php echo $dato['inscritos'] ?></td>
          <td>
            <ul>
            <li style="list-style: none;"><a class="btn btn-success bi bi-pencil" href="inscripcion.php?accion=participante&id_evento=<?php echo $dato['id_evento'] ?>&id_conferencia_programacion=<?php echo $dato['id_conferencia_programacion'];?>&id_conferencia=<?php echo $dato['id_conferencia'];?>" style="color: black;">Inscribir</a></li>
            </ul>
          </td>
        </tr>
      <?php
      endforeach
      ?>
    </tbody>
  </table>
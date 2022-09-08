<h1>Inscripciones</h1>
<a href="evento.php?accion=nuevoEvento" class="btn btn-primary">Nuevo evento</a>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">evento</th>
      <th scope="col">fecha_incio</th>
      <th scope="col">fecha_fin</th>
      <th scope="col">conferencias</th>
      <th scope="col">conferencistas</th>
      <th scope="col">participantes</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($datos as $key => $dato) :
    ?>
      <tr>
        <th scope="row"><?php echo $dato['id_evento'] ?></th>
        <td><?php echo $dato['evento'] ?></td>
        <td><?php echo $dato['fecha_inicio'] ?></td>
        <td><?php echo $dato['fecha_fin'] ?></td>
        <td><?php echo $dato['conferencias'] ?></td>
        <td><?php echo $dato['conferencistas'] ?></td>
        <td><?php echo $dato['participantes'] ?></td>
        <td>
          <ul>
            <li style="list-style: none;"><a class="btn btn-success bi bi-pencil" href="inscripcion.php?accion=inscribir&id_evento=<?php echo $dato['id_evento']; ?>" style="color: black;">Inscribir</a></li>
            <li style="list-style: none;"><a class="btn btn-primary bi bi-pencil" href="inscripcion.php?accion=nuevaConferencia&id_evento=<?php echo $dato['id_evento']; ?>" style="color: black;">Nueva conferencia</a></li>
            <li style="list-style: none;"><a class="btn btn-secondary bi bi-pencil" href="reporte.php?accion=lista&id_evento=<?php echo $dato['id_evento']; ?>" style="color: black;">Reporte</a></li>
          </ul>
        </td>
      </tr>
    <?php
    endforeach
    ?>
  </tbody>
</table>
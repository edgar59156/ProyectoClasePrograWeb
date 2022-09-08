
<h1>Inscribir en: <?php echo $conferencias['titulo']; ?></h1>
<form method="GET" action="inscripcion.php">
    <select name="id_participante">
        <option value=" ">...</option>
        <?php foreach ($participantes_disponibles as $key => $dato) : ?>
            <option value="<?php echo $dato['id_participante']; ?>"><?php echo $dato['apaterno'] . " " . $dato['amaterno'] . " " . $dato['nombre']; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="hidden" name="accion" value="participante">
    <input type="hidden" name="id_evento" value="<?php echo $id_evento; ?>">
    <input type="hidden" name="id_conferencia_programacion" value="<?php echo $id_conferencia_programacion; ?>">
    <input type="hidden" name="id_conferencia" value="<?php echo $id_conferencia; ?>">
    <input type="submit" name="accion_participante" value="agregar">

</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Apellido Paterno</th>
            <th scope="col">Apellido Materno</th>
            <th scope="col">Nombres</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($inscritos as $key => $dato) :
        ?>
            <tr>
                <th scope="row"><?php echo $dato['id_participante']; ?></th>
                <td><?php echo $dato['apaterno']; ?></td>
                <td><?php echo $dato['amaterno']; ?></td>
                <td><?php echo $dato['nombre']; ?></td>
                <td>
                    <ul>
                    <li style="list-style: none;"><a class="btn btn-danger bi bi-pencil" href="inscripcion.php?accion=participante&id_evento=<?php echo $id_evento; ?>&id_conferencia_programacion=<?php echo $id_conferencia_programacion; ?>&id_conferencia=<?php echo $id_conferencia; ?>&id_participante=<?php echo $dato['id_participante']; ?>&accion_participante=eliminar">Eliminar</a></li>
                    </ul>
                </td>
            </tr>
        <?php
        endforeach
        ?>

    </tbody>
</table>
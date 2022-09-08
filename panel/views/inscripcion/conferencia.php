<h1>Agregar conferencia en el evento: <?php echo $datosEvento['evento']; ?></h1>
<form method="GET" action="inscripcion.php" >
    <select name="id_conferencia">
        <option value=" ">...</option>
        <?php foreach ($conferencias_disponibles as $key => $dato) : ?>
            <option value="<?php echo $dato['id_conferencia']; ?>"><?php echo $dato['titulo'] ?></option>
        <?php endforeach; ?>
    </select>
    <input type="hidden" name="accion" value="nuevaConferencia">
    <input type="hidden" name="id_evento" value="<?php echo $id_evento; ?>">
    Fecha 
    <input type="date" name="fecha"/>
    Hora inicio
    <input type="time" name="hora_inicio"/>  
    Hora fin
    <input type="time" name="hora_fin"/>  
    <input type="submit" name="accion_conferencia" value="agregar">
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titulo</th>
            <th scope="col">Sinopsis</th>
            <th scope="col">id_ponente</th>
            <th scope="col">opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($conferencias_en_evento as $key => $dato) :
        ?>
            <tr>
                <th scope="row"><?php echo $dato['id_conferencia']; ?></th>
                <td><?php echo $dato['titulo']; ?></td>
                <td><?php echo $dato['sinopsis']; ?></td>
                <td><?php echo $dato['id_ponente']; ?></td>
                <td>
                    <ul>
                    <li style="list-style: none;"><a class="btn btn-danger bi bi-pencil" href="inscripcion.php?accion=nuevaConferencia&id_evento=<?php echo $id_evento;?>&id_conferencia=<?php echo $dato['id_conferencia'] ?>&accion_conferencia=eliminar">Eliminar</a></li>
                    </ul>
                </td>
            </tr>
        <?php
        endforeach
        ?>

    </tbody>
</table>
<h1> <?php echo $datos['evento']; ?> </h1>
<h1> <?php echo $datos['fecha_inicio']; ?> </h1>
<h1> <?php echo $datos['fecha_fin']; ?> </h1>
<?php
foreach ($conferencias as $key => $conferencia) :
?>
    <h4> <?php echo $conferencia['titulo']; ?> </h4>
    <h4> <?php echo $conferencia['primer_apellido'] . ' ' . $conferencia['segundo_apellido'] . ' ' . $conferencia['nombre']; ?> </h4>
    <h4> <?php echo $conferencia['fecha'] . ' ' . $conferencia['hora_inicio']; ?> </h4>
    <?php
    foreach ($participantes[$key] as $key2 => $participante) :
    ?>
    <?php echo $participante['apaterno']. ' '. $participante['amaterno'].' '.$participante['nombre'] ?>
    <br/>
    <?php endforeach; ?>
    <hr/>
<?php endforeach; ?>
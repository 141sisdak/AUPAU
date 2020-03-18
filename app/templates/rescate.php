<?php ob_start() ?>
<?php if(isset($params['mensaje'])) :?>
<b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
<?php endif; ?>
<div class="table-responsive-md">
<table class="table">
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Fecha nacimiento</th>
<th>Edad</th>
<th>Fecha ingreso</th>
<th>Adoptado</th>
<th>Esterilizado</th>
<th>Nº Chip</th>
<th>Ulitma desparasitación</th>
<th>Especie</th>
<th>Tamaño</th>
<th>Localidad</th>
<th>Refugio</th>
</tr>
<?php foreach ($params['animales'] as $animal) :?>
<tr>
<td><?php echo $animal['id'] ?></a></td>
<td><?php echo $animal['nombre']?></td>
<td><?php echo $animal['fechaNac']?></td>
<td><?php echo $animal['edad']?></td>
<td><?php echo $animal['fechaIngreso']?></td>
<td><?php echo $animal['estadoAdop']?></td>
<td><?php echo $animal['esterilizado']?></td>
<td><?php echo $animal['numchip']?></td>
<td><?php echo $animal['ult_despa']?></td>
<td><?php echo $animal['especie']?></td>
<td><?php echo $animal['tamanyo']?></td>
<td><?php echo $animal['localidad']?></td>
<td><?php echo $animal['refugio']?></td>
</tr>
<?php endforeach; ?>

</table>

</table>
</div>
<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>

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
<td>
  <div class="dropdown">
  <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
  <img src="../web/images/conf.svg" alt="configuracion" class="iconoConf"/>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    
   <a class="dropdown-item" href="index.php?ctl=verAnimal&id=<?php echo $animal['id']?>">Ver ficha</a>
   <a class="dropdown-item" href="index.php?ctl=modificarAnimal&id=<?php echo $animal['id']?>">Modificar</a>
   <a class="dropdown-item" href="index.php?ctl=eliminarAnimal&id=<?php echo $animal['id']?>">Eliminar</a>
   

  </div>
</td>
<td>

<div class="dropdown">
  <button class="btn btn-danger dropdown-toggle peticion" type="button" data-toggle="dropdown">enfermedades</button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   
  </div>
</div>
</td>
<td>
<div class="dropdown">
  <button class="btn btn-warning dropdown-toggle peticion" type="button" data-toggle="dropdown">vacunas</button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   
  </div>
</div>
</td>
<td>
<div class="dropdown">
  <button class="btn btn-info dropdown-toggle peticion" type="button" data-toggle="dropdown">tratamientos</button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   
  </div>
</div>
</td>
</tr>
<?php endforeach; ?>

</table>


</table>

</div>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>

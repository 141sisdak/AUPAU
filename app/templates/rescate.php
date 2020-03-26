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
<form class="form-horizontal "name="formFiltrosRescates" action="#" method="post">
<h4>Fecha nacimiento:</h4>
<label for="lblFechaDesde">Desde</label>
<input type="date" name="fechaNacDesde" id="fechaNacDesde"/>
<label for="lblFechaDesde">hasta</label>
<input type="date" name="fechaNacHasta" id="fechaNacHasta"/>

<h4>Nombre</h4>
<input type="text" name="nombre">

<h4>Tamaño</h4>
<select name="selTamanyo" id="selTamanyo">
<option disabled selected>Selecciona un tamaño</option>
<?php foreach($params["tamanyos"] as $tamanyos=>$campo){?>

<option value="<?php echo $campo["id"] ?>"><?php echo $campo["tamanyo"] ?></option>

<?php
} 
?>
</select>

<h4>Localidad</h4>

<select name="selTamanyo" id="selTamanyo">
<option disabled selected>Selecciona una localidad</option>
<?php foreach($params["localidades"] as $tamanyos){?>

<option value="<?php echo $tamanyos["id"] ?>"><?php echo $tamanyos["localidad"] ?></option>

<?php
} 
?>
</select>

<h4>Sexo</h4>
<div class="form-check">
  <input class="form-check-input" type="radio" name="radioSexo" value="macho">
  <label class="form-check-label" for="exampleRadios1">Macho</label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="radioSexo" value="hembra" >
  <label class="form-check-label" for="exampleRadios1">Hembra</label>
  </div>


<h4>Edad:</h4>
<input type="number" name="edad">

<h4>Fecha ingreso:</h4>
<label for="lblFechaIngDesde">Desde</label>
<input type="date" id="fechaIngDesde" name="fechaIngDesde"/>
<label for="lblFechaIngHasta">hasta</label>
<input type="date" id="fechaIngHasta" name="fechaIngHasta"/>

<h4>Estado de adopción</h4>
<div class="form-check">
  <input class="form-check-input" type="radio" name="radioAdoptado"  value="adoptado" >
  <label class="form-check-label" for="exampleRadios1">Adoptado</label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="radioAdoptado" value="noAdoptado" >
  <label class="form-check-label" for="radioAdoptado">No adoptado</label>
  </div>

  <h4>Última desparasitación:</h4>
<label for="lblDesp">Desde</label>
<input type="date" name="fechaUltDesde" id="fechaUltDesde"/>

<label for="lblEdadDesde">Hasta</label>
<input type="date"name="fechaUltHasta" id="fechaUltHasta"/>

<h4>Adoptante</h4>
<select name="selectAdoptante" id="selectAdoptante">
</select>

<h4>Especie</h4>

<select name="selEspecie" id="selEspecie">
<option disabled selected>Selecciona una especie</option>
<?php foreach($params["especies"] as $especies){?>

<option value="<?php echo $especies["id"] ?>"><?php echo $especies["nombre"] ?></option>

<?php
} 
?>
</select>

<h4>Raza</h4>

<select name="selRaza" id="selRaza" disabled>
<option disabled selected>Selecciona una raza</option>

</select>

<h4>Esterilizado</h4>
<div class="form-check">
    <input type="checkbox" class="form-check-input" id="ckEsterilizado" name="ckEsterilizado">
    
  </div>
<br>
 <h4>Nº Chip</h4>
<input type="text" name="numChip"/>

<h4>Refugio</h4>

<select name="selRefugio" id="selRefugio" >
<option disabled selected>Selecciona un refugio</option>
<?php foreach($params["refugios"] as $refugio){?>

<option value="<?php echo $refugio["id"] ?>"><?php echo $refugio["nombre"] ?></option>

<?php
} 
?>
</select>
<br>
<br>
<button class="btn btn-primary" type="submit" name="filtrar">Filtrar</button>

</form>
<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>

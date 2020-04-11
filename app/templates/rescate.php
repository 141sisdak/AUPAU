<?php ob_start() ?>
<?php if(isset($params['mensaje'])) :?>
<b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
<?php endif; ?>
<?php
if(isset($validacion->mensaje)){
    if (is_object ($validacion)){
        foreach ($validacion->mensaje as $errores) {
            foreach ($errores as $error)?>
            <b><span style="color: red;"><?php echo $error?></span></b><br>
            <?php 
    }}
    
}
?>
 <div class="button-group">
        <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-cog"></span> <span class="caret">Personalizar campos</span></button>
<ul class="dropdown-menu" id="listaCampos">
 
 
</ul>
  </div>

  <div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ordenar por...</button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="<?php if(isset($_POST["filtrar"])||isset($_GET["filtrar"])=="on") echo 'index.php?ctl=filtroRescate&ordenacion=fechaNac&filtrar=on';else echo 'index.php?ctl=rescate&ordenacion=fechaNac'?>">Fecha nacimiento</a>
    <a class="dropdown-item" href="<?php if(isset($_POST["filtrar"])||isset($_GET["filtrar"])=="on") echo 'index.php?ctl=filtroRescate&ordenacion=fechaIng&filtrar=on';else echo 'index.php?ctl=rescate&ordenacion=fechaIng'?>">Fecha ingreso</a>
    <a class="dropdown-item" href="<?php if(isset($_POST["filtrar"])||isset($_GET["filtrar"])=="on") echo 'index.php?ctl=filtroRescate&ordenacion=fechaDesp&filtrar=on';else echo 'index.php?ctl=rescate&ordenacion=fechaDesp'?>">Fecha desparasitación</a>
    <a class="dropdown-item" href="<?php if(isset($_POST["filtrar"])||isset($_GET["filtrar"])=="on") echo 'index.php?ctl=filtroRescate&ordenacion=edad&filtrar=on';else echo 'index.php?ctl=rescate&ordenacion=edad'?>">Edad</a>
    <a class="dropdown-item" href="<?php if(isset($_POST["filtrar"])||isset($_GET["filtrar"])=="on") echo 'index.php?ctl=filtroRescate&ordenacion=nombre&filtrar=on';else echo 'index.php?ctl=rescate&ordenacion=nombre'?>">Nombre</a>
    <li class="<?php if($params["pagina"]==1) echo "page-item disabled";else echo "disabled" ?>">
  </div>
</div>
<?php if(isset($_GET["ordenacion"])) echo $_GET["ordenacion"] ."<br>"?>
<?php if(isset($_POST["filtrar"])) echo "tiene filtrar"; ?>
</div>
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
<th>Raza</th>
<th>Tamaño</th>
<th>Localidad</th>
<th>Refugio</th>
</tr>
<?php if(isset($params["animales"])){
foreach ($params['animales'] as $animal){
  ?>
  <tr>
<td><?php echo $animal['id'] ?></a></td>
<td><?php echo $animal['nombre']?></td>
<td><?php echo date("d-m-Y", strtotime($animal['fechaNac']))?></td>
<td><?php echo $animal['edad']?></td>
<td><?php echo date("d-m-Y", strtotime($animal['fechaIngreso']))?></td>
<td><?php echo $animal['estadoAdop']?></td>
<td><?php echo $animal['esterilizado']?></td>
<td><?php echo $animal['numchip']?></td>
<td><?php echo date("d-m-Y", strtotime($animal['ult_despa']))?></td>
<td><?php echo $animal['especie']?></td>
<td><?php echo $animal['raza']?></td>
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
<?php 
}
}
?>
</table>

<!--Mostramos la barra en caso de que hayan resultados-->
<?php if($params["totalRegistros"]>1):?>
<nav aria-label="Page navigation">
  <ul class= "pagination">
    <!--Mostramos la barra en caso de que hayan resultados-->
    <li class="<?php if($params["pagina"]==1) echo "page-item disabled";else echo "disabled" ?>">
    <?php if($params["filtro"]=="off"):?> 
     <a class="page-link" href="index.php?ctl=rescate&pagina= <?php echo $params["pagina"]-1 ?> <?php if(isset($_GET["ordenacion"])) echo "&ordenacion=".$_GET["ordenacion"] ?> " aria-label="Next">
    <?php else: ?>
      <a class="page-link" href="index.php?ctl=filtroRescate&pagina= <?php echo $params["pagina"]-1 ?> <?php if(isset($_GET["ordenacion"])) echo "&ordenacion=".$_GET["ordenacion"]."&filtrar=on" ?>" aria-label="Next">
      
     <?php endif; ?>
        <span aria-hidden="true">Anterior</span>
        <span class="sr-only">Anterior</span>
      </a>
    </li>
    <?php for($i=1; $i<=$params["numPaginas"];$i++): ?>
    <?php 
      if($params["filtro"]=="off"){
       
        if($params["pagina"]==$i){ 
         echo '<li class="page-item active"><a class="page-link" href="index.php?ctl=rescate&pagina='.  $i . '">'.$i .'</a></li>';
        }else{
          if(isset($_GET["ordenacion"])){
            echo  '<li class="page-item"><a class="page-link " href="index.php?ctl=rescate&pagina='.  $i ."&ordenacion=".$_GET["ordenacion"]. '">'.$i .'</a></li>';
          }else{
            echo  '<li class="page-item"><a class="page-link " href="index.php?ctl=rescate&pagina='.  $i . '">'.$i .'</a></li>';
          }
       
        }
       
      }else{
        if($params["pagina"]==$i){
          echo '<li class="page-item active"><a name="filtroPag" class="page-link" href="index.php?ctl=filtroRescate&pagina='.  $i . '">'.$i .'</a></li>';
        }else{
          if(isset($_GET["ordenacion"])){
            echo  '<li class="page-item"><a class="page-link " href="index.php?ctl=filtroRescate&pagina='.  $i ."&ordenacion=".$_GET["ordenacion"]. '&filtrar=on">'.$i .'</a></li>';
          }else{
            echo  '<li class="page-item"><a class="page-link " href="index.php?ctl=filtroRescate&pagina='.  $i . '&filtrar=on">'.$i .'</a></li>';
          }
        }
       
      }
      ?> 
<?php endfor; ?>

    <li class="<?php if($params["pagina"]==$params["numPaginas"]) echo "page-item disabled";else echo "disabled" ?>">
    <?php if($params["filtro"]=="off"):?> 
      <a class="page-link" href="index.php?ctl=rescate&pagina= <?php echo $params["pagina"]+1 ?> <?php if(isset($_GET["ordenacion"])) echo "&ordenacion=".$_GET["ordenacion"] ?> " aria-label="Next">
    <?php else: ?>
      <a class="page-link" href="index.php?ctl=filtroRescate&pagina= <?php echo $params["pagina"]+1 ?> <?php if(isset($_GET["ordenacion"])) echo "&ordenacion=".$_GET["ordenacion"]."&filtrar=on" ?>" aria-label="Next">
      
     <?php endif; ?>
      
        <span aria-hidden="true">Siguiente</span>
        <span class="sr-only">Siguiente</span>
      </a>
    </li>
  </ul>
</nav>
<?php endif; ?>
<?php echo "Total registros: " . $params["totalRegistros"]."<br>" ?>
<?php echo "Nº paginas: " . $params["numPaginas"]."<br>" ?>
<?php echo "Pagina actual: " . (int)$params["pagina"]++ ."<br>" ?>
<?php 
if(isset($params["mensajeTabla"])){
  ?>
  <b><span style="color: red;"><?php echo $params['mensajeTabla'] ?></span></b>
  <?php
}
?>


</div>
<form class="form-horizontal "name="formFiltrosRescates" action="index.php?ctl=filtroRescate" method="post" id="formFiltros">
<div>
<h4>Fecha nacimiento:</h4>
<label for="lblFechaDesde">Desde</label>
<input type="date" name="fechaNacDesde" id="fechaNacDesde"/>
<label for="lblFechaDesde">hasta</label>
<input type="date" name="fechaNacHasta" id="fechaNacHasta"/><br>


</div>

<div>
<h4>Nombre</h4>
<input type="text" name="nombre" id="nombre" value="<?php if(isset($params["nombre"])) echo $params["nombre"] ?>">
</div>

<div>
<h4>Tamaño</h4>
<select name="selTamanyo" id="selTamanyo">
<option disabled selected value="0">Selecciona un tamaño</option>
<?php foreach($params["tamanyos"] as $tamanyos=>$campo){?>

<option value="<?php echo $campo["id"] ?>"><?php echo $campo["tamanyo"] ?></option>

<?php
} 
?>
</select>
</div>

<div>
<h4>Localidad</h4>

<select name="selLocalidad" id="selLocalidad">
<option disabled selected value="0">Selecciona una localidad</option>
<?php foreach($params["localidades"] as $tamanyos){?>

<option value="<?php echo $tamanyos["id"] ?>"><?php echo $tamanyos["localidad"] ?></option>

<?php
} 
?>
</select>
</div>

<div>
<h4>Sexo</h4>
<div class="form-check">
  <input class="form-check-input" type="radio" name="radioSexo" value="macho">
  <label class="form-check-label" for="exampleRadios1">Macho</label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="radioSexo" value="hembra" >
  <label class="form-check-label" for="exampleRadios1">Hembra</label>
  </div>
</div>

<div>
<h4>Edad:</h4>
<input type="number" name="edad" id="edad">
</div>

<div>
<h4>Fecha ingreso:</h4>
<label for="lblFechaIngDesde">Desde</label>
<input type="date" id="fechaIngDesde" name="fechaIngDesde"/>
<label for="lblFechaIngHasta">hasta</label>
<input type="date" id="fechaIngHasta" name="fechaIngHasta"/>
</div>

<div>
<h4>Estado de adopción</h4>
<div class="form-check">
  <input class="form-check-input" type="radio" name="radioAdoptado"  value="adoptado" <?php if(isset($params["estadoAdop"])&&$params["estadoAdop"]=="adoptado") echo "checked" ?> >
  <label class="form-check-label" for="radioAdoptado">Adoptado</label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="radioAdoptado" value="no adoptado"<?php if(isset($params["estadoAdop"])&&$params["estadoAdop"]=="no adoptado") echo "checked" ?>>
  <label class="form-check-label" for="radioAdoptado">No adoptado</label>
  </div>
  </div>

<div>
  <h4>Última desparasitación:</h4>
<label for="lblDesp">Desde</label>
<input type="date" name="fechaUltDesde" id="fechaUltDesde"/>

<label for="lblEdadDesde">Hasta</label>
<input type="date"name="fechaUltHasta" id="fechaUltHasta"/>

<h4>Adoptante</h4>
<select name="selectAdoptante" id="selAdoptante">
<option disabled selected value="0">Selecciona un adoptante</option>
</select>
</div>

<div>
<h4>Especie</h4>

<select name="selEspecie" id="selEspecie">
<option disabled selected value="0">Selecciona una especie</option>
<?php foreach($params["especies"] as $especies){?>

<option value="<?php echo $especies["id"] ?>"><?php echo $especies["nombre"] ?></option>

<?php
} 
?>
</select>
</div>

<div>
<h4>Raza</h4>

<select name="selRaza" id="selRaza" disabled>
<option disabled selected value="0">Selecciona una raza</option>

</select>
</div>

<div>
<h4>Esterilizado</h4>
<div class="form-check">
    <input type="checkbox" class="form-check-input" id="ckEsterilizado" name="ckEsterilizado">
    
  </div>
<br>
</div>


<div>
 <h4>Nº Chip</h4>
<input type="text" name="numChip" id="numChip"/>
</div>

<div>
<h4>Refugio</h4>

<select name="selRefugio" id="selRefugio" >
<option disabled selected value="0">Selecciona un refugio</option>
<?php foreach($params["refugios"] as $refugio){?>

<option value="<?php echo $refugio["id"] ?>"><?php echo $refugio["nombre"] ?></option>

<?php
} 
?>
</select>
<br>
<br>
</div>
<button class="btn btn-primary" type="submit" name="filtrar">Filtrar</button>

</form>
<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>

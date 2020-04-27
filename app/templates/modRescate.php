<?php ob_start() ?>

<?php if(isset($params['mensaje'])) :?>
<b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
<?php endif; ?>
<?php
if(isset($validacion->mensaje)){
    if (is_object ($validacion)){
        foreach ($validacion->mensaje as $errores) {
            foreach ($errores as $error)?>
            <b><span style="color: red;"><?php echo $error ?></span></b><br>
            <?php 
    }}
    
}
?>
<span hidden id="id_rescate"><?php echo $params["ficha"]["id"] ?></span>

<form action="index.php?ctl=modificarRescate&id=<?php echo $params["ficha"]["id"] ?>" method="post" name="formModRescate" id="formModRescate">

<h4>Fecha nacimiento:</h4>
<label for="lblFechaNacMod">Fecha nacimiento:</label>
<input type="date" name="fechaNacMod" id="fechaNacMod" value="<?php echo $params["ficha"]["fechaNac"] ?>"/>
<br>

<div>
<h4>Nombre</h4>
<input type="text" name="nombre" id="nombre" value="<?php echo $params["ficha"]["nombre"] ?>">
</div>

<div>
<h4>Tamaño</h4>
<select name="mSelTamanyo" id="mSelTamanyo">

<?php foreach($params["tamanyos"] as $tamanyos=>$campo){?>

<option value="<?php echo $campo["id"] ?>"<?php if($params["ficha"]["tamanyo"]==$campo["tamanyo"]) echo "selected" ?>><?php echo $campo["tamanyo"] ?></option>

<?php
} 
?>
</select>
</div>

<div>
<h4>Localidad</h4>

<select name="selLocalidad" id="selLocalidad">

<?php foreach($params["localidades"] as $localidad){?>

<option value="<?php echo $localidad["id"] ?>"<?php if($params["ficha"]["localidad"]==$localidad["localidad"]) echo "selected" ?>><?php echo $localidad["localidad"] ?></option>

<?php
} 
?>
</select>
</div>

<div>
<h4>Sexo</h4>
<div class="form-check">
  <input class="form-check-input" type="radio" name="radioSexo" value="macho" <?php if($params["ficha"]["sexo"]=="macho") echo "checked" ?>>
  <label class="form-check-label" for="exampleRadios1">Macho</label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="radioSexo" value="hembra" <?php if($params["ficha"]["sexo"]=="hembra") echo "checked" ?> >
  <label class="form-check-label" for="exampleRadios1">Hembra</label>
  </div>
</div>

<div>
<h4>Edad:</h4>
<input type="number" name="edadMod" id="edadMod" value="<?php echo $params["ficha"]["edad"] ?>">
</div>

<div>
<h4>Fecha ingreso:</h4>
<label for="lblFechaIngMod">Desde</label>
<input type="date" id="fechaIngMod" name="fechaIngMod" value="<?php echo $params["ficha"]["fechaIngreso"] ?>"/>

</div>

<div>
<h4>Estado de adopción</h4>
<div class="form-check">
  <input class="form-check-input" type="radio" name="radioAdoptado"  value="adoptado" <?php if($params["ficha"]["estadoAdop"]=="adoptado") echo "checked" ?>  >
  <label class="form-check-label" for="radioAdoptado">Adoptado</label>
  </div>
  <div class="form-check">
  <input class="form-check-input" type="radio" name="radioAdoptado" value="no adoptado"<?php if($params["ficha"]["estadoAdop"]=="no adoptado") echo "checked" ?>>
  <label class="form-check-label" for="radioAdoptado">No adoptado</label>
  </div>
  </div>

<div>
  <h4>Última desparasitación:</h4>

<input type="date" name="fechaUltMod" id="fechaUltMod" value="<?php echo $params["ficha"]["ult_despa"] ?>"/>


<h4>Adoptante</h4>
<select name="selectAdoptante" id="selAdoptante">
<option value="0"></option>
</select>
</div>

<div>
<h4>Especie</h4>

<select name="selEspecie" id="selEspecie">

<?php foreach($params["especies"] as $especies){?>

<option value="<?php echo $especies["id"] ?>"<?php if($params["ficha"]["especie"]==$especies["nombre"]) echo "selected" ?>><?php echo $especies["nombre"] ?></option>

<?php
} 
?>
</select>
</div>

<div>
<h4>Raza</h4>

<select name="modSelRaza" id="modSelRaza">

<?php foreach($params["razas"] as $raza){?>

<option value="<?php echo $raza["id"] ?>"<?php if($params["ficha"]["raza"]==$raza["nombre"]) echo "selected" ?>><?php echo $raza["nombre"] ?></option>

<?php
} 
?>


</select>
</div>

<div>
<h4>Esterilizado</h4>
<div class="form-check">
    <input type="checkbox" class="form-check-input" id="ckEsterilizado" name="ckEsterilizado"<?php if($params["ficha"]["esterilizado"]=="si") echo "checked" ?>>
    
  </div>
<br>
</div>


<div>
 <h4>Nº Chip</h4>
<input type="text" name="numChip" id="numChip" value="<?php echo $params["ficha"]["numchip"] ?>"/>
</div>

<div>
<h4>Refugio</h4>

<select name="selRefugio" id="selRefugio" >

<?php foreach($params["refugios"] as $refugio){?>

<option value="<?php echo $refugio["id"] ?>"<?php if($params["ficha"]["refugio"]==$refugio)echo "selected" ?>><?php echo $refugio["nombre"] ?></option>

<?php
} 
?>
</select>
<br>
<br>
</div>

<h4>Comentarios</h4>
<textarea name="modComentarios" id="modComentarios" cols="70" rows="7"><?php echo $params["ficha"]["comentarios"] ?></textarea>

<h4>Descripción</h4>
<textarea name="modDescripcion" id="modDescripcion" cols="70" rows="7"><?php echo $params["ficha"]["descripcion"] ?></textarea>

<button class="btn btn-primary" type="submit" id="modificar" name="modificar">Modificar</button>

<hr>

</form>
<div class="envatra">
  <h4>Enfermedades</h4>
  <?php if($params["enfermedades"][0]["tipo"]!="Sin datos") :?>
  <?php for($i = 0;$i<count($params["enfermedades"]);$i++){
?>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="<?php echo 'cbxEnfermedad'.($i+1) ?>" name="cbxEnfermedad" value="<?php echo $params["enfermedades"][$i]["id"] ?>">
<label class="form-check-label" for="lblEnfermedades"><?php echo $params["enfermedades"][$i]["tipo"] ?></label>
</div>

<?php 
} 
?>
 <button type="button" class="btn btn-danger" id="btnEnfermedades" disabled="disabled">Eliminar</button> 

 <?php else: echo "Sin enfermedades" ?>
<?php endif; ?>
</div>
<br>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#enfermedadesModal">Asignar</button>  
 <div class="modal fade" id="enfermedadesModal" role="dialog" aria-labelledby="<?php switch (substr($params['ficha']['id'],0,1)) {
   case 'P':
     echo "1";
     break;
     case 'G':
     echo "2";
     break;
     case 'R':
     echo "3";
     break;
   
   
 } ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar enfermedad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btnAceptar" id="ins_enf">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<div class="envatra">
  <h4>Vacunas</h4>
  <?php if($params["vacunas"][0]["tipo"]!="Sin datos") :?>
  <?php for($i = 0;$i<count($params["vacunas"]);$i++){
?>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="<?php echo 'cbxVacunas'.($i+1) ?>" name="cbxVacunas" value="<?php echo $params["vacunas"][$i]["id"] ?>">
<label class="form-check-label" for="lblVacunas"><?php echo $params["vacunas"][$i]["tipo"] ?></label>
</div>

<?php 
} 
?>
 <button type="button" class="btn btn-danger" id="btnVacunas" disabled="disabled">Eliminar</button> 
 
 <?php else: echo "Sin enfermedades" ?>
<?php endif; ?>
</div>

<br>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#vacunasModal">Asignar</button>  
 <div class="modal fade" id="vacunasModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar vacuna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btnAceptar" id="ins_vac">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<div class="envatra">
  <h4>Tratamientos</h4>
  <?php if($params["tratamientos"][0]["tipo"]!="Sin datos") :?>
  <?php for($i = 0;$i<count($params["tratamientos"]);$i++){
?>
<div class="form-check">
<input type="checkbox" class="form-check-input" id="<?php echo 'cbxTratamientos'.($i+1) ?>" name="cbxTratamientos" value="<?php echo $params["tratamientos"][$i]["id"] ?>">
<label class="form-check-label" for="lblTratamientos"><?php echo $params["tratamientos"][$i]["tipo"] ?></label>
</div>

<?php 
} 
?>
 <button type="button" class="btn btn-danger" id="btnVacunas" disabled="disabled">Eliminar</button>
 
 
 <?php else: echo "Sin enfermedades" ?>
<?php endif; ?>
</div>
<br>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#tratamientosModal">Asignar</button>  
 <div class="modal fade" id="tratamientosModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar tratamiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btnAceptar" id="ins_trat">Aceptar</button>
      </div>
    </div>
  </div>
</div>
<!--MODAL ASIGNAR ENVATRA-->



 
<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>
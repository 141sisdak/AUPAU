<?php



ob_start() ?>


<h2>Ficha de: <h3><?php echo $params["ficha"]["nombre"]?></h3></h2>
<h4>Fecha de nacimiento</h4>
<?php $f = strtotime($params["ficha"]["fechaNac"]) ?>
<p><?php echo date("d-m-Y",$f)?></p>

<h4>Tamaño</h4>
<p><?php echo $params["ficha"]["tamanyo"] ?></p>

<h4>Localidad</h4>
<p><?php echo $params["ficha"]["localidad"] ?></p>

<h4>Refugio</h4>
<p><?php echo $params["ficha"]["refugio"] ?></p>

<h4>Sexo</h4>
<p><?php echo $params["ficha"]["sexo"] ?></p>

<h4>Edad</h4>
<p><?php echo $params["ficha"]["edad"] ?></p>

<h4>Fecha ingreso</h4>
<?php $f = strtotime($params["ficha"]["fechaIngreso"]) ?>
<p><?php echo date("d-m-Y",$f)?></p>

<h4>Estado de adopcion</h4>
<p><?php echo $params["ficha"]["estadoAdop"] ?></p>

<h4>Descripcion</h4>
<p><?php echo $params["ficha"]["descripcion"] ?></p>

<h4>Enfermedades</h4>
<?php for($i = 0;$i<count($params["enfermedades"]);$i++){
?>
<p><?php echo $params["enfermedades"][$i]["tipo"] ?></p>
<?php 
} 
?>
<h4>Tratamientos</h4>
<?php for($i = 0;$i<count($params["tratamientos"]);$i++){
?>
<p><?php echo $params["tratamientos"][$i]["tipo"] ?></p>
<?php 
} 
?>

<h4>Vacunas</h4>
<?php for($i = 0;$i<count($params["vacunas"]);$i++){
?>
<p><?php echo $params["vacunas"][$i]["tipo"] ?></p>
<?php 
} 
?>

<h4>Esterilizado</h4>
<p><?php echo $params["ficha"]["esterilizado"] ?></p>

<h4>Adoptante</h4>
<p><?php echo "hacer movida ADOPTANTE"; ?></p>

<h4>Comentarios</h4>
<p><?php echo $params["ficha"]["comentarios"] ?></p>

<h4>Nº Chip</h4>
<p><?php echo $params["ficha"]["numchip"] ?></p>

<h4>Ultima desparasitacion</h4>
<?php $f = strtotime($params["ficha"]["ult_despa"]) ?>
<p><?php echo date("d-m-Y",$f)?></p>

<h4>Raza</h4>
<p><?php echo $params["ficha"]["raza"] ?></p>

<h4>Especie</h4>
<p><?php echo $params["ficha"]["especie"] ?></p>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>
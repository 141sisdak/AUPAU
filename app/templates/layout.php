<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Información Alimentos</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="<?php echo 'css/'.Config::$mvc_vis_css ?>" />

</head>
<body>
<div id="cabecera">
<h1>Información de alimentos</h1>
</div>
<!-- INICIO usuarios registrados -->
<?php if(isset($_SESSION['user'])):?>
<hr>
<!-- INICIO datos usuario y tiempo -->
<div id="datosUser">
<?php include 'peticionAPI.php'?>
<!-- Obtenemos nombre de usuario a partir de la variable global session -->
<h3><strong>Nombre: <?php echo $_SESSION["user"]?></strong></h3>
<!-- Obtenemos la ciudad a partir de la variable global session -->
<!-- Hacemos una llamada a la función peticionApi para que nos devuleva la temperatura con el parámetro "temp" -->
<h3><strong>Temperatura actual en <?php echo $_SESSION["ciudad"]?>: <?php echo peticionApi("temp"). "ºC"?></strong></h3>
<!--  Hacemos una llamada a la función peticionApi para que nos devuleva la url del icono con el parámetro "cielo"-->
<h3 style="display: inline;"><strong>Estado del cielo: </strong></h3><img src="<?php echo peticionApi("cielo")?>"/>
<br>
<br>
<!-- Mediante este link cerraremos la sesión -->
<a href="index.php?ctl=cerrar" style="display: block;" id="cerrar">Cerrar sesión</a>
<!-- FIN datos usuario y tiempo -->
</div>
<div id="menu">
<hr/>
<a href="index.php?ctl=inicio">inicio</a> |
<a href="index.php?ctl=listar">ver alimentos</a> |
<a href="index.php?ctl=insertar">insertar alimento</a> |
<a href="index.php?ctl=buscar">buscar por nombre</a> |
<a href="index.php?ctl=buscarAlimentosPorEnergia">buscar por energia</a> |
<a href="index.php?ctl=buscarAlimentosCombinada">búsqueda combinada</a>
<hr/>
</div>
<?php endif; ?>
<!-- FIN usuarios registrados -->
<div id="contenido">
<?php echo $contenido ?>
</div>

<div id="pie">
<hr/>
<div align="center">- pie de página -</div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css"
	href="<?php echo 'css/'.Config::$mvc_vis_css ?>" />
</head>
<body style="margin: 0 auto;text-align: center;width: 40%">

	<fieldset style="margin-top: 50px">
		<form name="formLogin" action="index.php?ctl=login" method="POST">
		<?php if(isset($params['mensaje'])) :?>
<b><span style="color: red;"><?php echo $params['mensaje'] ?></span></b>
<?php endif; ?>
			<h1>Login</h1>
			<label for="nom">Nombre de usuario: </label>
			<input type="text" name="user" >
			<label for="password">Contraseña: </label>
			<input type="password" name="pass">
			<br><br><br>
			<input type="submit" name="enviarLogin">
		</form>
	</fieldset>
	<br>
	<br>
	<a href="index.php?ctl=registro">Registrarse</a>
</body>
</html>
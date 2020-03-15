
<?php ob_start() ?>
<form name="formLogin" action="index.php?ctl=login" method="post">
<label for="lblNombre">Usuario</label>
<input type="text" name="usuario"><br><br>

<label for="lblPassword">Password</label>
<input type="text" name="password"><br><br>

<input type="submit" value="Login" name="enviar">
</form>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>



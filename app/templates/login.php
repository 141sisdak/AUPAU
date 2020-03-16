
<?php ob_start() ?>
<form name="formLogin" action="index.php?ctl=login" method="post">

<label for="lblNombre">Usuario</label>
<input type="text" name="usuario" id="usuario" autofocus>
<span class="errorLogin" id="usuVacio">El campo no puede estar vacío</span>
<span class="errorLogin" id="usuIncorrecto">Valores introducidos incorrectos</span><br><br>

<label for="lblPassword">Password</label>
<input type="text" name="password" id="password">
<span class="errorLogin" id="passVacio">El campo no puede estar vacío</span>
<span class="errorLogin" id="passIncorrecto">Valores introducidos incorrectos</span>

 
<br><br>

<button type="submit" class="btn btn-primary"name="enviar" id="enviar">Enviar</button>
</form>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>



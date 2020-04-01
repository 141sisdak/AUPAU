
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
<form name="formLogin" action="index.php?ctl=login" method="post" id="formLogin">

<label for="lblNombre">Usuario</label>
<input type="text" name="usuario" id="usuario" autofocus>
<span class="errorValidacion" id="usuVacio">El campo no puede estar vacío</span>
<span class="errorValidacion" id="usuIncorrecto">Valores introducidos incorrectos</span><br><br>

<label for="lblPassword">Password</label>
<input type="text" name="password" id="password">
<span class="errorValidacion" id="passVacio">El campo no puede estar vacío</span>
<span class="errorValidacion" id="passIncorrecto">Valores introducidos incorrectos</span>

 
<br><br>

<button type="submit" class="btn btn-primary"name="enviar" id="enviar">Enviar</button>
</form>

<?php $contenido = ob_get_clean() ?>
<?php include 'layout.php' ?>



<?php 
require_once __DIR__ . '/../app/Model.php';
//Si el numero de pagina 
$pagina = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;

$regsPagina = 5;
//Si la pagina a la que se quiere acceder no es la 1 empezaremos por el 0
$inicio = ($pagina > 1) ? (($pagina * $regsPagina)-$regsPagina):0;

$m = new Model();

 


?>
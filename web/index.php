<?php
// web/index.php
// carga del modelo y los controladores
require_once __DIR__ . '/../app/Config.php';
require_once __DIR__ . '/../app/Model.php';
require_once __DIR__ . '/../app/Controller.php';



session_start();
//Si todavía no se ha iniciado sesión inicializamos la variable sesion(rol) a 0 para que pueda acceder a login y registro
if(!isset($_SESSION["user"])){
    $_SESSION["rol"] = 0;
}

//Comprobamos si esta definida la sesión 'tiempo'.
if(isset($_SESSION['tiempo']) ) {
    
    //Tiempo en segundos para dar vida a la sesión.
    $inactivo = 900;//15min
    
    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];
    
    //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
    if($vida_session > $inactivo)
    {
        //Removemos sesión.
        session_unset();
        //Destruimos sesión.
        session_destroy();
        //Redirigimos pagina.
        header("Location: index.php?ctl=login");
        
        exit();
    }
} else {
    //Activamos sesion tiempo.
    $_SESSION['tiempo'] = time();
}

// enrutamiento
$map = array(
    
    'inicio' => array(
        'controller' => 'Controller',
        'action' => 'inicio',
        'nivel' =>1
    ),
    'login'=>array(
        'controller'=>'loginController',
        'action'=>'login',
        'nivel'=> 0
    )
    
);
// Parseo de la ruta
if (isset($_GET['ctl'])) {
    if (isset($map[$_GET['ctl']])) {
        $ruta = $_GET['ctl'];
    } else {
        //página a la que el usuario ha intentado acceder en caso de que no exista
          
    }
} else {
    $ruta = 'login';
}
$controlador = $map[$ruta];


if (method_exists($controlador['controller'], $controlador['action']) && $controlador["nivel"]<=$_SESSION["rol"]) {
    
    call_user_func(array(
        new $controlador['controller'](),
        $controlador['action']
        
    ));
} else {
    //Si el usuario no tiene permiso para acceder a la páquina guardamos el registro en un archivo con su nombre,
    //la fecha y la página tanto si ha iniciado sesión como si no.
    if($_SESSION["rol"]<=$controlador["nivel"]){
       
        header("Status: 403 Forbidden");
        echo "<html><body><h1>No tienes permisos suficientes para realizar esa acción</h1><a href='index.php?ctl=inicio'>Volver</a></body></html>";
        
    }else{
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: El controlador <i>' .
            $controlador['controller'] .
            '->' .
            $controlador['action'] .
            '</i> no existe</h1></body></html>';
            
    }
    
}
?>
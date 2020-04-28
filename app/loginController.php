<?php
include('libs/utils.php');
include('libs/Validacion.php');

class loginController{
    
    public function login()
    {
        try {
            
            $params = array(
                'usuario' => '',
                'password' => ''
            );
            //Si se ha pulsado sobre el boton enviar y se ha enviado el usuario y el password
            if (isset($_POST["enviar"]) && isset($_POST["usuario"]) && isset($_POST["password"])) {
                
                $datos = array();
                
                //Llamamos a la funcion recoge que sanitiza los datos de entrada
                $datos["usuario"]  = recoge("usuario");
                $datos["password"] = recoge("password");
                
                //Creamos un nuevo objeto validacion para poder usar sus funciones
                $validacion = new Validacion();
                
                $regla = array(
                    array(
                        'name' => 'usuario',
                        'regla' => 'no-empty,usuario'
                    ),
                    array(
                        'name' => 'password',
                        //se llama a password 2 para que nos deje meter una contraseña de 3 caracteres.
                        'regla' => 'no-empty,password2'
                    )
                );
                //pasamos a validar los datos
                $validaciones = $validacion->rules($regla, $datos);
                
                //Si no ha habido ningun error procedemos a la validacion del login
                if ($validaciones === true) {

                    $m = new Model();
                    //validaLogin devuelve true si en la consulta hay un resultado distinto de 0
                    if ($resultado = $m->validaLogin($datos["usuario"], $datos["password"])) {
                        
                        $_SESSION["usuario"] = $resultado["usuario"];
                        $_SESSION["rol"]     = $resultado["rol"];
                        
                        //Si ha ido todo bien redireccionamos a la pagina de inicio
                        header("Location: index.php?ctl=inicio");
                    } else {
                        //Si no pasamos un mensaje con el error 
                        $params["mensaje"] = "Usuario o contraseña incorrectos";
                    }
                }
                
            }
            //Cargamos la plnatilla login.php
            require __DIR__ . "/templates/login.php";
            
        }
        catch (Exception $e) {
            error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
        }
        catch (Error $e) {
            error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
        //header('Location: index.php?ctl=error');
        }
    }

}
?>
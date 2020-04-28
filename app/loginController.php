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
            
            if (isset($_POST["enviar"]) && isset($_POST["usuario"]) && isset($_POST["password"])) {
                
                $datos = array();
                
                
                $datos["usuario"]  = recoge("usuario");
                $datos["password"] = recoge("password");
                
                $validacion = new Validacion();
                
                $regla = array(
                    array(
                        'name' => 'usuario',
                        'regla' => 'no-empty,usuario'
                    ),
                    array(
                        'name' => 'password',
                        'regla' => 'no-empty,password2'
                    )
                );
                
                $validaciones = $validacion->rules($regla, $datos);
                
                if ($validaciones === true) {
                    $m = new Model();
                    if ($resultado = $m->validaLogin($datos["usuario"], $datos["password"])) {
                        
                        $_SESSION["usuario"] = $resultado["usuario"];
                        $_SESSION["rol"]     = $resultado["rol"];
                        
                        
                        header("Location: index.php?ctl=inicio");
                    } else {
                        $params["mensaje"] = "Usuario o contraseña incorrectos";
                    }
                }
                
            }
            
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
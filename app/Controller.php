<?php
include ('libs/utils.php');
include ('libs/Validacion.php');

class Controller
{
    
    public function login()
    {
        try {

            if(isset($_POST["enviar"])){



            }

            require __DIR__ . "/templates/login.php";
        
        } catch (Exception $e) {
            error_log("Excepcion producida el ". date("d-m-YY") . " a las " .date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log("Error producido el ". date("d-m-YY") . " a las " .date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
        }
    }
}

?>

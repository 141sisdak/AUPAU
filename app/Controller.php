<?php
include ('libs/utils.php');
include ('libs/Validacion.php');

class loginController
{
    
    public function login()
    {
        try {
        
        } catch (Exception $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
        } catch (Error $e) {
            error_log($e->getMessage() . microtime() . PHP_EOL, 3, "logError.txt");
            //header('Location: index.php?ctl=error');
        }
    }
}

?>

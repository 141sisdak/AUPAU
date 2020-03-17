<?php
include_once ('Config.php');

class Model extends PDO
{

    protected $conexion;

    public function __construct()
    {
        $this->conexion = new PDO('mysql:host=' . Config::$mvc_bd_hostname . ';dbname=' . Config::$mvc_bd_nombre . '', Config::$mvc_bd_usuario, Config::$mvc_bd_clave);
        // Realiza el enlace con la BD en utf-8
        $this->conexion->exec("set names utf8");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function validaLogin($usuario, $password){
        $select = $this->conexion->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND password = :pass");

        $select->bindValue(":usuario",$usuario);
        $select->bindValue(":pass", $password);

        $select->execute();

        $num_reg = $select->rowCount();

        if($num_reg ==0){
            return false;
        }else{
            return $select->fetch();
        }

    }
    
   
}
?>

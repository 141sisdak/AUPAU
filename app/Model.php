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
        $select = $this->conexion->prepare("SELECT usuario, rol FROM usuarios WHERE usuario = :usuario AND password = :pass");

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

    public function getRescates(){
        $select = $this->conexion->query("SELECT 
        F.id,
        F.nombre,
        F.fechaNac,
        F.edad,
        F.fechaIngreso,
        F.estadoAdop,
        F.esterilizado,
        F.numchip,
        F.ult_despa,
        E.nombre as especie,        
        T.tamanyo,
        RA.nombre as raza,
        L.localidad,
        R.nombre as refugio
        FROM 
        ficha_animal F 
        INNER JOIN especie E ON F.especie = E.id 
        INNER JOIN tamanyos T ON F.tamanyo = T.id
        INNER JOIN localidades L ON  F.localidad = L.id
        INNER JOIN refugios R ON F.refugio = R.id
        INNER JOIN raza RA ON F.especie = RA.id"
    );
        return $select->fetchAll();
        

    }

    public function getEnfermedades($id){
        $select = $this->conexion->query("SELECT E.enfermedad as tipo
        FROM enfermedades_animal A INNER JOIN enfermedades E 
        ON A.id_enfermedad = E.id 
        WHERE A.id_animal='".$id."'");

        $select->execute();

        $numRows = $select->rowCount();

        if($numRows>0){
            return $select->fetchAll();
        }else{
            return false;
        }

       
    }

    public function getVacunas($id){
        $select = $this->conexion->query("SELECT V.nombre AS tipo 
        FROM vacunas_animal A 
        INNER JOIN vacunas V 
        ON A.id_vacuna = V.id WHERE 
        A.id_animal='".$id."'");

        $select->execute();

        $numRows = $select->rowCount();

        if($numRows>0){
            return $select->fetchAll();
        }else{
            return false;
        }
    }

    public function getTratamientos($id){
        $select = $this->conexion->query("SELECT T.tratamiento AS tipo
        FROM tratamientos_animal A
        INNER JOIN tratamientos T
        ON A.id_tratamiento = T.id
        WHERE A.id_animal ='".$id."'");

        $select->execute();

        $numRows = $select->rowCount();

        if($numRows>0){
            return $select->fetchAll();
        }else{
            return false;
        }
    }

    public function getAnimal($id){
        $select = $this->conexion->query("SELECT 
        F.id,
        F.nombre,
        F.fechaNac,
        F.edad,
        F.fechaIngreso,
        F.estadoAdop,
        F.esterilizado,
        F.numchip,
        F.sexo,
        F.descripcion,
        F.comentarios,
        F.ult_despa,
        E.nombre as especie,        
        T.tamanyo,
        L.localidad,
        R.nombre as refugio,
        RA.nombre as raza
        FROM 
        ficha_animal F 
        INNER JOIN especie E ON F.especie = E.id 
        INNER JOIN tamanyos T ON F.tamanyo = T.id
        INNER JOIN localidades L ON  F.localidad = L.id
        INNER JOIN refugios R ON F.refugio = R.id
        INNER JOIN raza RA ON F.raza = RA.id
        WHERE F.id = '".$id."'");

        $select->execute();

        return $select->fetch();
    }


    
   
}
?>

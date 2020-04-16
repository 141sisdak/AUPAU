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

    public function getRescates($inicio, $regsPagina, $ordenacion){
       $query = "SELECT 
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
       INNER JOIN raza RA ON F.especie = RA.id
       WHERE activo = 1";
       

        if($ordenacion!=""){

            $query.=$ordenacion;
            
        }

        $query.=" LIMIT $inicio, $regsPagina";
        
        $select = $this->conexion->query($query);
        return $select->fetchAll();
        

    }

    public function getRescatesTotal(){
        $select = $this->conexion->query("SELECT id FROM ficha_animal WHERE activo = 1");

        $select->execute();

        return $select->rowCount();
    }

    public function getRescatesFiltro($sql,$inicio,$regsPagina, $ordenacion){

       
if($ordenacion !=""){
    $sql.=$ordenacion;
}
        $sql.=" limit $inicio,$regsPagina";

        $select = $this->conexion->query($sql);

        $select->execute();

        $numRows = $select->rowCount();

        if($numRows>0){
            return $select->fetchAll();
        }else{
            return false;
        }
    }

    public function getRescatesTotalFiltro($sql){
        if(isset($_GET["filtrar"])=='on'){
            $sql = $_COOKIE["consulta"];
        }
        $select = $this->conexion->query($sql);

        $select->execute();

        return $select->rowCount();
    }

    public function getEnfermedadesPorId($id){
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

    public function getVacunasPorId($id){
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

    public function getTratamientosPorId($id){
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

    public function getTamanyos(){

        $select = $this->conexion->query("SELECT * FROM tamanyos");

        $select->execute();

        return $select->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getLocalidades(){

        $select = $this->conexion->query("SELECT * FROM localidades");

        $select->execute();

        return $select->fetchAll(PDO::FETCH_ASSOC);

    }

   public function getEspecies(){

    $select = $this->conexion->query("SELECT * FROM especie");

    $select->execute();

    return $select->fetchAll(PDO::FETCH_ASSOC);
   }

   public function getRazas(){

    $select = $this->conexion->query("SELECT * FROM raza");

    $select->execute();

    return $select->fetchAll(PDO::FETCH_ASSOC);
   }

   public function getRazasPorEspecie($idEspecie){

    $select = $this->conexion->query("SELECT * FROM raza WHERE especie = $idEspecie AND id <> 1 order by nombre");

    $select->execute();

    return $select->fetchAll(PDO::FETCH_ASSOC);

   }

   public function getRefugios(){

    $select = $this->conexion->query("SELECT * FROM refugios");

    $select->execute();

    return $select->fetchAll(PDO::FETCH_ASSOC);
   }

   public function insertarRescate($datos){
       $insert= $this->conexion->prepare("INSERT INTO ficha_animal 
       (id, comentarios, descripcion, edad, especie, estadoAdop, fechaIngreso, fechaNac, ult_despa, esterilizado, nombre, numchip, raza, refugio, tamanyo, sexo, activo) 
       VALUES (:id,:comentarios,:descripcion,:edad,:especie,:estadoAdop,:fechaIngreso,:fechaNac,:ult_despa,:esterilizado,:nombre,:numchip,:raza,:refugio,:tamanyo,:sexo,:activo )");

       $insert->bindValue(":id",$datos["id"]);
       $insert->bindValue(":comentarios",$datos["comentarios"]);
       $insert->bindValue(":descripcion",$datos["descripcion"]);
       $insert->bindValue(":edad",$datos["edad"]);
       $insert->bindValue(":especie",$datos["especie"]);
       $insert->bindValue(":estadoAdop",$datos["estadoAdop"]);
       $insert->bindValue(":fechaIngreso",$datos["fechaIng"]);
       $insert->bindValue(":fechaNac",$datos["fechaNac"]);
       $insert->bindValue(":ult_despa",$datos["fechaDesp"]);
       $insert->bindValue(":esterilizado",$datos["esterilizado"]);
       $insert->bindValue(":nombre",$datos["nombre"]);
       $insert->bindValue(":numchip",$datos["numChip"]);
       $insert->bindValue(":raza",$datos["raza"]);
       $insert->bindValue(":refugio",$datos["refugio"]);
       $insert->bindValue(":tamanyo",$datos["tamanyo"]);
       $insert->bindValue(":sexo",$datos["sexo"]);
       $insert->bindValue(":activo","1");
        

       $insert->execute();
   }

   function obtenerUltimoIdRescate($especie){
        $select = $this->conexion->query("SELECT id
         FROM ficha_animal 
         WHERE especie = $especie 
         ORDER BY SUBSTRING(id, 1, 2), CAST(SUBSTRING(id, 3, LENGTH(id)) AS UNSIGNED) DESC 
         LIMIT 1");
        $select->execute();
        return $select->fetch(PDO::FETCH_ASSOC);
   }

   function getEnfermedades(){
       $select = $this->conexion->query("SELECT * FROM enfermedades");
       $select->execute();
       return $select->fetchAll(PDO::FETCH_ASSOC);

   }

   function getTratamientos(){
    $select = $this->conexion->query("SELECT * FROM tratamientos");
    $select->execute();
    return $select->fetchAll(PDO::FETCH_ASSOC);

}

    function getVacunas(){
        $select = $this->conexion->query("SELECT * FROM vacunas");
    $select->execute();
    return $select->fetchAll(PDO::FETCH_ASSOC);
    }
   
    function insertarEnfermedadesAnimal($id, $enfermedades){
                
        foreach($enfermedades as $enfermedad){
            $insert = $this->conexion->query("INSERT INTO enfermedades_animal (id_animal, id_enfermedad) VALUES ('$id','$enfermedad')");
        }
    }
    function insertarVacunasAnimal($id, $vacunas){
        foreach($vacunas as $vacuna){
            $insert = $this->conexion->query("INSERT INTO enfermedades_animal (id_animal, id_enfermedad) VALUES ('$id','$vacuna')");
            
        }
    }
    function insertarTratamientosAnimal($id, $tratamientos){
                
        foreach($tratamientos as $tramiento){
            $insert = $this->conexion->query("INSERT INTO enfermedades_animal (id_animal, id_enfermedad) VALUES ('$id','$tramiento')");
        }

        
    }
    
   
}
?>
  
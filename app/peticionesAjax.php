<?php 
require_once __DIR__ . '/../app/Model.php';

$json = array();
$m = new Model();

// I - Esta parte del codigo actua cuando hacemos click sobre los desplegables de la tabla de los rescastes
if(isset($_GET["idAnimal"])){

    header('Content-type: application/json');



    switch($_GET["tipoPeticion"]){
        case "enfermedades":
            if( $json= $m->getEnfermedadesPorId($_GET["idAnimal"])){
            
                echo json_encode($json);
            }else{
                echo json_encode(false);
            }
        
        break;
        case "vacunas":
            if( $json= $m->getVacunasPorId($_GET["idAnimal"])){
            
                echo json_encode($json);
            }else{
                echo json_encode(false);
            }
        
        break;
        case "tratamientos":
            if( $json= $m->getTratamientosPorId($_GET["idAnimal"])){
            
                echo json_encode($json);
            }else{
                echo json_encode(false);
            }
        
        break;
    
    }
}
// F - Esta parte del codigo actua cuando hacemos click sobre los desplegables de la tabla de los rescastes

if(isset($_GET["especie"])){
    $json =array();

    if($json = $m->getRazasPorEspecie($_GET["especie"])){
        echo json_encode($json);
    }else{
        echo json_encode(false);
    }

}
// I - Se ejecuta cuando seleccionamos algun envatra a la hora de modificar rescate
if(isset($_POST["checked"])){
    $checked = json_decode($_POST["checked"]);

    $id = $_POST["id_resc"];
    $tipo = $_POST["envatra_tipo"];

    if($m->eliminarEnvatra($id, $checked, $tipo)){
        return "ok";
    }

}

if(isset($_GET["getEnvatra"])){
    $json =array();
    switch ($_GET["getEnvatra"]) {
        case 'enfermedades':
            $json = $m->getEnfermedades($_GET["getEnvatra"]);
            break;
        case 'vacunas':
            $json = $m->getVacunas($_GET["getEnvatra"]);
            break;
        case 'tratamientos':
            $json = $m->getTratamientos($_GET["getEnvatra"]);
            break;
    }
//Si no se le pasa algo por parámetro da error :S
    if($json){
        echo json_encode($json);
    }else{
        echo json_encode(false);
    }
}

if(isset($_POST["ins_envatra"])){

    $select = json_decode($_POST["select"]) ;

    switch ($_POST["ins_envatra"]) {
        case 'ins_enf':
            $m->insertarEnfermedadesAnimal($_POST["idRescate"], $select);
            break;

        case 'ins_vac':
            $m->insertarVacunasAnimal($_POST["idRescate"], $select);
            break;

        case 'ins_trat':
            $m->insertarTratamientosAnimal($_POST["idRescate"], $select);
            break;
        
       
    }
    return "ok";
   
}
?>


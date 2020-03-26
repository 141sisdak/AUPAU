<?php 
require_once __DIR__ . '/../app/Model.php';
$json = array();
$m = new Model();
if(isset($_GET["id"])){

header('Content-type: application/json');



switch($_GET["tipoPeticion"]){
    case "enfermedades":
        if( $json= $m->getEnfermedades($_GET["id"])){
           
            echo json_encode($json);
        }else{
            echo json_encode(false);
        }
      
    break;
    case "vacunas":
        if( $json= $m->getVacunas($_GET["id"])){
           
            echo json_encode($json);
        }else{
            echo json_encode(false);
        }
      
    break;
    case "tratamientos":
        if( $json= $m->getTratamientos($_GET["id"])){
           
            echo json_encode($json);
        }else{
            echo json_encode(false);
        }
      
    break;
    

    
}
}

if(isset($_GET["especie"])){
    $json =array();

    if($json = $m->getRazasPorEspecie($_GET["especie"])){
        echo json_encode($json);
    }else{
        echo json_encode(false);
    }

}
?>


<?php

// Aqui pondremos las funciones de validación de los campos

//SIN ACENTOS??????????????????????
function validarDatos($n, $e, $p, $hc, $f, $g)
{
    return (is_string($n) & is_numeric($e) & is_numeric($p) & is_numeric($hc) & is_numeric($f) & is_numeric($g));
}

function recoge($var)
{
    if (isset($_REQUEST[$var]))
        $tmp = strip_tags(sinEspacios($_REQUEST[$var]));
    else
        $tmp = "";

    return $tmp;
}

function sinEspacios($frase)
{
    $texto = trim(preg_replace('/ +/', ' ', $frase));
    return $texto;
}

function enviaEmail(){
    $cuerpo="Bienvenido al sistema";
    $from = "alexdaw@gmail.com";
    $to = "alejandroherpal@gmail.com";
    $subject = "Bienvenido!";
    $message = $cuerpo;
    $headers= "From:" . $from;
    mail($to,$subject,$message, $headers);
}

//Funcion que busca valores null en el array y cambia el valor de la clave a "Sin datos"
function setearNulos($params){
    
    foreach ($params as $key=>&$valor) {
        if($valor==null){
            $valor = "Sin datos";
        }
    }

    return $params;
}

function setearNulosTabla(&$params){

    foreach($params as &$campo){
        foreach($campo as &$valor){
         if($valor==null){
           $valor = "Sin datos";
         }
        
        }
       }

    return $params;

}


?>
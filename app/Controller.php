<?php
include('libs/utils.php');
include('libs/Validacion.php');

class Controller
{
    public function inicio()
    {
        require __DIR__ . "/templates/inicio.php";
    }
    
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
    public function verAnimal()
    {
        if (isset($_GET["id"])) {
            
            $params = array(
                'ficha' => array(),
                'enfermedades' => array(),
                'vacunas' => array(),
                'tratamientos' => array()
            );
            
            try {
                
                $m = new Model();
                
                $params["ficha"] = setearNulos($m->getAnimal($_GET["id"]));
                
                if (!$params["enfermedades"] = $m->getEnfermedadesPorId($_GET["id"])) {
                    $params["enfermedades"][0]["tipo"] = "Sin datos";
                }
                
                if (!$params["tratamientos"] = $m->getTratamientosPorId($_GET["id"])) {
                    $params["tratamientos"][0]["tipo"] = "Sin datos";
                }
                
                if (!$params["vacunas"] = $m->getVacunasPorId($_GET["id"])) {
                    $params["vacunas"][0]["tipo"] = "Sin datos";
                }
                
            }
            catch (Exception $e) {
                error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
                //header('Location: index.php?ctl=error');
            }
            catch (Error $e) {
                error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
            }
           
                require __DIR__ . "/templates/fichaAnimal.php";
           
            
        }
    }
    
   
    
    public function rescate()
    {
        

        $pagina = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;

        $regsPagina = 5;

        $inicio = ($pagina>1) ? (($pagina * $regsPagina)- $regsPagina) :0;
        
        $m = new Model();

        $ordenacion = "";
        

        if(isset($_GET["ordenacion"])){
            
        switch ($_GET["ordenacion"]) {
            case 'fechaNac':
                $ordenacion = "  ORDER BY fechaNac";
                break;
            case 'fechaIng':
                $ordenacion = " ORDER BY fechaIngreso";
                break;
            case 'fechaDesp':
                $ordenacion = " ORDER BY ult_despa";
                break;
            case 'edad':
                $ordenacion = " ORDER BY edad";
                break;
            case 'nombre':
                $ordenacion = " ORDER BY nombre";
                break;
        
        }
       
    }

        $params = array(
            'tamanyos' => $m->getTamanyos(),
            'localidades' => $m->getLocalidades(),
            'especies' => $m->getEspecies(),
            'razas' => $m->getRazas(),
            'refugios' => $m->getRefugios(),
            'tratamientos'=> $m->getTratamientos(),
            'vacunas'=>$m->getVacunas(),
            'enfermedades' => $m->getEnfermedades()
        );
        
        try {
            if($params["animales"] = $m->getRescates($inicio, $regsPagina, $ordenacion)){

                setearNulosTabla($params["animales"]);

                $params["totalRegistros"] = $m->getRescatesTotal();                
                $params["numPaginas"] = round($params["totalRegistros"] / $regsPagina);
                $params["pagina"] = $pagina;
                $params["filtro"]='off';
               

              
                
            } else {
                $params["mensaje"] = "No existen rescates";
            }
            
        }
        catch (Exception $e) {
            error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
        }
        catch (Error $e) {
            error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
        //header('Location: index.php?ctl=error');
        }
        
        require __DIR__ . "/templates/rescate.php";
    }
    
   
    
    public function filtroRescate()
    {
        
        try {
            $pagina = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;

            $regsPagina = 3;
    
            $inicio = ($pagina>1) ? (($pagina * $regsPagina)- $regsPagina) :0;
            
           
                $m = new Model();
                $params = array(
                    'fechaNacDesde' => '',
                    'fechaNacHasta' => '',
                    'nombre' => '',
                    'tamanyo' => '',
                    'localidad' => '',
                    'sexo' => '',
                    'edad' => '',
                    'fechaIngDesde' => '',
                    'fechaIngHasta' => '',
                    'estadoAdop' => '',
                    'ulDespDesde' => '',
                    'ulDespHasta' => '',
                    'ulDespDesde' => '',
                    'adoptante' => '',
                    'especie' => '',
                    'esterilizado' => '',
                    'numChip' => '',
                    'refugio' => '',
                    'tamanyos' => $m->getTamanyos(),
                    'localidades' => $m->getLocalidades(),
                    'especies' => $m->getEspecies(),
                    'razas' => $m->getRazas(),
                    'refugios' => $m->getRefugios(),
                    'filtro'=>'on'
                );
                $sql = "SELECT 
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
            WHERE activo = 1 ";
                
               
                              
                
                if (!empty($_POST["fechaNacDesde"]) && !empty($_POST["fechaNacHasta"])) {
                    if (validarFechas($_POST["fechaNacDesde"], $_POST["fechaNacHasta"])) {
                        $params["fechaNacDesde"] = $_POST["fechaNacDesde"];
                        $params["fechaNacHasta"] = $_POST["fechaNacHasta"];
                        $sql .= "AND fechaNac BETWEEN '" . $_POST["fechaNacDesde"] . "' AND '" . $_POST["fechaNacHasta"] . "'";
                    } else {
                        $params["mensaje"] = "Valores de fechas incorrectos";
                        
                    }
                }
                
                if (!empty($_POST["nombre"])) {
                    $params["nombre"] = recoge("nombre");
                    $sql .= "AND F.nombre ='" . $params["nombre"] . "'";
                }
                
                if (isset($_POST["selLocalidad"])) {
                    $params["selLocalidad"] = $_POST["selLocalidad"];
                    $sql .= "AND F.localidad ='" . $_POST["selLocalidad"] . "'";
                }
                if (isset($_POST["selTamanyo"])) {
                    $params["selTamanyo"] = $_POST["selTamanyo"];
                    $sql .= "AND F.tamanyo ='" . $_POST["selTamanyo"] . "'";
                }
                
                if (isset($_POST["radioSexo"])) {
                    $params["sexo"] = $_POST["radioSexo"];
                    $sql .= "AND sexo ='" . $_POST["radioSexo"] . "'";
                }
                
                if (!empty($_POST["edad"])) {
                    $params["edad"] = recoge("edad");
                    $sql .= "AND edad ='" .$params["edad"] . "'";
                }
                
                if (!empty($_POST["fechaIngDesde"]) && !empty($_POST["fechaIngHasta"])) {
                    $params["fechaIngDesde"] = $_POST["fechaIngDesde"];
                    $params["fechaIngHasta"] = $_POST["fechaIngHasta"];
                    $sql .= "AND fechaIngreso BETWEEN '" . $_POST["fechaIngDesde"] . "' AND '" . $_POST["fechaIngHasta"] . "'";
                }
                
                if (isset($_POST["radioAdoptado"])) {
                    $params["estadoAdop"] = $_POST["radioAdoptado"];
                    $sql .= "AND F.estadoAdop='" . $_POST["radioAdoptado"] . "'";
                }
                
                if (!empty($_POST["fechaUltDesde"]) && !empty($_POST["fechaUltHasta"])) {
                    $params["fechaUltDesde"] = $_POST["fechaUltDesde"];
                    $params["fechaUltHasta"] = $_POST["fechaUltHasta"];
                    $sql .= "AND ult_despa BETWEEN '" . $_POST["fechaUltDesde"] . "' AND '" . $_POST["fechaUltHasta"] . "'";
                }
                
                if (isset($_POST["selectAdoptante"])) {
                    $params["selectAdoptante"] = $_POST["selectAdoptante"];
                    $sql .= "AND adoptante ='" . $_POST["selectAdoptante"] . "'";
                }
                
                if (isset($_POST["selEspecie"])) {
                    $params["selEspecie"] = $_POST["selEspecie"];
                    $sql .= "AND F.especie ='" . $_POST["selEspecie"] . "'";
                }
                
                if (isset($_POST["selRaza"])) {
                    $params["selRaza"] = $_POST["selRaza"];
                    $sql .= "AND F.raza ='" . $_POST["selRaza"] . "'";
                }
                
                if (isset($_POST["ckEsterilizado"])) {
                    $params["ckEsterilizado"] = $_POST["ckEsterilizado"];
                    if($_POST["ckEsterilizado"]=="on"){
                        $sql .= "AND esterilizado ='si'";
                    }
                   
                }
                
                if (!empty($_POST["numChip"])) {
                    $params["numChip"] = recoge("numChip");
                    $sql .= "AND numChip ='" . $params["numChip"] . "'";
                }
                
                if (isset($_POST["selRefugio"])) {
                    $params["selRefugio"] = $_POST["selRefugio"];
                    $sql .= "AND refugio ='" . $_POST["selRefugio"] . "'";
                }
              
                $validacion = new Validacion();
                
                $regla = array(
                    array(
                        'name' => 'nombre',
                        'regla' => 'letras'
                    ),
                    array(
                        'name' => 'edad',
                        'regla' => 'numeric'
                    )
                );
                $validaciones = $validacion->rules($regla, $params);

                                 
                if ($validaciones === true) {

                  if(isset($_POST["filtrar"])){
                    setcookie("consulta", $sql, 0, "/");
                  }
                      
                  

                    $ordenacion = "";
                    if(isset($_GET["ordenacion"])){
            
                        switch ($_GET["ordenacion"]) {
                            case 'fechaNac':
                                $ordenacion = " ORDER BY fechaNac";
                                break;
                            case 'fechaIng':
                                $ordenacion = " ORDER BY fechaIngreso";
                                break;
                            case 'fechaDesp':
                                $ordenacion = " ORDER BY ult_despa";
                                break;
                            case 'edad':
                                $ordenacion = " ORDER BY edad";
                                break;
                            case 'nombre':
                                $ordenacion = " ORDER BY nombre";
                                break;
                        
                        }
                       
                        $params["animales"] = $m->getRescatesFiltro($_COOKIE["consulta"],$inicio,$regsPagina,$ordenacion);
                        error_log($_COOKIE["consulta"]);
                       
                    }else{
                        if (!$params["animales"] = $m->getRescatesFiltro($sql,$inicio,$regsPagina, $ordenacion)) {
                        
                            $params["mensajeTabla"]  = "No se han producido resultados en la búsqueda";
                            $params["animales"] = array();
                           
                        }
                    }
                   
                    
                    setearNulosTabla($params["animales"]);
                    $params["totalRegistros"] = $m->getRescatesTotalFiltro($sql);
                    $params["numPaginas"] = ceil($params["totalRegistros"] / $regsPagina);
                    $params["pagina"] = $pagina;
                    $params["filtro"]="on";
                   
                }else{
                    $params["mensaje"]= "Error en datos introducidos en el formulario";
                    
                }
            
                        
        }
        catch (Exception $e) {
            error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . "///SQL: " . $sql . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
        }
        catch (Error $e) {
            error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
        //header('Location: index.php?ctl=error');
        }
        
        
        require __DIR__ . "/templates/rescate.php";
        
    }
    public function nuevoRescate(){

        if(isset($_POST["nSelEspecie"])){

            $m = new Model();

            $datos["nombre"]  = recoge("nNombre");
            $datos["fechaNac"] = $_POST["nFechaNac"];
            $datos["fechaIng"] = $_POST["nFechaIng"];
            $datos["fechaDesp"] = $_POST["nUlt_desp"];
            $datos["edad"] = recoge("nEdad");
            $datos["localidad"] = isset($_POST["nSelLocalidad"]) ? $_POST["nSelLocalidad"] : null; 
            $datos["esterilizado"] = isset($_POST["nCkEsterilizado"]) ? "si" : null; 
            $datos["estadoAdop"] = isset($_POST["nChAdoptado"]) ? $_POST["nChAdoptado"] : null;
            $datos["numChip"] = recoge("nNumchip");
            $datos["refugio"] = isset($_POST["nSelRefugio"]) ? $_POST["nSelRefugio"] : null;
            $datos["tamanyo"] = isset($_POST["nSelTamanyo"]) ? $_POST["nSelTamanyo"] : null;
            $datos["sexo"] = isset($_POST["nRadioSexo"]) ? $_POST["nRadioSexo"] : null;
            $datos["especie"] = $_POST["nSelEspecie"];
            $datos["raza"] = isset($_POST["nSelRaza"]) ? $_POST["nSelRaza"] : null;
            $datos["descripcion"] = recoge("nDescripcion");
            $datos["comentarios"] = recoge("nComentarios");


            foreach($datos as &$dato){
                if($dato==""){
                    $dato =null;
                }
            }

            
            $validacionNuevoRescate = new Validacion();
            
            $regla = array(
                array(
                    'name' => 'nombre',
                    'regla' => 'letras'
                ),
                array(
                    'name' => 'edad',
                    'regla' => 'numeric'
                ),
                array(
                    'name' => 'numChip',
                    'regla' => 'numeric,chip'
                )
            );
            
            $validaciones = $validacionNuevoRescate->rules($regla, $datos);
                    
                    if ($validaciones === true) {
                       
                        
                        $id = $m->obtenerUltimoIdRescate($datos["especie"]);
                        $UltId = (int)substr($id["id"],2);
                        $UltId++;
                        switch ($datos["especie"]) {
                           
                            case '1':
                                $id="P-".$UltId;
                                break;
                            case '2':
                                $id="G-".$UltId;
                                break;
                            case '3':
                                $id="R-".$UltId;
                                break;
                        }
                        $datos["id"]= $id;
                        
                        if(isset($_POST["nSelEnfermedades"])){
                            $enfermedades = array();
                            foreach($_POST["nSelEnfermedades"] as $enfermedad){
                             array_push($enfermedades, $enfermedad);
                            }
                            $m->insertarEnfermedadesAnimal($datos["id"], $enfermedades);
                        }
                        if(isset($_POST["nSelVacunas"])){
                         $vacunas = array();
                         foreach($_POST["nSelVacunas"] as $vacuna){
                          array_push($vacunas, $vacuna);
                         }
                         $m->insertarVacunasAnimal($datos["id"], $vacunas);
                     }
             
                     if(isset($_POST["nSelTratamientos"])){
                         $tratamientos = array();
                         foreach($_POST["nSelTratamientos"] as $tratamiento){
                          array_push($tratamientos, $tratamiento);
                         }
                         $m->insertarTratamientosAnimal($datos["id"], $tratamientos);
                     }
                        $m->insertarRescate($datos);

                       

                        header("Location:index.php?ctl=rescate&mensaje=Exito en la insercion");
                    }

        }else{
            header("Location:index.php?ctl=rescate&mensaje=Error en la insercion");
        }
    }

    public function modificarRescate(){
        
        if (isset($_GET["id"])) {

            $m = new Model();
            
            $params = array(
                'ficha' => array(),
                'enfermedades' => array(),
                'vacunas' => array(),
                'tratamientos' => array()
            );
            
            try {

                if(isset($_POST["modificar"])){

                $datos = array();

                $datos["id"] = $_GET["id"];
                    
                $datos["fechaNac"] = $_POST["fechaNacMod"];

                $datos["nombre"] = setearSindatos($_POST["nombre"], "nombre");
             
                $datos["tamanyo"] = $_POST["mSelTamanyo"];

                $datos["localidad"] = $_POST["selLocalidad"];

                $datos["sexo"] = $_POST["radioSexo"];

                $datos["edad"] = setearSindatos($_POST["edadMod"], "edadMod");

                $datos["fechaIng"] = $_POST["fechaIngMod"];

                $datos["estadoAdop"] = $_POST["radioAdoptado"];

                $datos["ultDesp"] = $_POST["fechaUltMod"];

                $datos["selectAdoptante"] = null;

                $datos["especie"] = $_POST["selEspecie"];

                $datos["raza"] = $_POST["modSelRaza"];

                $datos["numchip"] = setearSindatos($_POST["numChip"], "numChip");

                if($_POST["ckEsterilizado"]=="on"){
                        $datos["esterilizado"] = "si";
                }else{
                        $datos["esterilizado"] = "no";
                }
                    

                $datos["refugio"] = $_POST["selRefugio"];

                $datos["comentarios"] = setearSindatos($_POST["modComentarios"], 'modComentarios');

                $datos["descripcion"] = setearSindatos($_POST["modDescripcion"], 'modDescripcion'); 

                $validacionNuevoRescate = new Validacion();
        
                $regla = array(
                    array(
                        'name' => 'nombre',
                        'regla' => 'letras'
                    ),
                    array(
                        'name' => 'edad',
                        'regla' => 'numeric'
                    ),
                    array(
                        'name' => 'numchip',
                        'regla' => 'numeric,chip'
                    )
                );
                    
                    $validaciones = $validacionNuevoRescate->rules($regla, $datos);
                    
                            if ($validaciones === true) {
                                if($m->updateRescate($datos)){
                                    $params["mensaje"] = "Éxito en la modificación del rescate";
                                }
                            }

                }
                $params["tamanyos"] = $m->getTamanyos();
                $params["localidades"] = $m->getLocalidades();
                $params["refugios"] = $m->getRefugios();
                
                $params["especies"] = $m->getEspecies();
                
                $params["ficha"] = setearNulos($m->getAnimal($_GET["id"]));

                $params["razas"] = $m->getRazasPorEspecie($params["ficha"]["especie"]);
                
                if (!$params["enfermedades"] = $m->getEnfermedadesPorId($_GET["id"])) {
                    $params["enfermedades"][0]["tipo"] = "Sin datos";
                }
                
                if (!$params["tratamientos"] = $m->getTratamientosPorId($_GET["id"])) {
                    $params["tratamientos"][0]["tipo"] = "Sin datos";
                }
                
                if (!$params["vacunas"] = $m->getVacunasPorId($_GET["id"])) {
                    $params["vacunas"][0]["tipo"] = "Sin datos";
                }

                
                
            }
            catch (Exception $e) {
                error_log("Excepcion producida el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
                //header('Location: index.php?ctl=error');
            }
            catch (Error $e) {
                error_log("Error producido el " . date("d-m-YY") . " a las " . date("H:m:s") . $e->getMessage() . PHP_EOL, 3, "logException.txt");
            //header('Location: index.php?ctl=error');
            }
            
            require __DIR__ . "/templates/modRescate.php";
            
        }
    }

    public function eliminarRescate(){
        if(isset($_GET["id"])){

            $m = new Model();

            if($m->eliminarRescate($_GET["id"])){
                $params["mensaje"] = "Rescate eliminado con éxito";
            }
            //Elimina correctamente, pero da error al recargar la página cuando intenta cargar los params del paginador
            require __DIR__ . "/templates/rescate.php";
        }
    }
}
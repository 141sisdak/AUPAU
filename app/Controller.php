<?php
include('libs/utils.php');
include('libs/Validacion.php');

class Controller
{
    
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
                
                if (!$params["enfermedades"] = $m->getEnfermedades($_GET["id"])) {
                    $params["enfermedades"][0]["tipo"] = "Sin datos";
                }
                
                if (!$params["tratamientos"] = $m->getTratamientos($_GET["id"])) {
                    $params["tratamientos"][0]["tipo"] = "Sin datos";
                }
                
                if (!$params["vacunas"] = $m->getVacunas($_GET["id"])) {
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
    
    public function inicio()
    {
        require __DIR__ . "/templates/inicio.php";
    }
    
    public function rescate()
    {
        

        $pagina = isset($_GET["pagina"]) ? (int)$_GET["pagina"] : 1;

        $regsPagina = 5;

        $inicio = ($pagina>1) ? (($pagina * $regsPagina)- $regsPagina) :0;
        
        $m = new Model();

        $sql = "";
        
        try {

            
            
            if ($m->getRescates($inicio, $regsPagina, $sql)) {
                $params = array(
                    'animales' => $m->getRescates($inicio, $regsPagina,$sql),
                    'tamanyos' => $m->getTamanyos(),
                    'localidades' => $m->getLocalidades(),
                    'especies' => $m->getEspecies(),
                    'razas' => $m->getRazas(),
                    'refugios' => $m->getRefugios()
                );

                

                setearNulosTabla($params["animales"]);
                $params["totalRegistros"] = $m->getRescatesTotal();
                //Utilizamos la funcion ceil para redondear el resultado hacia arriba (0.3=1)
                $params["numPaginas"] = ceil($params["totalRegistros"] / $regsPagina);
                $params["pagina"] = $pagina;
                
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
            
            if (isset($_POST["filtrar"])) {
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
                    'refugios' => $m->getRefugios()
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

                    if (!$params["animales"] = $m->getRescatesFiltro($sql)) {
                        $params["mensajeTabla"]  = "No se han producido resultados en la búsqueda";
                        $params["animales"] = array();
                    }
                    
                    setearNulosTabla($params["animales"]);
                    return $sql;
                }else{
                    $params["mensaje"]= "Error en datos introducidos en el formulario";
                }
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
}
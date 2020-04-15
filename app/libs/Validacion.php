<?php

/**
 * Clase para realizar validaciones en el modelo
 * Es utilizada para realizar validaciones
 *
 */
class Validacion
{
    
    protected $_atributos;
    
    protected $_error;
    
    public $mensaje;
    
    /**
     * Metodo para indicar la regla de validacion
     * El m�todo retorna un valor verdadero si la validaci�n es correcta, de lo contrario retorna el objeto
     * actual, permitiendo acceder al atributo Validacion::$mensaje ya que es publico
     */
    public function rules($rule = array(), $data)
    {
        //Comprobamos que LAS REGLAS vienen en array 
        if (! is_array($rule)) {
            //Si el par�metro rule no es un array creamos el mensaje y devolvemos el objeto
            $this->mensaje = "las reglas deben de estar en formato de arreglo";
            return $this;
        }
        foreach ($rule as $key => $rules) {
            $reglas = explode(',', $rules['regla']);
            if (array_key_exists($rules['name'], $data)) {
                foreach ($data as $indice => $valor) {
                    if ($indice === $rules['name']) {
                        foreach ($reglas as $clave => $valores) {
                            //Llamamos a _getInflectedName para montar el nombre del m�todo al que tenemos que llamar
                            $validator = $this->_getInflectedName($valores);
                            if (! is_callable(array(
                                $this,
                                $validator
                            ))) {
                                //Si la regla no existe enviamos una excepci�n
                                throw new BadMethodCallException("No se encontro el metodo $valores");
                            }
                            $respuesta = $this->$validator($rules['name'], $valor);
                        }
                        break;
                    }
                }
            } else {
                //Sino hay coincidencia en los nombres de los campos enviados en $data y $rule
                //guardamos un error tambien podr�amos enviar una excepci�n como hacemos en el caso
                //de que no haya coincidencia en la regla
                $this->mensaje[$rules['name']] = "el campo {$rules['name']} no esta dentro de la regla de validaci�n o en el formulario";
            }
        }
        if (! empty($this->mensaje)) {
            return $this;
        } else {
            return true;
        }
    }
    
    /**
     * Metodo inflector de la clase
     * por medio de este metodo llamamos a las reglas de validacion que se generen y las adecuamos al nombre del m�todo
     */
    private function _getInflectedName($text)
    {
        $validator = "";
        $_validator = preg_replace('/[^A-Za-z0-9]+/', ' ', $text);
        $arrayValidator = explode(' ', $_validator);
        if (count($arrayValidator) > 1) {
            foreach ($arrayValidator as $key => $value) {
                if ($key == 0) {
                    $validator .= "_" . $value;
                } else {
                    $validator .= ucwords($value);
                }
            }
        } else {
            $validator = "_" . $_validator;
        }
        
        return $validator;
    }
    
    /**
     * Metodo de verificacion de que el dato no este vacio o NULL
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _noEmpty($campo, $valor)
    {
        if ($valor != "")
        {
            return true;
        } else {
            $this->mensaje[$campo][] = "el campo $campo debe de estar lleno";
            return false;
        }
    }
    
    /**
     * Metodo de verificacion de tipo numerico
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _numeric($campo, $valor)
    {
        if($valor!=""){
        
            if (is_numeric($valor)) {
                return true;
            } else {
                $this->mensaje[$campo][] = "el campo $campo debe de ser numerico";
                return false;
            }
        }
    }
    /**
     * Metodo de verificacion de uso obligatorio de letras
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _letras($campo, $valor)
    {
        if($valor!=""){
        if (is_numeric($valor)) {
            if (preg_match("/^[A-Za-zñÑ]*$/", $valor))
                return true;
                else {
                    $this->mensaje[$campo][] = "El campo $campo deben de ser solo letras";
                    return false;
                }
        }
    }
    }
    /**
     * Metodo de verificacion de tipo numerico nivel
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     *NOTA:Esta función no tiene ningún efecto puesto que estaba hecha para tipo input text, no para radio button como está ahora
     **/
    protected function _nivel($campo, $valor)
    {
        if (preg_match("/^[1-2]$/", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "Error en nivel: Introduce 1 o 2";
            return false;
        }
    }
    /**
     * Metodo de verificacion de contraseña de 4 caracteres PERMITIENDO "$%#"
     * 
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _password($campo, $valor)
    {
        if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).{4,8}$/", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "Los valores de contraseña introducidos son incorrectos";
            return false;
        }
    }

    protected function _password2($campo, $valor)
    {
        if (preg_match("/^[\w,# $ %]{3}$/", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "Los valores de contraseña introducidos son incorrectos";
            return false;
        }
    }

    protected function _usuario($campo, $valor)
    {
        if (preg_match("/^[\w]{0,30}$/", $valor)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "Máximo de carácteres permitido excedido (30)";
            return false;
        }
    }

    protected function _fechaSuperior($campo, $valor){
       
        $actual = time();
        if(!strtotime($valor)>($actual)){
            return true;
        }else{
            $this->mensaje[$campo][] ="La fecha no puede ser superior a la actual";
            return false;
        }
    }
    
    
    /**
     * Metodo de verificacion de tipo email
     * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
     * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el
     * mensaje que visualizara el usuario
     */
    protected function _email($campo, $valor)
    {
        if (filter_var($valor, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            $this->mensaje[$campo][] = "el campo $campo no está en el formato adecuado";
            return false;
        }
    }

    protected function _chip($campo, $valor){
        if(substr($valor,0,3)!="941" || strlen($valor)==0){
            $this->mensaje[$campo][] = "Error en el nº de chip";
            return false;
        }else{
            return true;
        }
    }
}

?>
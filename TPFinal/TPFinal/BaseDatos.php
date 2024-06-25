<?php
/* IMPORTANTE !!!!  Clase para (PHP 5, PHP 7)*/

class BaseDatos {
    private $HOSTNAME; // La dirección del servidor de la base de datos. Aca; 127.0.0.1 (localhost).
    private $BASEDATOS; // El nombre de la base de datos que se va a utilizar. bdviajes
    private $USUARIO; //  El nombre de usuario para conectarse a la base de datos, que es root.
    private $CLAVE; //La contraseña para el usuario de la base de datos. Aquí está vacía ("")
    private $CONEXION; //Almacena la conexión a la base de datos.
    private $QUERY; // Almacena la consulta SQL que se ejecutará.
    private $RESULT; //Almacena el resultado de una consulta.
    private $ERROR; //Almacena los mensajes de error si ocurre algún problema.
    /**
     * Constructor de la clase que inicia ls variables instancias de la clase
     * vinculadas a la coneccion con el Servidor de BD
     */
    public function __construct(){
        $this->HOSTNAME = "127.0.0.1";
        $this->BASEDATOS = "bdviajes";
        $this->USUARIO = "root";
        $this->CLAVE="";
        $this->RESULT='';
        $this->QUERY="";
        $this->ERROR="";
    }

    public function getConexion(){
        return $this->CONEXION;
    }

    public function getResult(){
        return $this->RESULT;
    }

    /**
     * Funcion que retorna una cadena
     * con una peque�a descripcion del error si lo hubiera
     *
     * @return string
     */
    public function getError(){
        return "\n".$this->ERROR;
        
    }
    
    /**
     * Inicia la coneccion con el Servidor y la  Base Datos Mysql.
     * Retorna true si la coneccion con el servidor se pudo establecer y false en caso contrario
     *
     * @return boolean
     */
    public  function Iniciar(){
        $resp  = false;
        $conexion = mysqli_connect($this->HOSTNAME,$this->USUARIO,$this->CLAVE,$this->BASEDATOS);
        if ($conexion){
            if (mysqli_select_db($conexion,$this->BASEDATOS)){
                $this->CONEXION = $conexion;
                unset($this->QUERY);
                unset($this->ERROR);
                $resp = true;
            }  else {
                $this->ERROR = mysqli_errno($conexion) . ": " .mysqli_error($conexion);
            }
        }else{
            $this->ERROR =  mysqli_connect_errno($conexion) . ": " .mysqli_connect_error($conexion);
        }
        return $resp;
    }
    
    
    /**
     * Ejecuta una consulta en la Base de Datos.
     * Recibe la consulta en una cadena enviada por parametro.
     *
     * @param string $consulta
     * @return boolean
     */
    public function Ejecutar($consulta){
        $resp  = false;
        unset($this->ERROR);
        $this->QUERY = $consulta;
        if(  $this->RESULT = mysqli_query($this->CONEXION,$consulta)){
            $resp = true;
        } else {
            $this->ERROR =mysqli_errno($this->CONEXION).": ". mysqli_error($this->CONEXION);
        }
        return $resp;
    }
    
    /**
     * Devuelve un registro retornado por la ejecucion de una consulta
     * el puntero se despleza al siguiente registro de la consulta
     *
     * @return boolean
     */
    public function Registro() {
        $resp = null;
        // if ($this->RESULT){
        if ($this->getResult()){
            $result = $this->getResult();
            unset($this->ERROR);
            if($temp = mysqli_fetch_assoc($result)){
                $resp = $temp;
            }else{
                mysqli_free_result($result);
            }
        }else{
            $this->ERROR = mysqli_errno($this->CONEXION) . ": " . mysqli_error($this->CONEXION);
        }
    }
    /**
     * Devuelve el id de un campo autoincrement utilizado como clave de una tabla
     * Retorna el id numerico del registro insertado, devuelve null en caso que la ejecucion de la consulta falle
     *
     * @param string $consulta
     * @return int id de la tupla insertada
     */
    public function devuelveIDInsercion($consulta){
        $resp = null;
        unset($this->ERROR);
        $this->QUERY = $consulta;
        if ($this->RESULT = mysqli_query($this->CONEXION,$consulta)){
            $id = mysqli_insert_id($this->CONEXION);
            $resp =  $id;
        } else {
            $this->ERROR =mysqli_errno( $this->CONEXION) . ": " . mysqli_error( $this->CONEXION);
           
        }
    return $resp;
    }
    
}
?>
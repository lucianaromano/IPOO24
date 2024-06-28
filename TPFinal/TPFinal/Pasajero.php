 <?php
//De los pasajeros se conoce su nombre, apellido, número de documento y teléfono.
include_once 'BaseDatos.php';
include_once 'Persona.php';

class Pasajero extends Persona {
    //ATRIBUTOS
    private $idpasajero;
    private $idViaje; //objeto viaje
    private $mensajeoperacion;
    
    //CONSTRUCTOR
    public function __construct(){
        parent:: __construct();
        $this->idpasajero = "";
        $this->idViaje = "";
    }

    public function cargar($datosPersona){
        parent::cargar($datosPersona);
        $this->setIdPasajero($datosPersona['idpasajero']);
        $this->setIdViaje($datosPersona['idviaje']);
        //parent::cargar($idpersona, $ndoc, $nom, $ape, $tel);
        //$this->setIdPasajero($idpasajero);
        //$this->setIdViaje($idviaje);
    }
    //METODOS DE ACCESO
    public function getIdPasajero(){
        return $this->idpasajero;
    }
    public function setIdPasajero($id){
        $this->idpasajero = $id;
    }

    public function getIdViaje(){
        return $this->idViaje;
    }
    public function setIdViaje($ob){
        $this->idViaje = $ob;
    }

    public function getMensajeoperacion(){
		return $this->mensajeoperacion ;
	}
	public function setMensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

    //METODO TOSTRING
    public function __toString(){
        return  parent::__toString().
                "\nID (Pasajero): " . $this->getIdPasajero() . "  |  " .
                "Viaje: " . $this->getIdViaje() .  "  |  " ;
    }

    //FUNCIONES
    /**
	 * Recupera los datos del pasajero por su numero de documneto 
	 * @param int $dni  
	 * @return boolean 
	 */		
    public function buscar($idpersona)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM pasajero WHERE idpersona = " . $idpersona;
        $rta = false;
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                if($row2 = $base->Registro()){
                    parent::buscar($idpersona);
                    $this->setIdPasajero($row2['idpasajero']);
                    $this->setIdViaje($row2['idviaje']);
                    $rta = true;
                }
            }else{
                $this->setMensajeoperacion($base->getError());
            }
        }else{
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }


    /**Lista todas los pasajeros que cumplen con cierta condicion
	 * @param void
     * @return array 
	 */
    public function listar($condicion = ''){
        $arregloPasajero = null;
        $base = new BaseDatos();
        $consulta = "SELECT * FROM pasajero";
        if($condicion != ''){
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " order by idpasajero ";
        
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arregloPasajero = array();
                while ($row2 = $base->Registro()) {
                    $pasajero = new Pasajero();
                    $pasajero->Buscar($row2['idpersona']);
                    array_push($arregloPasajero, $pasajero);
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $arregloPasajero;
    }

    /** Coloca una instancia en la tabla pasajero de la bd
     * @param ()  
     * @return boolean 
     */
    public function insertar()
    {
        $base = new BaseDatos();
        $viaje = $this->getIdViaje();
        $idViaje = $viaje->getIdViaje();
        $resp = false;

        if (parent::insertar()) {
            $consultaInsertar = "INSERT INTO pasajero
				VALUES (" . parent::getIdpersona() . ", '" . $this->getIdPasajero() . "', '" . $idViaje . "')";
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaInsertar)) {
                    $resp = true;
                } else {
                    $this->setMensajeoperacion($base->getError());
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        }
        return $resp;
    }

    /** Actualiza los datos de la tabla pasajero en la base de datos que coincida con su numero de documento
     * @param ()  
     * @return boolean
    */
    public function modificar()
    {
        $rta = false;
        $base = new BaseDatos();
        if (parent::modificar()) {
            $consultaModifica = "UPDATE pasajero SET idviaje = '" . $this->getIdViaje() . "' WHERE idpersona = " . parent::getIdpersona();
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaModifica)) {
                    $rta = true;
                } else {
                    $this->setMensajeoperacion($base->getError());
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        }
        return $rta;
    }

    /**Elimina una instancia de la tabla pasajero en la bd
     * @param ()
     * @return boolean
     */
    public function eliminar()
    {
        $base = new BaseDatos();
        $rta = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM pasajero WHERE idpersona = " . parent::getIdpersona();
            if ($base->Ejecutar($consultaBorra)) {
                if (parent::eliminar()) {
                    $rta = true;
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }

}
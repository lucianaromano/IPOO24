<?php
include_once 'BaseDatos.php';
/**El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero.
 *  La clase Viaje debe hacer referencia al responsable de realizar el viaje.*/

class Viaje {
    private $idViaje;
    private $vdestino;
    private $vcantMaxPasajeros;
    private $vcolPasajeros;
    private $objResponsable; //obj responsable ref al responsable
    private $vimporte;
    private $objEmpresa; //objeto empresa 
    private $mensajeOperacion;


    
    //metodo constructor de la clase
    public function __construct(){
        $this-> idViaje = '';
        $this-> vdestino='';
        $this-> vcantMaxPasajeros= '';
        $this-> vcolPasajeros=[];
        $this-> objResponsable= '';
        $this-> vimporte = '';
        $this-> objEmpresa = '';
        $this-> mensajeOperacion = '';
    }

    public function getIdViaje (){
        return $this->idViaje;
    }

    public function setIdViaje($cod){
        $this->idViaje=$cod;
    }

    public function getVdestino (){
        return $this->vdestino;
    }

    public function setVdestino($dest){
        $this->vdestino=$dest;
    }

    public function getVcantMaxPasajeros(){
        return $this-> vcantMaxPasajeros;
    }

    public function setVcantMaxPasajeros($cantMax){
        $this->vcantMaxPasajeros=$cantMax;
    }

    public function getVcolPasajeros(){
        return $this-> vcolPasajeros;
    }

    public function setVcolPasajeros ($vcolPasajeros){
        $this->vcolPasajeros=$vcolPasajeros;
    }

    public function getObjResponsable(){
        return $this-> objResponsable;
    }

    public function setObjResponsable($objResponsable){
        $this->objResponsable=$objResponsable;
    }

    public function getMensajeOperacion(){
        return $this->mensajeOperacion;
    }

    public function setMensajeOperacion($nuevo){
        $this->mensajeOperacion = $nuevo;
    }

    public function getVimporte(){
        return $this->vimporte;
    }
    public function setVimporte($vimporte){
        $this->vimporte = $vimporte;
    }

    public function getObjEmpresa(){
        return $this->objEmpresa;
    }
    public function setObjEmpresa($objEmpresa){
        $this->objEmpresa = $objEmpresa;
    }

    /**
     * Retorna la coleccion de funciones en forma de cadena de caracteres
     */
    private function funcionesAString()
    {
        //Array Funcion $arreglo
        //String $retorno
        $retorno = "";
        $arreglo = $this->getVcolPasajeros();
        foreach ($arreglo as $i) {
            $retorno .= $i . "\n";
            $retorno .= "----------------------------------------------------------------------\n";
        }
        return $retorno;
    }
    //toString
    public function __toString()
    {
        return "----------------------------------
            ID: " . $this->getIdViaje() .
            "\nvDestino: " . $this->getVdestino() .
            "\nCantidad maxima de pasajeros: " . $this->getVcantMaxPasajeros() .
            "\nPasajeros: \n" . $this->funcionesAString() .
            "\nEmpleado Responsable: \n" . $this->getobjResponsable
    () .
            "\nImporte: $" . $this->getVimporte() .
            "\nEmpresa: " . $this->getobjEmpresa()."\n";
    }

    //FUNCIONES BD
    public function cargar($idViaje,$vdestino,$vcantMaxPasajeros,$objResponsable,$vimporte,$objEmpresa,$vcolPasajeros){
        $this->setIdViaje($idViaje);
        $this->setVdestino($vdestino);
        $this->setVcantMaxPasajeros($vcantMaxPasajeros);
        $this->setobjResponsable($objResponsable);
        $this->setVimporte($vimporte);
        $this->setobjEmpresa($objEmpresa);
        $this->setVcolPasajeros($vcolPasajeros);
    }

    public function Buscar($id){
        $base = new BaseDatos();
        $rta = false;
        $consulta = "SELECT * FROM Viaje WHERE idViaje=" . $id;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdViaje($row2['idViaje']);
                    $this->setvDestino($row2['vvdestino']);
                    $this->setvcantMaxPasajeros($row2['vcantmaxpasajeros']);
                    $pasajero = new Pasajero();
                    $pasajero->buscar($row2['pdocumento']);
                    $this->setvcolPasajeros($pasajero);
                    $responsable = new Responsable();
                    $responsable->buscar($row2['objResponsable']);
                    $this->setObjResponsable($responsable);
                    $this->setVimporte($row2['vimporte']);
                    $this->setObjEmpresa($row2['objEmpresa']);
                    $rta = true;
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $rta;
    }

    /**Lista todas los viajes que cumplen con cierta condicion 
	 * @param void 
     * @return array 
	 */
	public function listar($condicion = ""){
	    $arrayViaje = null;
		$base = new BaseDatos();
		$consultaViajes = "SELECT * from viaje ";
		if ($condicion != ""){
		    $consultaViajes = $consultaViajes.' where '.$condicion;
		}
		$consultaViajes.=" order by idviaje ";

		if($base->Iniciar()){
			if($base->Ejecutar($consultaViajes)){				
				$arrayViaje = array();
				while($row2 = $base->Registro()){
                    $objEmpresa = new Empresa ();
                    $objEmpresa ->Buscar ($row2['objEmpresa']);
                    $objResponsable = new Responsable();
                    $objResponsable -> Buscar ($row2['objResponsable']);
                    $idviaje = $row2['idviaje'];
                    $vdestino= $row2['vdestino'];
                    $vcantMaxPasajeros = $row2['vcantMaxPasajeros'];
                    $vimporte = $row2 ['vimporte'];
                    $pasajero = new Pasajero ();
                    $vcolPasajeros = $pasajero -> listar ('idViaje = idviaje');
                    $viaje = new Viaje ();
                    $viaje -> cargar ($idviaje,$vdestino,$vcantMaxPasajeros,$objResponsable,$vimporte,$objEmpresa,$vcolPasajeros);
					array_push($arrayViaje,$viaje);
                }				
            }else{
		 		$this->setMensajeOperacion($base->getError()); 		
			}
		 }else{
		 	$this->setMensajeOperacion($base->getError());
		}	 
		return $arrayViaje;
	}

    public function insertar(){
        $base = new BaseDatos();
        $rta = false;

        $consultaInsertar = "INSERT INTO viaje(vdestino,vcantMaxPasajeros,objResponsable
,vimporte,objEmpresa)
                            VALUES (" .$this->getVdestino() ."," .$this->getVcantMaxPasajeros().",". $this->getobjResponsable
                    ()."," .$this->getVimporte().",".$this->getobjEmpresa()."')";
        
        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setIdViaje($id);
                $rta = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }

    public function modificar()
    {
        $rta = false;
        $base = new BaseDatos();
        $consultaModificar = "UPDATE viaje SET vdestino='" . $this->getVdestino() . "',vcantMaxPasajeros='" . $this->getVcantMaxPasajeros() . "'
                           ,objResponsable
                    ='" . $this->getobjResponsable
                    () . "',importe=" . $this->getVimporte() . " WHERE id" . $this->getIdViaje();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModificar)) {
                $rta = true;
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }

    public function eliminar(){
        $base = new BaseDatos();
        $rta = false;
        $consultaElimina = "DELETE FROM viaje WHERE idviaje = " . $this->getIdviaje();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaElimina)) {
                $rta = true;
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }
}
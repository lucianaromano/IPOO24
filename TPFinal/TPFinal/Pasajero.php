<?php
//De los pasajeros se conoce su nombre, apellido, número de documento y teléfono.
include_once 'BaseDatos.php';
class Pasajero {
    private $pnombre;
    private $papellido;
    private $pdocumento;
    private $ptelefono;
    private $idViaje; //objeto viaje
    private $mensajeoperacion;
    
    //metodo constructor de la clase
    public function __construct(){
        $this-> pnombre = '';
        $this-> papellido= '';
        $this-> pdocumento= '';
        $this-> ptelefono = '';
        $this-> mensajeoperacion= '';
    }

    //metodos de acceso
    public function getPnombre(){
        return $this->pnombre;
    }
    public function setPnombre($nombre){
        $this->pnombre = $nombre;
    }

    public function getPapellido(){
        return $this->papellido;
    }
    public function setPapellido($apellido){
        $this->papellido = $apellido;
    }

    public function getPdocumento(){
        return $this->pdocumento;
    }
    public function setPdocumento($numero){
        $this->pdocumento = $numero;
    }

    public function getPtelefono(){
        return $this->ptelefono;
    }
    public function setPtelefono($numero){
        $this->ptelefono = $numero;
    }

    public function getIdViaje(){
        return $this->idViaje;
    }
    public function setIdViaje($ob){
        $this->idViaje = $ob;
    }

    public function getMensajeOperacion(){
		return $this->mensajeoperacion ;
	}
	public function setMensajeOperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

    //metodo toString de la clase
    public function __toString(){
        return "Nro Documento: " . $this->getPdocumento() .
            "\nNombre: " . $this->getPnombre() .
            "\nApellido: " . $this->getPapellido() .
            "\nTelefono: " . $this->getPtelefono() .
            "\nViaje: \n" . $this->getIdviaje() . "\n";
    }

    //Funciones
    public function cargar($pnombre,$papellido,$pdocumento,$ptelefono,$idViaje){		
		$this->setPnombre($pnombre);
		$this->setPapellido($papellido);
		$this->setPdocumento($pdocumento);
        $this->setPtelefono($ptelefono);
        $this->setIdViaje($idViaje);
    }

    /**
	 * Recupera los datos del pasajero por su numero de documneto 
	 * @param int $dni  
	 * @return boolean 
	 */		
    public function buscar($id){
        $base = new BaseDatos();
        $consulta = "SELECT * FROM pasajero WHERE pdocumento= " . $id;
        $rta = false;
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                if($row2 = $base->Registro()){
                    $this->setPnombre($row2['pnombre']);
                    $this->setPapellido($row2['papellido']);
                    $this->setPdocumento($row2['pdocumento']);
                    $this->setPtelefono($row2['ptelefono']);
                    $viaje = new Viaje();
                    $viaje->buscar($row2['idviaje']);
                    $this->setIdviaje($viaje);
                    $rta = true;
                }
            }else{
                $this->setMensajeOperacion($base->getError());
            }
        }else{
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }


    /**Lista todas los pasajeros que cumplen con cierta condicio 
	 * @param void
     * @return array 
	 */
    public static function listar($condicion = ''){
        $arregloPasajero = null;
        $base = new BaseDatos();
        $consulta = "SELECT * FROM pasajero";
        if($condicion != ''){
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $arregloPasajero = array();
                while($row2 = $base->Registro()){
                    $pnombre = $row2['pnombre'];
                    $papellido = $row2['papellido'];
                    $pdocumento = $row2['pdocumento'];
                    $ptelefono = $row2['ptelefono'];
                    $idviaje = $row2['idviaje'];
                    
                    $pasajero = new Pasajero();
                    $pasajero->cargar($pdocumento, $pnombre, $papellido, $ptelefono, $idviaje);
                    array_push ($arregloPasajero,$pasajero);
                }
            }else{
                Pasajero::setMensajeoperacion($base->getError());
            }
        }else{
            Pasajero::setMensajeoperacion($base->getError());
        }
        return $arregloPasajero;
    }

    /** Coloca la clase en una tabla de la base de datos
     * @param ()  
     * @return boolean 
     */
    public function insertar(){
        $base = new BaseDatos();
        $rta = false;
        $objViaje = $this->getIdviaje();
        $idviaje = $objViaje->getIdviaje();
        $consulta = "INSERT INTO pasajero (pdocumento, pnombre, papellido, ptelefono, idviaje) VALUES( '{$this->getPdocumento()}' , '{$this->getPnombre()}' ,'{$this->getPapellido()}' , '{$this->getPtelefono()}' , '{$idviaje}')";
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $rta = true;
            }else{
                $this->setMensajeoperacion($base->getError());    
            }
        }else{
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }

    /** Actualiza los datos de la tabla pasajero en la base de datos que coincida con su numero de documento
     * @param ()  
     * @return boolean
    */
    public function modificar(){
        $rta = false;
        $base = new BaseDatos();
        $objViaje = $this->getIdviaje();
        $idViaje = $objViaje->getIdviaje();
        $consulta = "UPDATE pasajero SET pnombre = '{$this->getPnombre()}', papellido = '{$this->getPapellido()}', ptelefono = '{$this->getPtelefono()}', idviaje = '{$idViaje}' WHERE pdocumento =  '{$this->getPdocumento()}'";
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $rta = true;
            }else{
                $this->setMensajeoperacion($base->getError());
            }
        }else{
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }

    /**Elimina el registro del objeto en la tabla de la base de datos
     * @param ()
     * @return boolean
     */
    public function eliminar(){
        $base = new BaseDatos();
        $rta = false;
        $consulta = "DELETE FROM pasajero WHERE pdocumento = " . $this->getPdocumento();
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $rta = true;
            }else{
                $this->setMensajeoperacion($base->getError());
            }
        }else{
            $this->setMensajeOperacion($base->getError());
        }
        return $rta;
    }

}
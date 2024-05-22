<?php

/*Modificar la clase viaje para almacenar el costo del viaje, la suma de los costos abonados por los pasajeros
 e implementar el método venderPasaje($objPasajero) que debe incorporar el pasajero a la colección de pasajeros 
 (solo si hay espacio disponible), actualizar los costos abonados y retornar el costo final que deberá ser abonado 
 por el pasajero..*/

class Viaje {
    private $codigo;
    private $destino;
    private $cantMaxPasajeros;
    private $colObjPasajeros;
    private $objResponsableV;
    //NUEVO ATRIBUTO
    private $costoViaje;
    private $sumaCostos;

    
    //metodo constructor de la clase
    public function __construct($cod,$dest,$cantMax,$colObjPasajeros,$objResponsable,$costoViaje,$sumaCostos){
        $this-> codigo = $cod;
        $this-> destino= $dest;
        $this-> cantMaxPasajeros= $cantMax;
        $this->colObjPasajeros=$colObjPasajeros;
        $this->objResponsableV= $objResponsable;
        $this-> costoViaje = $costoViaje;
        $this-> sumaCostos = $sumaCostos;
    }

    //metodos de acceso get
    public function getCodigo (){
        return $this->codigo;
    }

    public function getDestino (){
        return $this->destino;
    }

    public function getCantMaxPasajeros(){
        return $this-> cantMaxPasajeros;
    }

    public function getColObjPasajeros(){
        return $this-> colObjPasajeros;
    }

    public function getObjResponsableV(){
        return $this-> objResponsableV;
    }

    public function getCostoViaje (){
        return $this->costoViaje;
    }

    public function getSumaCostos (){
        return $this->sumaCostos;
    }

    //metodos de acceso set
    public function setCodigo($cod){
        $this->codigo=$cod;
    }

    public function setDestino($dest){
        $this->destino=$dest;
    }

    public function setCantMaxPasajeros($cantMax){
        $this->cantMaxPasajeros=$cantMax;
    }

    public function setColObjPasajeros ($colObjPasajeros){
        $this->colObjPasajeros=$colObjPasajeros;
    }

    public function setObjResponsableV($objResponsableV){
        $this->objResponsableV=$objResponsableV;
    }

    public function setCostoViaje($costoViaje){
        $this->costoViaje=$costoViaje;
    }

    public function setSumaCostos($suma){
        $this->sumaCostos=$suma;
    }

    //metodo toString de la clase
    public function __toString(){
        $objResponsableV = $this-> getObjResponsableV();
        $cadena= "-----------VIAJE-----------
        \n Codigo: ". $this->getCodigo().
        "\nDestino: ".$this->getDestino().
        "\nCantidad maxima de pasajeros: ".$this->getCantMaxPasajeros(). //tiene que mostrar el arreglo
        "\n ------PASAJEROS------\n" .$this->mostrarDatosPasajeros().
        "\n------RESPONSABLE DEL VIAJE------ \n ".$this->getObjResponsableV().
        "\nCosto del viaje: ".$this->getCostoViaje().
        "\nTotal abonado por los pasajeros: ".$this->getSumaCostos();
        return $cadena;
    }

    //Otras funciones
    /**
     * Permite saber si el dni ingresado es igual al de algun pasajero ya cargado y retorna un valor booleano.
     * Agrega el nuevo pasajero al array con un indice anterior.
     */
    public function modificarDatos($codPasajero,$dniAnterior, $nombreNuevo, $apellidoNuevo,$teleNuevo){
        $arregloPasajeros=$this->getColObjPasajeros();
        $i=0;
        $encontrado=false;
  
        while ($i< count($arregloPasajeros) && !$encontrado){
            $pasajero= $arregloPasajeros[$i];
            $encontrado= ($pasajero->getNumDoc() == $dniAnterior);  
            $i++;  //return boolean
        } if ($encontrado){  //no asigno un nuevo numero de dni a un pasajero
            $newObjPasajero= new Pasajero($nombreNuevo,$apellidoNuevo, $dniAnterior,$teleNuevo); //creo un nuevo obj pasajero
            $arregloPasajeros[$i-1]= $newObjPasajero; 
            $codPasajero= $this-> setColObjPasajeros($arregloPasajeros);
        }
        return $codPasajero;
      }
      /**
       * Modifico la informacion del responsable del viaje
       */
      public function ModificarDatosResponsable($nroEmpleado, $nroLicencia, $nombre, $apellido){
        $objResponsableV= $this-> getObjResponsableV();
        $objResponsableV= new ResponsableV ($nroEmpleado, $nroLicencia, $nombre, $apellido); //creo un nuevo obj responsable del viaje
  
        return $this->setObjResponsableV($objResponsableV);
      }
    
       /**
       * Muestra los datos de los pasajeros.
       */
      public function mostrarDatosPasajeros (){
          $datosPasajeros=$this->getColObjPasajeros();
          $pasajero="";
          for ($i=0;$i<count($datosPasajeros);$i++){
              $objPasajero=$datosPasajeros[$i];
              $numPasajero=$i;
              $pasajero= $pasajero ."PASAJERO n° ".($numPasajero + 1).":".
                        $objPasajero."\n";
          }
          return $pasajero;
      }

    /**implementar el método venderPasaje($objPasajero) que debe incorporar el pasajero a la colección de pasajeros 
    *(solo si hay espacio disponible), actualizar los costos abonados y retornar el costo final que deberá ser abonado 
    *por el pasajero */
    /**public function venderPasaje($objPasajero){
        $colPasajeros = $this->getColObjPasajeros();

        if($this->hayPasajesDisponible()){
            $i = count($colPasajeros);
            $colPasajeros[$i] = $objPasajero;
            $this->setColObjPasajeros($colPasajeros);
            $importe = $this->getImporte();
        }
        return $importe;
    }*/
    
    /**VERIFICACIÓN DE NO REDUNDANCIA DE PASAJEROS. RETORNA FALSE SI EL DNI INGRESADO POR EL USUARIO NO ESTA INCLUIDO EN LA COLECCION DE OBJETOS PASAJERO
     * @param INT $numDni
     * @return BOOLEAN
     */
    public function verificarPasajero($numDni){
        $posicionObjPasajero=0;
        $objPasajeroEncontrado=false;
        $colPasajeCopia=$this->getColObjPasajeros();
        while (!$objPasajeroEncontrado && $posicionObjPasajero<count($colPasajeCopia)) {
            if ($colPasajeCopia[$posicionObjPasajero]->getNroDni()==$numDni) {
                $objPasajeroEncontrado=true;
            }
            $posicionObjPasajero++;
        }
        return $objPasajeroEncontrado;
    }

    public function venderPasaje($objPasajero){
      $arregloPasajeros = $this->getColObjPasajeros();
      $costo= false;

      if($this->hayPasajesDisponible()){
        $i=count($arregloPasajeros);
        $arregloPasajeros[$i]= $objPasajero;
        $this->setColObjPasajeros($arregloPasajeros);
        $costo = $this-> getCostoViaje();
      }
      return $costo;
    }


    /**Implemente la función hayPasajesDisponible() que retorna verdadero si la cantidad de pasajeros del viaje 
     *es menor a la cantidad máxima de pasajeros y falso caso contrario */
    public function hayPasajesDisponible(){
    //return boolean
    $pasajeros = $this->getColObjPasajeros();
    $maximoPasajeros = $this->getCantMaxPasajeros();
    $respuesta = false;
        if (count($pasajeros) < $maximoPasajeros){
            $respuesta = true;
        }
        return $respuesta;
    }
}
?> 
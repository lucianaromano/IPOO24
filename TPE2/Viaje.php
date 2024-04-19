<?php

/*La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes. De cada viaje se precisa 
almacenar el código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.
Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase
(incluso los datos de los pasajeros). Utilice clases y arreglos  para   almacenar la información correspondiente a los pasajeros.
Cada pasajero guarda  su “nombre”, “apellido” y “numero de documento”.

Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos nombre, apellido, numero de documento y teléfono.
El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero. También se desea guardar la información de la persona
responsable de realizar el viaje, para ello cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y 
apellido. La clase Viaje debe hacer referencia al responsable de realizar el viaje.
Implementar las operaciones que permiten modificar el nombre, apellido y teléfono de un pasajero. Luego implementar la operación que 
agrega los pasajeros al viaje, solicitando por consola la información de los mismos. Se debe verificar que el pasajero no este cargado
 mas de una vez en el viaje. De la misma forma cargue la información del responsable del viaje.*/

class Viaje {
    private $codigo;
    private $destino;
    private $cantMaxPasajeros;
    private $colObjPasajeros;
    private $objResponsableV;
    
    //metodo constructor de la clase
    public function __construct($cod,$dest,$cantMax,$colObjPasajeros,$objResponsable)
    {
        $this-> codigo = $cod;
        $this-> destino= $dest;
        $this-> cantMaxPasajeros= $cantMax;
        $this->colObjPasajeros=$colObjPasajeros;
        $this->objResponsableV= $objResponsable;
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

    //metodo toString de la clase
    public function __toString(){
        $objResponsableV = $this-> getObjResponsableV();
        $cadena= "-----------VIAJE-----------
        \n Codigo: ". $this->getCodigo().
        "\nDestino: ".$this->getDestino().
        "\nCantidad maxima de pasajeros: ".$this->getCantMaxPasajeros(). //tiene que mostrar el arreglo
        "\n ------PASAJEROS------\n" .$this->mostrarDatosPasajeros().
        "\n------RESPONSABLE DEL VIAJE------ \n Nombre: ".$objResponsableV->getNombre().
        "\nApellido: ".$objResponsableV->getApellido().
        "\nNumero de empleado: ".$objResponsableV->getEmpleado().
        "\nNumero de licencia: ".$objResponsableV->getLicencia();
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
}
?>
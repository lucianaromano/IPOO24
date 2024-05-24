<?php 

/**. Implementar la clase Agencia que contiene una colección de paquetes turísticos, la colección de ventas
realizadas por la agencia y la colección de ventas On-Line. La clase cuenta con los siguientes
métodos: */
class Agencia {
    private $colPaqTuristicos;
    private $colVentasAgencia;
    private $colVentasOnline;

    //CONSTRUCTOR
    public function __construct($colPaqTuristicos, $colVentasAgencia, $colVentasOnline)
    {
        $this->colPaqTuristicos = $colPaqTuristicos;
        $this->colVentasAgencia = $colVentasAgencia;
        $this->colVentasOnline = $colVentasOnline;
    }

    //METODOS GET
    public function getColPaqTuristicos(){
        return $this->colPaqTuristicos;
    }

    public function getColVentasAgencia(){
        return $this->colVentasAgencia;
    }

    public function getColVentasOnline(){
        return $this->colVentasOnline;
    }

    //METODOS SET 
    public function setColPaqTuristicos($colPaqTuristicos){
        $this->colPaqTuristicos = $colPaqTuristicos;
    }

    public function setColVentasAgencia($colVentasAgencia){
        $this->colVentasAgencia = $colVentasAgencia;
    }

    public function setColVentasOnline($colVentasOnline){
        $this->colVentasOnline = $colVentasOnline;
    }
    
    //METODO TOSTRING
    public function __toString(){
        $cadena = "Paquetes turisticos: " .$this->retornarCadenaDesdeColeccion($this->getColPaqTuristicos()) ."\n";
        $cadena = $cadena . "Ventas realizadas en la agencia: " .$this->retornarCadenaDesdeColeccion($this->getColVentasAgencia())."\n";
        $cadena = $cadena . "Ventas realizadas online: " .$this->retornarCadenaDesdeColeccion($this->getColVentasOnline())."\n";
        return $cadena;
    }

    //OTROS METODOS
    private function retornarCadenaDesdeColeccion ($coleccion){
        $cadena = "";
        foreach ($coleccion as $unElementoCol){
            $cadena= $cadena . "." . $unElementoCol . "\n";
        }
        return $cadena;
    }

    /**incorporarPaquete(objPaqueteTuristico): que incorpora a la colección de paquetes turísticos un
    nuevo paquete a la agencia siempre y cuando no haya un paquete en la misma fecha al mismo
    destino. Si el paquete pudo ser ingresado el método debe retornar true y false en caso contrario. */
    public function incorporarPaquete ($objPaqueteTuristico){
        //return boolean 
        $incorpora = false; 
        $colPaqTuristicos = $this->getColPaqTuristicos(); 
        foreach ($colPaqTuristicos as $unPaquete){ //recorro la coleccion
            if ($unPaquete ->) { //verifico que no haya un paquete en la misma fecha al mismo destino
                array_push($colPaqTuristicos,$unPaquete); //incorporo el paquete a la coleccion
                $incorpora = true;
            }else {
                $incorpora = false;
            }
        }
        
        return $incorpora;
    }
    
}
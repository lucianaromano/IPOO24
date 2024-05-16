<?php
class Cuenta {
    private $nroCuenta;
    private $objDueño;

    public function __construct($nroCuenta, $objDueño){
        $this-> nroCuenta = $nroCuenta;
        $this-> objDueño = $objDueño;
    }
    //OBSERVADORES
    public function getNroCuenta(){
        return $this-> nroCuenta ;
    }

    public function getObjDueño(){
        return $this-> objDueño ;
    }

    public function getApellido(){
        return $this-> apellido ;
    }

    //MODIFICADORES
    public function setDni($dni){
        $this-> dni = $dni;
    }

    public function setNombre($nombre){
        $this-> nombre = $nombre;
    }

    public function setApellido($apellido){
        $this-> apellido = $apellido;
    }

    //OTROS METODOS 
    public function __toString(){
        //string $cadena 
        $cadena = "Dni: " .$this->getDni()."\n";
        $cadena = $cadena . "Nombre: ".$this->getNombre()."\n";
        $cadena = $cadena . "Apellido: ".$this->getNombre()."\n";

        return $cadena;
    }
}
?>
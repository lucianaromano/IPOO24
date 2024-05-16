<?php
class CuentaCorriente extends Cuenta{
    //clase que representa a una persona
    private $montoMax;

    public function __construct($dni,$nombre,$apellido,$montoMax){
        //invoco al constructor de cuenta
        parent:: __construct($dni,$nombre,$apellido);
        //agregamos el nuevo atributo
        $this-> montoMax = $montoMax;
    }

    //metodos de acceso
    public function getMontoMax(){
        return $this-> montoMax;
    }

    public function setMontoMax ($montoMax){
        $this-> montoMax = $montoMax;
    }

    //otros metodos
    public function __toString(){
        //invoco al toString de cuenta
        $cadena = parent:: __toString();
        $cadena = "Monto máximo para girar en descubierto: ".$this->getMontoMax()."\n";
        return $cadena;
    }
}
?>
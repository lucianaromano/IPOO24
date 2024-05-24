<?php

/**De las Ventas se almacena la fecha, la referencia al paquete, la cantidad de personas, y el cliente al que se le
ha realizado la venta*/

class Venta{
    private $fecha;
    private $objPaquete;
    private $cantPersonas;
    private $cliente;

    public function __construct($fecha, $objPaquete, $cantPersonas, $cliente){
        $this->fecha = $fecha;
        $this->objPaquete = $objPaquete;
        $this->cantPersonas = $cantPersonas;
        $this->cliente = $cliente;
    }


    public function geFecha(){
        return $this->fecha;
    }

    public function getObjPaquete(){
        return $this->objPaquete;
    }

    public function getcantPersonas(){
        return $this->cantPersonas;
    }

    public function getCliente(){
        return $this->cliente;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function setObjPaquete($objPaquete){
        $this->objPaquete = $objPaquete;
    }

    public function setcantPersonas($cantPersonas){
        $this->cantPersonas = $cantPersonas;
    }

    public function setCliente($cliente){
        $this->cliente = $cliente;
    }

    public function __toString(){
        $info = "Fecha: ". $this->getFecha()."\n";
        $info = $info . "----PAQUETE----". $this->getObjPaquete()."\n";
        $info = $info . "Cantidad de personas: ".$this->getCantPersonas()."\n";
        $info = $info ."Cliente: " .$this->getCliente()."\n";
        return $info;
    }
}
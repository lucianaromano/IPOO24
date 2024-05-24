<?php

/**De los Destinos se almacena una identificación, el name del lugar y el valor por día en ese destino por
pasajero. */

class Destino {
    private $identificacion;
    private $nombre;
    private $valorDia;

    public function __construct($id, $typeDoc, $valorDia){
        $this->identificacion = $id;
        $this->nombre = $typeDoc;
        $this->valorDia = $valorDia;
    }

    public function getIdentificacion(){
        return $this->identificacion;
    }

    public function setIdentificacion($identificacion){
        $this->identificacion = $identificacion;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getValorDia(){
        return $this->valorDia;
    }

    public function setValorDia($valorDia){
        $this->valorDia = $valorDia;
    }

    public function __toString(){
        $info = "Identificacion: ". $this->getIdentificacion()."\n";
        $info = $info . "Nombre del destino: ". $this->getNombre()."\n";
        $info = $info . "Valor por dia (Por pasajero): ".$this->getValorDia()."\n";
        return $info;
    }
}
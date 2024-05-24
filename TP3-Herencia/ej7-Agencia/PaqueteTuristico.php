<?php

/**De los Paquetes Turísticos se almacena fecha desde, cantidad de días, destino, cantidad total de plazas y
cantidad disponible de plazas. El constructor de la clase paquete turístico no recibe como parámetro la cantidad
de plazas disponibles, debe ser un valor que se setea con el valor recibido para la cantidad total de plazas del
paquete. */

class PaqueteTuristico {
    private $fechaDesde;
    private $cantDias;
    private $destino;
    private $cantTotPlazas;
    private $cantDispPlazas;

    public function __construct($fechaDesde,$cantDias,$destino,$cantTotPlazas){
        $this->fechaDesde = $fechaDesde;
        $this->cantDias = $cantDias;
        $this->destino = $destino;
        $this->cantTotPlazas = $cantTotPlazas;
        $this->cantDispPlazas = $this->setCantTotPlazas($cantTotPlazas);
    }

    public function getFechaDesde(){
        return $this->fechaDesde;
    }
    public function getCantDias(){
        return $this->cantDias;
    }
    public function getdestino(){
        return $this->destino;
    }
    public function getCantTotPlazas(){
        return $this->cantTotPlazas;
    }
    public function getCantDispPlazas(){
        return $this->cantDispPlazas;
    }

    //METODOS SET
    public function setFechaDesde($fechaDesde){
        $this->fechaDesde = $fechaDesde;
    }
    public function setCantDias($cantDias){
        $this->cantDias = $cantDias;
    }
    public function setdestino($destino){
        $this->destino = $destino;
    }
    public function setCantTotPlazas($cantTotPlazas){
        $this->cantTotPlazas = $cantTotPlazas;
    }
    public function setCantDispPlazas($cantTotPlazas){
        $this->cantDispPlazas = $cantTotPlazas;
    }

    public function __toString(){
        $info = "Fecha inicio: ". $this->getFechaDesde()."\n";
        $info = $info . "Cantidad de dias: ". $this->getCantDias()."\n";
        $info = $info . "Destino: ".$this->getDestino()."\n";
        $info = $info . "Cantidad total de plazas: " .$this->getCantTotPlazas()."\n";
        $info = $info . "Cantidad disponibles de plazas: " .$this->getCantDispPlazas()."\n";
        return $info;
    }
}
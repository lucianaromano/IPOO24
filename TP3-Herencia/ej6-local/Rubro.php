<?php

class Rubro{
    private $descripcion;
    private $porcentajeGanancia;

    public function __construct($descr, $porcentajeGan)
    {
        $this->descripcion = $descr;
        $this->porcentajeGanancia = $porcentajeGan;
    }
    

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getPorcentajeGanancia(){
        return $this->porcentajeGanancia;
    }

    public function setPorcentajeGanancia($porcentajeGanancia){
        $this->porcentajeGanancia = $porcentajeGanancia;
    }

    public function __toString()
    {
        $info = "Descripcion: {$this->getDescripcion()}\n".
        "Porcentaje Ganancia: {$this->getPorcentajeGanancia()}\n";
        return $info;
    }
}
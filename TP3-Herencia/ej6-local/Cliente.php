<?php

class Cliente{
    private $nombre;
    private $tipoDoc;
    private $numDoc;

    public function __construct($name, $typeDoc, $numDoc)
    {
        $this->nombre = $name;
        $this->tipoDoc = $typeDoc;
        $this->numDoc = $numDoc;
    }
    

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function getTipoDoc(){
        return $this->tipoDoc;
    }

    public function setTipoDoc($tipoDoc){
        $this->tipoDoc = $tipoDoc;
    }

    public function getNumDoc(){
        return $this->numDoc;
    }

    public function setNumDoc($numDoc){
        $this->numDoc = $numDoc;
    }

    public function __toString()
    {
        $info = "Nombre: {$this->getNombre()}\n".
        "Tipo documento: {$this->getTipoDoc()}\n".
        "Número documento: {$this->getNumDoc()}\n";
        return $info;
    }
}
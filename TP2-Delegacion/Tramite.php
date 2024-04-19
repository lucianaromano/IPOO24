<?php

class Tramite{
    
    private $tipoTramite;
    private $horaCreacion;
    private $horaResolucion;
    
    public function __construct($tipoTramite, $horaCreacion, $horaResolucion){
        $this -> tipoTramite = $tipoTramite;
        $this -> horaCreacion = $horaCreacion;
        $this -> horaResolucion = $horaResolucion;
    }
    
    // METODOS DE ACCESO GET
    
    public function getTipoTramite(){
        return $this -> tipoTramite;
    }
    
    public function getHoraCreacion(){
        return $this -> horaCreacion;
    }
    
    public function getHoraResolucion(){
        return $this -> horaResolucion;
    }
    
    // METODOS DE ACCESO SET
    
    public function setTipoTramite($dato){
        $this -> tipoTramite = $dato;
    }
    
    public function setHoraCreacion($dato){
        $this -> tipoTramite = $dato;
    }
    
    public function setHoraResolucion ($dato){
        $this -> horaResolucion = $dato;
    }
    
    public function __toString(){
        $infoTramite = "Tipo de tramite: " . $this -> getTipoTramite().
        "\nHora de creacion: " . $this -> getHoraCreacion().
        "\nHora de resolucion: " . $this -> getHoraResolucion();
        return $infoTramite;
    }
}
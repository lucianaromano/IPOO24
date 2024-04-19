<?php


class Cliente {
    
    private $nroCuenta;
    private $tramite;
    
    public function __construct($nroCuenta, $tramite){
        $this -> nroCuenta = $nroCuenta;
        $this -> tramite = $tramite;
    }
    
    // METODOS DE ACCESO GET
    
    public function getNroCuenta(){
        return $this -> nroCuenta;
    }
    
    public function getTramite(){
        return $this -> tramite;
    }
    
    // METODOS DE ACCESO SET
    
    public function setNroCuenta ($dato){
        $this -> nroCuenta = $dato;
    }
    
    public function setTramite ($dato){
        $this -> tramite = $dato;
    }
    
    public function __toString(){
        $infoCliente = "\nNumero de cuenta: " . $this -> getNroCuenta().
                       "\nTramite que realiza: " . $this -> getTramite();
        return $infoCliente;
    }
}
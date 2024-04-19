<?php
class Mostrador {
    private $colTramites;
    private $objCola;
    private $nroMostrador;

    public function __construct($colTramites,$objCola,$nro){   
        $this->colTramites=$colTramites;
        $this->objCola=$objCola;
        $this->nroMostrador=$nro;
    }   
    //METODOS DE ACCESO GET
    public function getColTramites(){
        return $this->colTramites ;
    }

    public function getObjCola(){
        return $this->objCola;
    }

    public function getNroMostrador(){
        return $this->nroMostrador;
    }
    //METODOS DE ACCESO SET
    public function setColTramites($colTramites){
        $this->colTramites=$colTramites;
    }

    public function setObjCola($objCola){
        $this->objCola=$objCola;
    }

    public function setNroMostrador($nro){
        $this->nroMostrador=$nro;
    }

    //devuelve true o false indicando si el tramite se puede atender o no en el mostrador; note que el tipo de trámite
    //correspondiente a unTramite tiene que coincidir con alguno de los tipos de trámite que atiende el mostrador
    public function atiende($unTramite){
        $atiendeTramite= true;
        foreach ($this -> getColTramites()as $valor){
            if ($valor == $unTramite){
                $atiendeTramite = true;
            }
        }
        return $atiendeTramite;
    }


    //METODO TOSTRING DE LA CLASE
    public function __toString()
    {
        $infoMostrador = "\nInformacion del mostrador " . $this -> getNroMostrador() . "\n";
        for ($k=0;$k<(count($this->getColTramites()));$k++){
            $infoMostrador = $infoMostrador . "Tramite " . ($k+1) . " que realiza: " . $this->getColTramites()[$k] ."\n";
        }
        $infoMostrador = $infoMostrador . "Cantidad maxima de clientes: ".$this -> getObjCola()-> getCantMaxClientes().
                                          "\nCantidad actual de cliente: " . $this -> getObjCola() -> getCantActualClientes() . "\n";
        
        return $infoMostrador;
    }
}
?>
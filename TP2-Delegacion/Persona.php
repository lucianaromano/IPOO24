<?php
class Persona {
    private $nombre;
    private $apellido;
    private $tipoDoc;
    private $numDoc;

    public function __construct($n,$a,$tDoc,$nDoc){
        $this->nombre =$n;
        $this->apellido=$a;
        $this->tipoDoc = $tDoc;
        $this-> numDoc = $nDoc;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($n){
        $this-> nombre=$n;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function setApellido($a){
        $this-> apellido=$a;
    }
    public function getTipoDoc(){
        return $this->tipoDoc;
    }

    public function setTipoDoc($tDoc){
        $this-> tipoDoc=$tDoc;
    }
    public function getNumDoc(){
        return $this->numDoc;
    }

    public function setNumDoc($nDoc){
        $this-> numDoc=$nDoc;
    }


    public function __toString()
    {
        $cadena ="\n -Nombre: " .$this->getNombre(). 
                "\n -Apellido: " .$this->getApellido().
                "\n -Tipo de documento: " .$this->getTipoDoc().
                "\n -Numero de documento: ".$this->getNumDoc();
        return $cadena;
    }
}
?>
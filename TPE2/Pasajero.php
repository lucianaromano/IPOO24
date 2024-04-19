<?php
//Cada pasajero guarda  su “nombre”, “apellido” y “numero de documento”.
class Pasajero {
    private $nombre;
    private $apellido;
    private $numDoc;
    private $telefono;
    
    //metodo constructor de la clase
    public function __construct($n,$a,$doc,$tel)
    {
        $this-> nombre = $n;
        $this-> apellido= $a;
        $this-> numDoc= $doc;
        $this-> telefono = $tel;
    }

    //metodos de acceso get
    public function getNombre (){
        return $this->nombre;
    }

    public function getApellido (){
        return $this->apellido;
    }

    public function getNumDoc(){
        return $this-> numDoc;
    }

    public function getTelefono(){
        return $this-> telefono;
    }

    //metodos de acceso set
    public function setNombre($n){
        $this->nombre=$n;
    }

    public function setApellido($a){
        $this->apellido=$a;
    }

    public function setNumDoc($doc){
        $this->numDoc=$doc;
    }

    public function setTelefono($tel){
        $this->telefono=$tel;
    }

    //metodo toString de la clase
    public function __toString(){
        $infoPasajero= "\nNombre: ". $this->getNombre().
        "\nApellido: ".$this->getApellido().
        "\nNumero de documento: ".$this->getNumDoc().
        "\nTelefono: ".$this->getTelefono()."\n";
        return $infoPasajero;
    }
}
?>
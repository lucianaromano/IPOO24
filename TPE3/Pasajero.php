<?php
//La clase Pasajero tiene como atributos el nombre, el número de asiento y el número de ticket del pasaje del viaje
class Pasajero {
    private $nombre;
    private $apellido;
    private $numDoc;
    private $telefono;
    //NUEVOS ATRIBUTOS
    private $numAsiento;
    private $numTicket;
    
    //metodo constructor de la clase
    public function __construct($n,$a,$doc,$tel,$numAsiento,$numTicket){
        $this-> nombre = $n;
        $this-> apellido= $a;
        $this-> numDoc= $doc;
        $this-> telefono = $tel;
        $this-> numAsiento = $numAsiento;
        $this-> numTicket = $numTicket;
    
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

    public function getNumAsiento(){
        return $this-> numAsiento;
    }

    public function getNumTicket(){
        return $this-> numTicket;
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

    public function setNumAsiento($num){
        $this->numAsiento=$num;
    }

    public function setNumTicket($num){
        $this->numTicket=$num;
    }
    //metodo toString de la clase
    public function __toString(){
        $infoPasajero= "\nNombre: ". $this->getNombre().
        "\nApellido: ".$this->getApellido().
        "\nNumero de documento: ".$this->getNumDoc().
        "\nTelefono: ".$this->getTelefono().
        "\nNúmero de asiento: ".$this->getNumAsiento().
        "\nNúmero de ticket: " .$this->getNumTicket();
        return $infoPasajero;
    }

    /**para los pasajeros comunes el porcentaje de incremento es del 10 %.*/
    public function darPorcentajeIncremento(){
        $incremento = 10;
        return $incremento;
    }
}
?>
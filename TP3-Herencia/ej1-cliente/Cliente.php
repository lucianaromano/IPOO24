<?php
class Cliente extends Persona{
    //clase que representa a una persona
    private $nroCliente;

    public function __construct($dni,$nombre,$apellido,$nroCliente){
        //invoco al constructor de persona
        parent:: __construct($dni,$nombre,$apellido);
        //agregamos el nuevo atributo
        $this-> nroCliente = $nroCliente;
    }

    //metodos de acceso
    public function getNroCliente(){
        return $this-> nroCliente;
    }

    public function setNroCliente ($nroCliente){
        $this-> nroCliente = $nroCliente;
    }

    //otros metodos
    public function __toString(){
        //invoco al toString de persona
        $cadena = parent:: __toString();
        $cadena = "Número de cliente: ".$this->getNroCliente()."\n";
        return $cadena;
    }
}
?>
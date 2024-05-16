<?php
class Persona {
    private $dni;
    private $nombre;
    private $apellido;

    public function __construct($dni,$nombre,$apellido){
        $this-> dni = $dni;
        $this-> nombre = $nombre;
        $this-> apellido = $apellido;
    }
    //OBSERVADORES
    public function getDni(){
        return $this-> dni ;
    }

    public function getNombre(){
        return $this-> nombre ;
    }

    public function getApellido(){
        return $this-> apellido ;
    }

    //MODIFICADORES
    public function setDni($dni){
        $this-> dni = $dni;
    }

    public function setNombre($nombre){
        $this-> nombre = $nombre;
    }

    public function setApellido($apellido){
        $this-> apellido = $apellido;
    }

    //OTROS METODOS 
    public function __toString(){
        //string $cadena 
        $cadena = "Dni: " .$this->getDni()."\n";
        $cadena = $cadena . "Nombre: ".$this->getNombre()."\n";
        $cadena = $cadena . "Apellido: ".$this->getNombre()."\n";

        return $cadena;
    }
}
?>
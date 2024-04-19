<?php

class Persona{
    private $nombre;
    private $apellido;
    private $documento;
    private $fechaNacimiento;

    public function __construct($nombre,$apellido,$dni,$fechaNac){
        $this->nombre = $nombre;
        $this->apellido=$apellido;
        $this->documento=$dni;
        $this->fechaNacimiento=$fechaNac;
    }
    
    public function getNombre (){
        return $this->nombre;
    }

    public function getApellido (){
        return $this->apellido;
    }

    public function getDocumento (){
        return $this->documento;
    }

    public function getFechaNacimiento (){
        return $this->fechaNacimiento;
    }

    public function setNombre($nombre){
        $this-> nombre=$nombre;
    }
    public function setApellido($apellido){
        $this-> apellido=$apellido;
    }
    public function setDocumento($dni){
        $this-> documento=$dni;
    }
    public function setFechaNacimiento($fechaNac){
        $this-> fechaNacimiento=$fechaNac;
    }

    public function __toString()
    {
        $cadena = "Los datos de la persona son: 
                   \n Nombre: ". $this->getNombre().
                   "\n Apellido: ".$this->getApellido().
                   "\n Documento: ".$this->getDocumento().
                   "\n Fecha de nacimiento: ".$this->getFechaNacimiento();
        return $cadena;
    }
    
}

?>
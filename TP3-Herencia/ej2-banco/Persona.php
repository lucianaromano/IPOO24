<?php

class Persona
{
    //ATRIBUTOS
    private $nombre;
    private $apellido;
    private $dni;

    //CONSTRUCTOR
    public function __construct($n, $a, $d)
    {
        $this->nombre = $n;
        $this->apellido = $a;
        $this->dni = $d;
    }

    //OBSERVADORES
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getDni()
    {
        return $this->dni;
    }

    //MODIFICADORES
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    public function __toString()
    {
        return "Nombre: " . $this->getNombre() . "\n" .
        "Apellido: " . $this->getApellido() . "\n" .
        "DNI: " . $this->getDni();
    }
}

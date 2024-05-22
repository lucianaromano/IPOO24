<?php
include 'Persona.php';

class Cliente extends Persona
{
    //ATRIBUTOS
    private $numero;

    //CONSTRUCTOR
    public function __construct($n, $a, $d, $num)
    {
        parent::__construct($n, $a, $d);
        $this->numero = $num;
    }

    //OBSERVADORES
    public function getNumero()
    {
        return $this->numero;
    }

    //MODIFICADORES
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function __toString() {
        $retorno = parent::__toString();
        $retorno .= "\nNumero: " . $this->getNumero();
        return $retorno;
    }
}

<?php
include 'Cuenta.php';

class CuentaCorriente extends Cuenta
{
    //ATRIBUTOS
    private $montoMaximo;

    //CONSTRUCTOR
    public function __construct($n, $d, $s, $mM)
    {
        parent::__construct($n, $d, $s);
        $this->montoMaximo = $mM;
    }

    //OBSERVADORES
    public function getMontoMaximo()
    {
        return $this->montoMaximo;
    }

    //MODIFICADORES
    public function setMontoMaximo($montoMaximo)
    {
        $this->montoMaximo = $montoMaximo;
    }

    public function __toString()
    {
        $retorno = parent::__toString();
        $retorno .= "Monto maximo: " . $this->getMontoMaximo();
    }

    public function realizarRetiro($monto)
    {
        if ($monto <= $this->getMontoMaximo()) {
            parent::realizarRetiro($monto);
        }
    }
}

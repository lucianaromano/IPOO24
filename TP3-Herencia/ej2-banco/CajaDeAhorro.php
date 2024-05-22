<?php
include 'Cuenta.php';
class CajaDeAhorro extends Cuenta
{
    //CONSTRUCTOR
    public function __construct($n, $d, $s)
    {
        parent::__construct($n, $d, $s);
    }

    public function __toString() {
        return parent::__toString();
    }
}

<?php
class Cuenta
{
    //ATRIBUTOS
    private $numero;
    private $duenio;
    private $saldo;

    //CONSTRUCTOR
    public function __construct($n, $d, $s)
    {
        $this->numero = $n;
        $this->duenio = $d;
        $this->saldo = $s;
    }

    //OBSERVADORES
    public function getNumero()
    {
        return $this->numero;
    }

    public function getDuenio()
    {
        return $this->duenio;
    }

    public function getSaldo()
    {
        return $this->saldo;
    }

    //MODIFICADORES
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function setDuenio($duenio)
    {
        $this->duenio = $duenio;
    }

    public function setSaldo($saldo) {
        $this->saldo = $saldo;
    }

    public function __toString(){
        return "Numero: " . $this->getNumero() . "\n" .
        "Duenio: " . $this->getDuenio() . "\n" .
        "Saldo: $" . $this->getSaldo();
    }

    public function saldoCuenta() {
        return $this->getSaldo();
    }

    public function realizarDeposito($monto) {
        $suma = $this->getSaldo() + $monto;
        $this->setSaldo($suma);
    }

    public function realizarRetiro($monto) {
        $exito = false;
        $saldo = $this->getSaldo();
        if($saldo - $monto >= 0) {
            $resta = $saldo - $monto;
            $this->setSaldo($resta);
            $exito = true;
        }
        return $exito;
    }
}

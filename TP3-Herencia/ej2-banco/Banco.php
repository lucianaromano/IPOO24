<?php
include 'ejercicio2.CajaDeAhorro.php';
include 'ejercicio2.CuentaCorriente.php';
include 'ejercicio1.Cliente.php';
class Banco
{
    //ATRIBUTOS
    private $coleccionCuentaCorriente;
    private $coleccionCajaAhorro;
    private $ultimoValorCuentaAsignado;
    private $coleccionCliente;

    //CONSTRUCTOR
    public function __construct()
    {
        $this->coleccionCuentaCorriente = [];
        $this->coleccionCajaAhorro = [];
        $this->ultimoValorCuentaAsignado = null;
        $this->coleccionCliente = [];
    }

    //OBSERVADORES
    public function getColeccionCuentaCorriente()
    {
        return $this->coleccionCuentaCorriente;
    }

    public function getColeccionCajaAhorro()
    {
        return $this->coleccionCajaAhorro;
    }

    public function getUltimoValorCuentaAsignado()
    {
        return $this->ultimoValorCuentaAsignado;
    }

    public function getColeccionCliente()
    {
        return $this->coleccionCliente;
    }

    //MODIFICADORES
    public function setColeccionCuentaCorriente($coleccionCuentaCorriente)
    {
        $this->coleccionCuentaCorriente = $coleccionCuentaCorriente;
    }

    public function setColeccionCajaAhorro($coleccionCajaAhorro)
    {
        $this->coleccionCajaAhorro = $coleccionCajaAhorro;
    }

    public function setUltimoValorCuentaAsignado($ultimoValorCuentaAsignado)
    {
        $this->ultimoValorCuentaAsignado = $ultimoValorCuentaAsignado;
    }

    public function setColeccionCliente($coleccionCliente)
    {
        $this->coleccionCliente = $coleccionCliente;
    }

    public function __toString()
    {
        return "----------CUENTAS CORRIENTES----------\n" .
        $this->coleccionAString($this->getColeccionCuentaCorriente()) .
        "----------CAJAS DE AHORRO----------\n" .
        $this->coleccionAString($this->getColeccionCajaAhorro()) .
        "Ultimo valor asignado: " . $this->getUltimoValorCuentaAsignado() . "\n" .
        "----------CLIENTES----------\n" .
        $this->coleccionAString($this->getColeccionCliente());
    }

    public function coleccionAString($coleccion)
    {
        $retorno = "";
        for ($i = 0; $i < count($coleccion); $i++) {
            $retorno .= $coleccion[$i] . "\n--------------------\n";
        }
        return $retorno;
    }

    public function incorporarCliente($objCliente)
    {
        $coleccion = $this->getColeccionCliente();
        array_push($coleccion, $objCliente);
        $this->setColeccionCliente($coleccion);
    }

    public function incorporarCuentaCorriente($numeroCliente)
    {
        $coleccionClientes = $this->getColeccionCliente();
        $i = 0;
        $pertenece = false;
        do {
            if ($coleccionClientes[$i] == $numeroCliente) {
                $pertenece = true;
            }
            $i++;
        } while ($i < count($coleccionClientes) && !$pertenece);
        if ($pertenece) {
            $cliente = $coleccionClientes[$i - 1];
            $coleccionCuentasCorrientes = $this->getColeccionCuentaCorriente();
            $numeroCuenta = count($coleccionCuentasCorrientes);
            $nuevaCuenta = new CuentaCorriente($numeroCuenta, $cliente, 0, 0);
            array_push($coleccionCuentasCorrientes, $nuevaCuenta);
            $this->setColeccionCuentaCorriente($coleccionCuentasCorrientes);
        }
    }

    public function incorporarCajaAhorro($numeroCliente)
    {
        $coleccionClientes = $this->getColeccionCliente();
        $i = 0;
        $pertenece = false;
        do {
            if ($coleccionClientes[$i] == $numeroCliente) {
                $pertenece = true;
            }
            $i++;
        } while ($i < count($coleccionClientes) && !$pertenece);
        if ($pertenece) {
            $cliente = $coleccionClientes[$i - 1];
            $coleccionCajasAhorro = $this->getColeccionCajaAhorro();
            $numeroCuenta = count($coleccionCajasAhorro);
            $nuevaCuenta = new CajaDeAhorro($numeroCuenta, $cliente, 0, 0);
            array_push($coleccionCajasAhorro, $nuevaCuenta);
            $this->setColeccionCajaAhorro($coleccionCajasAhorro);
        }
    }

    public function realizarDeposito($numCuenta, $monto) {
        $coleccionCuentasCorrientes = $this->getColeccionCuentaCorriente();
        
    }
}

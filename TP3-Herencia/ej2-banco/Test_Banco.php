<?php

include "PersonaH.php";
include "Cliente.php";
include "Cuenta.php";
include "CuentaCorriente.php";
include "CajaAhorro.php";

$cliente = new Cliente(1,43216200,"Victoria","Perez");

///////CAJA DE AHORRO///////
$cajaAhorro = new CajaDeAhorro (1,1000,$cliente);
echo $cajaAhorro."\n\n";
$retiro=$cajaAhorro->realizarRetiro(100);
echo "Retiro de caja de ahorro: ";
if ($retiro) {
    echo "Se realizo el retiro";
}else{
    echo "No se puede realizar el retiro";
}
echo"\n" .$cajaAhorro."\n\n";

//////CUENTA CORRIENTE////////////
$cuentaCorriente = new CuentaCorriente (1,1000,$cliente,1500);
echo $cuentaCorriente."\n\n";
$retiro=$cuentaCorriente->realizarRetiro(1700);
echo "Retiro de caja de ahorro: ";
if ($retiro) {
    echo "Se realizo el retiro";
}else{
    echo "No se puede realizar el retiro";
}
echo"\n" .$cuentaCorriente."\n\n";
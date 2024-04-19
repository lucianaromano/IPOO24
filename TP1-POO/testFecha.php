<?php

include 'fecha.php';


$fecha = new fecha(20, 3, 2023);
echo "---------indica si el anio ingresado es bisiesto--------------" . "\n";
if ($fecha->bisiesto()) {
    echo "es anio bisiesto" . "\n";
} else {
    echo "no es anio bisiesto" . "\n";
}

$fecha->incrementaUnDia(27);
echo $fecha;

?>
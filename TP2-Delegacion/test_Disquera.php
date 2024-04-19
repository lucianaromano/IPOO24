<?php
include_once 'Disquera.php';
include_once 'Persona.php';

$persona = new Persona("Luciana","Romano","DNI",42604817);
$disquera = new Disquera (10.00,20.00,"Abierto","Patquia 1969", $persona );
echo $disquera ;

echo "Ingrese la hora: ";
$hora = trim(fgets(STDIN));
echo "Ingrese los minutos: ";
$minutos = trim(fgets(STDIN));

//if ($respuesta=$horario->dentroHorarioAtencion($hora,$minutos) == true ) {
//    echo "La disquerra se encuentra abierta.";
//};

?>
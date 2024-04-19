<?php

include 'reloj.php';

$reloj = new reloj(23, 59, 58);
echo $reloj . "\n";
$reloj->incremento();
echo $reloj . "\n";
$reloj->incremento();
echo $reloj . "\n";
$reloj2 = new reloj(12, 25, 13);
echo $reloj2 . "\n";
$reloj2->puestaACero();
echo $reloj2 . "\n";

?>
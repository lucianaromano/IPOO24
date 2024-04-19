<?php

include 'calculadora.php';

$calculadora = new calculadora (10,2);

echo $calculadora ."\n";
echo $calculadora ->getNum1()."\n";
echo $calculadora ->getNum2()."\n";


$suma= $calculadora->suma();
echo "La suma es: ".$suma."\n";

$resta= $calculadora->resta();
echo "La resta es: ".$resta."\n";

$division = $calculadora->division();
echo "La div es: ".$division."\n";

$multi= $calculadora->multiplicacion();
echo "La multiplicacion es: ".$multi."\n";


$calculadora2= new Calculadora(20,3);
echo $calculadora2->getNum1()."\n";
echo $calculadora2->getNum2()."\n";
echo $calculadora2;

?>
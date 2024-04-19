<?php
include_once 'Lectura.php';
include_once 'Libro.php';

$objLibro= new Libro ();
$Lectura= new Lectura ($objLibro, 52);

echo $lectura;

?>
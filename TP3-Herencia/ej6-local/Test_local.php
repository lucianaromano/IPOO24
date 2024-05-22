<?php

include_once('cliente.php');
include_once('importado.php');
include_once('regional.php');
include_once('productos.php');
include_once('rubro.php');
include_once('venta.php');
include_once('local.php');

$rubroConservas = new Rubro("Conservas", 35);
$rubroRegalos = new Rubro("Regalos", 55);

$productoBombones = new Importado(23, "CajaBombones", 3, 2, 300, $rubroRegalos, "Chile");
$productoCerveza = new Importado(43, "CervezaNegra", 4, 1, 200, $rubroRegalos, "Alemania");
$productoCerezas = new Regional(323, "CerezasEnAlmibar", 8, 2, 350, $rubroConservas, 5);
$productoDurazno = new Regional(532, "DuraznosEnLata", 3, 3, 270, $rubroConservas, 8);

$tienda = new Local([$productoBombones, $productoCerezas, $productoCerveza, $productoDurazno],
[$productoBombones, $productoCerveza], [$productoCerezas, $productoDurazno]);
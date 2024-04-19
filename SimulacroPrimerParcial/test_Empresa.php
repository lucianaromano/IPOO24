<?php
include_once ('Cliente.php');
include_once ('Empresa.php');
include_once ('Moto.php');
include_once ('Venta.php');

function mostrarDatosColeccion ($unaColeccion){
    echo "### VENTAS ###". "\n";
    foreach ($unaColeccion as $unElemento){
        echo $unElemento . "\n";
    }
    echo "### VENTAS ###". "\n";
}

// 1. Cree 2 instancias de la clase Cliente: $objCliente1, $objCliente2. 
$objCliente1= new Cliente("Luciana","Romano","no", "DNI",42604817);
$objCliente2= new Cliente("Nahuel","Ruiz","si","DNI", 40443386);

//echo $objCliente1; 

//2 Cree 3 objetos Motos con la información visualizada en la tabla: código, costo, año fabricación,
//descripción, porcentaje incremento anual, activo.

$objMoto1 = new Moto(11,2230000,2022,"Benelli Imperiale 400",85,true);
$objMoto2 = new Moto(12,548000,2021,"Zanella Zr 150 Ohc",70,true);
$objMoto3 = new Moto(13,999900,2023,"Zanella Patagonian Eagle 250", 55, false);

//echo $objMoto3;

//4. Se crea un objeto Empresa  con la siguiente informacion

$colMotos = [$objMoto1, $objMoto2, $objMoto3];
$colClientes = [$objCliente1, $objCliente2];
$colVentasRealizadas = [];
//echo($colClientes[0]);

$objEmpresa1 = new Empresa ("Alta gama", "Av argentina 123", $colClientes, $colMotos,$colVentasRealizadas); 

echo "=================================================="."\n";
echo "====================  PUNTO 1  ==================="."\n";
echo "=================================================="."\n";
echo $objEmpresa1;
echo "\n";
echo "\n ";

/**5. Invocar al método registrarVenta($colCodigosMoto, $objCliente) de la Clase Empresa donde el
$objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
punto 1) y la colección de códigos de motos es la siguiente [11,12,13]. Visualizar el resultado obtenido.
*/
$resp = $objEmpresa1 ->registrarVenta ([11,12,13], $objCliente2);
echo "=================================================="."\n";
echo "====================  PUNTO 5  ==================="."\n";
echo "=================================================="."\n";

if ($resp>0 ) {
    echo "La venta pudo realizarse , el importe TOTAL = " .$resp ."\n";
    echo $objEmpresa1;
} else {
    echo "La venta no pudo realizarse correctamente";
}

/*6. Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el
$objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
punto 1) y la colección de códigos de motos es la siguiente [0]. Visualizar el resultado obtenido.
7. Invocar al método registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el
$objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el
punto 1) y la colección de códigos de motos es la siguiente [2]. Visualizar el resultado obtenido.
8. Invocar al método retornarVentasXCliente($tipo,$numDoc) donde el tipo y número de documento se
corresponden con el tipo y número de documento del $objCliente1.
9. Invocar al método retornarVentasXCliente($tipo,$numDoc) donde el tipo y número de documento se
corresponden con el tipo y número de documento del $objCliente2
10. Realizar un echo de la variable Empresa creada en 2. */

?>
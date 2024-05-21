<?php
include_once ('Cliente.php');
include_once ('Empresa.php');
include_once ('Moto.php');
include_once ('Venta.php');
include_once ('MotoNacional.php');
include_once ('MotoImportada.php');


function mostrarDatosColeccion($coleccion){
    $cadena = "";
    foreach ($coleccion as $unElementoCol){
        $cadena = $cadena . "." . $unElementoCol . "\n";
    }
    return $cadena;
}

// 1. Cree 2 instancias de la clase Cliente: $objCliente1, $objCliente2. 
$objCliente1= new Cliente("Luciana","Romano","alta", "DNI","42604817");
$objCliente2= new Cliente("Nahuel","Ruiz","alta","DNI", "40443386");

//echo $objCliente1; 

//2 Cree 4 objetos Motos con la información visualizada en la tabla

$objMoto1 = new MotoNacional(11,2230000,2022,"Benelli Imperiale 400",85,true);
$objMoto2 = new MotoNacional(12,548000,2021,"Zanella Zr 150 Ohc",70,true);
$objMoto3 = new MotoNacional(13,999900,2023,"Zanella Patagonian Eagle 250", 55, false);
$objMoto4 = new MotoImportada(14,12499900,2020,"Pitbike Enduro Motocross Apollo Aiii 190cc Plr",100,true,"Francia",6244400);

//4. Se crea un objeto Empresa  con la siguiente informacion

$colMotos = [$objMoto1, $objMoto2, $objMoto3, $objMoto4];
$colClientes = [$objCliente1, $objCliente2];
$colVentasRealizadas = [];


$objEmpresa1 = new Empresa ("Alta gama", "Av argentina 123", $colClientes, $colMotos,$colVentasRealizadas); 


/**4.Invocar al método  registrarVenta($colCodigosMoto, $objCliente) de la Clase Empresa donde el $objCliente
 *  es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el punto 1) y la
 *  colección de códigos de motos es la siguiente [11,12,13,14]. Visualizar el resultado obtenido.
*/
$resp = $objEmpresa1 ->registrarVenta ([11,12,13,14], $objCliente2);
echo "=================================================="."\n";
echo "====================  PUNTO 4  ==================="."\n";
echo "=================================================="."\n";

if ($resp>0 ) {
    echo "La venta pudo realizarse , el importe TOTAL = $" .$resp ."\n";
    echo $objEmpresa1;
} else {
    echo "La venta no pudo realizarse, quizas los codigos o el cliente no se encuentran activos"."\n";
}

/*5.Invocar al método  registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el $objCliente
es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el punto 1) y la
colección de códigos de motos es la siguiente [13,14].  Visualizar el resultado obtenido.
*/
$resp = $objEmpresa1 ->registrarVenta ([13,14],$objCliente2);
echo"\n";
echo "=================================================="."\n";
echo "====================  PUNTO 5  ==================="."\n";
echo "=================================================="."\n";
if ($resp>0 ) {
    echo "La venta pudo realizarse , el importe TOTAL = $" .$resp ."\n";
    echo $objEmpresa1;
} else {
    echo "La venta no pudo realizarse, quizas los codigos o el cliente no se encuentran activos"."\n";
}

/**6. Invocar al método  registrarVenta($colCodigosMotos, $objCliente) de la Clase Empresa donde el $objCliente
 * es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el punto 1) y la 
 * colección de códigos de motos es la siguiente [14,2].  Visualizar el resultado obtenido.
*/
$resp = $objEmpresa1 ->registrarVenta ([14,2],$objCliente2);
echo"\n";
echo "=================================================="."\n";
echo "====================  PUNTO 6  ==================="."\n";
echo "=================================================="."\n";
if ($resp>0 ) {
    echo "La venta pudo realizarse , el importe TOTAL = $" .$resp ."\n";
    echo $objEmpresa1;
} else {
    echo "La venta no pudo realizarse, quizas los codigos o el cliente no se encuentran activos"."\n";
}
/*7. Invocar al método  informarVentasImportadas().  Visualizar el resultado obtenido.*/
$coleccion = $objEmpresa1 ->informarVentasImportadas();
echo"\n";
echo "=================================================="."\n";
echo "====================  PUNTO 7  ==================="."\n";
echo "=================================================="."\n";
echo "Punto 7). " . mostrarDatosColeccion($coleccion);
// mostrarDatosColeccion($colVentas);

/**8.Invocar al método  informarSumaVentasNacionales().  Visualizar el resultado obtenido.*/
$resultado = $objEmpresa1 ->informarSumaVentasNacionales();
echo"\n";
echo "=================================================="."\n";
echo "====================  PUNTO 8  ==================="."\n";
echo "=================================================="."\n";
echo "el importe total de ventas Nacionales realizadas por la empresa es: $" .$resultado ."\n";
//9.Realizar un echo de la variable Empresa creada en 2. */

echo"\n";
echo "=================================================="."\n";
echo "====================  PUNTO 9  ==================="."\n";
echo "=================================================="."\n";

echo $objEmpresa1;
echo "\n";
?>
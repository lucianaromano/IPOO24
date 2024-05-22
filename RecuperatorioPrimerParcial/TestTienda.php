<<<<<<< HEAD
<?php

include_once ('Item.php');
include_once ('Producto.php');
include_once ('Tienda.php');
include_once ('Venta.php');

/**Crear  una colección con un mínimo de 4 productos, uno de los productos tiene como código de barra 0001 y cantidad stock 3. */
echo "--------------------EJERCICIO 1--------------------";
$objProducto1 = new Producto (0001, "Nike", "Negro", 2,"Remera", 3);
$objProducto2 = new Producto (0003, "Adidas", "Azul", 38, "Pantalon", 2);
$objProducto3 = new Producto (0004,"Adidas","Rosa",40,"Pantalon",4);
$objProducto4 = new Producto (0005,"Puma","Blanco",36, "Zapatillas", 10);

$colProductos = [$objProducto1,$objProducto2,$objProducto3,$objProducto4];

/**Crear  un objeto Tienda con la colección de productos creada en la respuesta anterior. */
echo "--------------------EJERCICIO 2--------------------";

$objTienda1 = new Tienda ("Stock center", "J.J.Lastra 1800", 2994058750 ,$colProductos ,[]);

/**Crear un arreglo asociativo con la información de 3 de los productos que se encuentran en la colección 
 * creada en 1. Uno de los elementos del arreglo asociativo es:  codigoBarra=0001 y  cantidad=5 */
echo "--------------------EJERCICIO 3--------------------";
$arrayProducto1 = ["codigoBarra" => 0001,"stock"=> 5];
$arrayProducto2 = ["codigoBarra"=> 0002, "stock"=> 2];
$arrayProducto3 = ["codigoBarra" => 0003, "stock"=>4];
$array[0] =$arrayProducto1;
$array[1]= $arrayProducto2;
$array[2]=$arrayProducto3;
/**Invocar al método  realizarVenta con el arreglo asociativo creado en 3 */
echo "--------------------EJERCICIO 4--------------------";
$objVenta = $objTienda1 -> realizarVenta ($array);
//echo $objVenta;

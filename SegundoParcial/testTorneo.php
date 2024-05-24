<?php
include_once("Categoria.php");
include_once("Torneo.php");
include_once("Equipo.php");
include_once("Partido.php");
include_once("PartidoFutbol.php");
include_once("PartidoBasquet.php");

function mostrarDatosColeccion ($unaColeccion){
    echo "-----". "\n";
    foreach ($unaColeccion as $unElemento){
        echo $unElemento . "\n";
    }
    echo "------". "\n";
}

$catMayores = neW Categoria(1,'Mayores');
$catJuveniles = new Categoria(2,'juveniles');
$catMenores = neW Categoria(1,'Menores');

$objE1 = neW Equipo("Equipo Uno", "Cap.Uno",1,$catMayores);
$objE2 = neW Equipo("Equipo Dos", "Cap.Dos",2,$catMayores);

$objE3 = neW Equipo("Equipo Tres", "Cap.Tres",3,$catJuveniles);
$objE4 = neW Equipo("Equipo Cuatro", "Cap.Cuatro",4,$catJuveniles);

$objE5 = neW Equipo("Equipo Cinco", "Cap.Cinco",5,$catMayores);
$objE6 = neW Equipo("Equipo Seis", "Cap.Seis",6,$catMayores);

$objE7 = neW Equipo("Equipo Siete", "Cap.Siete",7,$catJuveniles);
$objE8 = neW Equipo("Equipo Ocho", "Cap.Ocho",8,$catJuveniles);

$objE9 = neW Equipo("Equipo Nueve", "Cap.Nueve",9,$catMenores);
$objE10 = neW Equipo("Equipo Diez", "Cap.Diez",9,$catMenores);

$objE11 = neW Equipo("Equipo Once", "Cap.Once",11,$catMayores);
$objE12 = neW Equipo("Equipo Doce", "Cap.Doce",11,$catMayores);


/**1.Crear un objeto de la clase Torneo donde el importe base del premio es de: 100.000.  */
$objTorneo1 = new Torneo (array(),100000);

/**2.crear 3 objetos partidos de Básquet  con la siguiente información:*/
//$idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2, $cantInfracciones
$PartidoBasquet1 = new PartidoBasquet (11,'2024-05-05',$objE7,80,$objE8,120,7);
$PartidoBasquet2 = new PartidoBasquet (12,'2024-05-06',$objE9,81,$objE10,110,8);
$PartidoBasquet3 = new PartidoBasquet (13,'2024-05-07',$objE11,115,$objE12,85,9);

/**2.b. Crear 3 objetos partidos de Fútbol con la siguiente información*/
//$idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2
$PartidoFutbol1 = new PartidoFutbol (14,'2024-05-07',$objE1,3,$objE2,2);
$PartidoFutbol2 = new PartidoFutbol (15,'2024-05-08',$objE3,0,$objE4,1);
$PartidoFutbol3 = new PartidoFutbol (16,'2024-05-09',$objE5,2,$objE6,3);

/**3. Completar el script testTorneo.php para invocar al método : */
/**ingresarPartido($objE5, $objE11, '2024-05-23', 'Futbol'); visualizar la respuesta y la cantidad de equipos del torneo.*/
echo "\n-----------------------------------------------\n";
echo "\n----------------EJERCICIO 3.a------------------\n";
echo "\n-----------------------------------------------\n";

$resp = $objTorneo1 ->ingresarPartido($objE5, $objE11, '2024-05-23', 'futbol');
echo "-----Partido ingresado-----". mostrarDatosColeccion($resp) ."\n";
//echo "Cantidad de partidos en el torneo: ". cantidadPartidos($resp) ."\n";

/**ingresarPartido($objE11, $objE11, '2024-05-23', 'basquetbol') ; visualizar la respuesta y la cantidad de equipos del torneo.
*/
echo "\n-----------------------------------------------\n";
echo "\n----------------EJERCICIO 3.b------------------\n";
echo "\n-----------------------------------------------\n";

$resp = $objTorneo1 ->ingresarPartido($objE11, $objE11, '2024-05-23', 'basquet');
echo "-----Partido ingresado-----". mostrarDatosColeccion($resp) ."\n";
//echo "Cantidad de partidos en el torneo: ". cantidadPartidos($resp) ."\n";

/**ingresarPartido($objE9, $objE10, '2024-05-25', 'basquetbol'); visualizar la respuesta y la cantidad de equipos del torneo.
*/
echo "\n-----------------------------------------------\n";
echo "\n----------------EJERCICIO 3.c------------------\n";
echo "\n-----------------------------------------------\n";

$resp = $objTorneo1 ->ingresarPartido($objE9, $objE10, '2024-05-25', 'basquet');
echo "-----Partido ingresado-----". mostrarDatosColeccion($resp) ."\n";
//echo "Cantidad de partidos en el torneo: ". cantidadPartidos($resp) ."\n";

/**3.d- darGanadores(‘basquet’) y visualizar el resultado.*/
echo "\n-----------------------------------------------\n";
echo "\n----------------EJERCICIO 3.d------------------\n";
echo "\n-----------------------------------------------\n";

$ganadorBasquet = $objTorneo1 ->darGanadores('basquet');
echo "-----GANADOR BASQUET-----". mostrarDatosColeccion($ganadorBasquet) ."\n";

/**3.e- darGanadores(‘basquet’) y visualizar el resultado.*/
echo "\n-----------------------------------------------\n";
echo "\n----------------EJERCICIO 3.e------------------\n";
echo "\n-----------------------------------------------\n";

$ganadorFutbol = $objTorneo1 ->darGanadores('futbol');
echo "-----GANADOR FUTBOL-----". mostrarDatosColeccion($ganadorFutbol) ."\n";

/**3.f- calcularPremioPartido con cada uno de los partidos obtenidos en a,b,c.*/
echo "\n-----------------------------------------------\n";
echo "\n----------------EJERCICIO 3.e------------------\n";
echo "\n-----------------------------------------------\n";

$ganadorFutbol = $objTorneo1 ->darGanadores('futbol');
echo "-----GANADOR FUTBOL-----". mostrarDatosColeccion($ganadorFutbol) ."\n";

/**4.Realizar un echo del objeto  Torneo creado en (1).*/

echo $objTorneo1;


?>

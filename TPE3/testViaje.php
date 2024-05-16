<?php
/*Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú que permita 
cargar la información del viaje, modificar y ver sus datos.*/
include_once 'Viaje.php';
include_once 'Pasajero.php';
include_once 'ResponsableV.php';
include_once 'PasajeroEspecial.php';
include_once 'PasajeroVip.php';


$pasajero1 = new Pasajero ("Luciana","Romano",42604817,2994056653,20,1001);
$pasajero2 = new Pasajero ("Nahuel", "Ruiz", 40443386,299097006,21,1025);
$pasajero3 = new Pasajero ("Olivia", "Ruiz Romano", 59118307,2996329400,22,1047);

$colPasajeros = [$pasajero1,$pasajero2,$pasajero3];

$responsableV = new ResponsableV(250,10025,"Emiliano","Rodriguez");

$viaje  = new Viaje (1076, "Bariloche", 19, $colPasajeros,$responsableV);

//echo $viaje . "\n";
/**
 * Solicita al usuario una opcion del menu, vuelve a solicitar en caso de ser invalida.
 * @return int $opcion
 */
function menuOpciones(){
    echo "Ingrese la opcion deseada: \n";
    echo "(1) Información del viaje \n";
    echo "(2) Modificar informacion de un viaje \n";
    echo "(3) Datos de un pasajero \n";
    echo "(4) Modificar datos responsable de viaje \n";
    echo "(5) Vender pasaje";
    echo "(6) Salir \n";
    $opcion=trim(fgets(STDIN));

    if (!($opcion == 1 || $opcion == 2 || $opcion == 3 || $opcion == 4)){
        echo "Error. Ingrese una opción válida: \n";
    }
    return $opcion;
}

do {
    $opcion = (menuOpciones());
    switch($opcion)
        {
        case 1: //informacion del viaje
            echo "Los datos del viaje son: \n";
            echo $viaje."\n";
            break;
        case 2: //modificar informacion de un viaje
            echo $viaje."\n";
            echo "Ingrese un nuevo código de viaje: "; //modifico codigo del viaje
            $nuevoCodigo=trim(fgets(STDIN));
            $viaje->setCodigo($nuevoCodigo);
            echo "Ingrese un nuevo destino de viaje: "; //modifico el destino del viaje
            $nuevoDestino=trim(fgets(STDIN));
            $viaje->setDestino($nuevoDestino);
            echo "Ingrese nueva cantidad máxima de pasajeros del viaje: "; //modifico cantidad max de pasajeros
            $nuevaCantMax=trim(fgets(STDIN));
            $viaje->setCantMaxPasajeros($nuevaCantMax);
            echo $viaje."\n";
            break;
        case 3: //datos del pasajero
            $cadena = $viaje->mostrarDatosPasajeros(); //muestro datos precargados de pasajeros
            echo $cadena."\n";
            echo "Ingrese el número del pasajero a modificar: ";//modifico datos de un pasajero
            $num=trim(fgets(STDIN));
            echo "Ingrese el documento del pasajero a modificar: ";
            $dniAnterior=trim(fgets(STDIN));
            echo "Ingrese el nombre nuevo del pasajero: ";
            $nombreNuevo=trim(fgets(STDIN));
            echo "Ingrese el apellido nuevo del pasajero: ";
            $apellidoNuevo=trim(fgets(STDIN));
            echo "Ingrese el documento nuevo del pasajero: ";
            $dniNuevo=trim(fgets(STDIN));
            echo "Ingrese el nuevo numero de telefono: ";
            $telNuevo=trim(fgets(STDIN));
            $viaje->modificarDatos($num,$dniAnterior,$nombreNuevo,$apellidoNuevo,$dniNuevo,$telNuevo);
            $cadena=$viaje-> mostrarDatosPasajeros();
            echo $cadena ."\n";
            break;
        case 4:
            echo "Los anteriores datos del responbale son: \n";
            echo $viaje->getObjResponsableV()."\n\n";
            echo "Ingrese nuevo numero de empleado: \n";
            $newNroEmpleado= trim(fgets(STDIN));
            echo "Ingrese nuevo numero de Licencia: \n";
            $newNroLicEmpleado= trim(fgets(STDIN));
            echo "Ingrese nuevo nombre del empleado: \n";
            $newNomEmpleado= trim(fgets(STDIN));
            echo "Ingrese nuevo apellido del empleado: \n";
            $newApellEmpleado= trim(fgets(STDIN));
            $newEmpleado= $viaje->ModificarDatosResponsable($newNroEmpleado,$newNroLicEmpleado,$newNomEmpleado,$newApellEmpleado);
            echo "Los nuevos datos del responbale son: \n";
            echo $viaje->getObjResponsableV();
            break;
        case 5: 
            //creo el nuevo pasajero
            echo "Ingrese el nombre del pasajero\n";
            $nombre = trim(fgets(STDIN));
            echo "Ingrese el apellido del pasajero\n";
            $apellido = trim(fgets(STDIN));
            echo "Ingrese el documento del pasajero \n";
            $doc = trim(fgets(STDIN));
            echo "Ingrese el nuevo telefono del pasajero\n ";
            $telefono = trim(fgets(STDIN));
            echo "Ingrese el numero de asiento: \n";
            $numAsiento= trim(fgets(STDIN));
            echo "Ingrese el numero de ticket: \n";
            $ticket= trim(fgets(STDIN));
            $pasajero = new Pasajero($nombre,$apellido,$doc,$telefono,$numAsiento,$ticket);


            
        case 6: //salir 
            echo "Saliendo del programa... \n";
            sleep(3); //a los 3seg sale del programa.

        break;
        }
} while (($opcion>=1) && ($opcion<4))

?>
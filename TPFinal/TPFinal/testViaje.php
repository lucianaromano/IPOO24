<?php
/*Implementar dentro de la clase TestViajes una operación que permita ingresar, modificar
y eliminar la información de la empresa de viajes.
Implementar dentro de la clase TestViajes una operación que permita ingresar, modificar
y eliminar la información de un viaje, teniendo en cuenta las particularidades expuestas
en el dominio a lo largo del cuatrimestre.*/
include_once 'Viaje.php';
include_once 'Pasajero.php';
include_once 'Responsable.php';
include_once 'Empresa.php';
include_once 'BaseDatos.php';

function setColor($text, $color)
{
	$colors = [
		'black' => '0;30',
		'dark_gray' => '1;30',
		'blue' => '0;34',
		'light_blue' => '1;34',
		'green' => '0;32',
		'light_green' => '1;32',
		'cyan' => '0;36',
		'light_cyan' => '1;36',
		'red' => '0;31',
		'light_red' => '1;31',
		'purple' => '0;35',
		'light_purple' => '1;35',
		'brown' => '0;33',
		'yellow' => '1;33',
		'light_gray' => '0;37',
		'white' => '1;37',
	];

	$colorCode = isset($colors[$color]) ? $colors[$color] : '0;37'; // Default to light gray
	return "\033[" . $colorCode . "m" . $text . "\033[0m";
}

$base = new BaseDatos();

function limpiarConsola()
{
	echo "\033[2J\033[H";
}

/**********************************MENU GENERAL*****************************************/

function verTabla($tabla)
{
	if ($tabla == 'empresa') {
		$tablaEmpresas = new Empresa();
		$empresas = $tablaEmpresas->listar("");
		foreach ($empresas as $empresa) {
			echo $empresa;
			echo "----------------------------------------------------------------";
		}
	}

	if ($tabla == 'responsable') {
		$tablaResponsable = new Responsable();
		$responsables = $tablaResponsable->listar("");
		foreach ($responsables as $responsable) {
			echo $responsable;
			echo "----------------------------------------------------------------\n";
		}
	}
}

// function verTabla($base, $tabla)
// {
// 	if ($base->Iniciar()) {
// 		$consulta = "SELECT * FROM " . $tabla;
// 		if ($base->Ejecutar($consulta)) {
// 			$result = $base->getResult();
// 			if ($result) {
// 				while ($row = mysqli_fetch_assoc($result)) {
// 					// echo "Id:" . $row["idempresa"] . " | Nombre: " . $row["enombre"] . " | Dirección: " . $row["edireccion"] . "\n";
// 					switch ($tabla) {
// 						case 'empresa':
// 							echo "Id: " . $row["idempresa"] . " | Nombre: " . $row["enombre"] . " | Dirección: " . $row["edireccion"] . "\n";
// 							break;
// 						case 'empleado':
// 							echo "Id: " . $row["idempleado"] . " | Nombre: " . $row["nombre"] . " | Apellido: " . $row["apellido"] . " | Email: " . $row["email"] . "\n";
// 							break;
// 							// Añadir más casos según sea necesario para otras tablas
// 						default:
// 							echo "Tabla no reconocida.\n";
// 							break;
// 					}
// 				}
// 			} else {
// 				echo "No hay resultados.";
// 			}
// 			// $arr = mysqli_fetch_array($base->getConexion(), $consulta);
// 		}
// 		echo "Base de datos conectada";
// 	}
// }


do {
	limpiarConsola();
	echo "\n---------------------------OPCIONES GENERALES----------------------------

    1) Acceder a tabla Empresas.
    2) Acceder a tabla Viajes.
    3) Acceder a tabla Pasajeros.
    4) Acceder a tabla Responsables.
    0) Salir.\n
    Ingrese la opción: ";
	$opcion = trim(fgets(STDIN));
	switch ($opcion) {
		case 1:
			menuEmpresa();
			break;
		case 2:
			menuViaje();
			break;
		case 3:
			menuPasajero();
			break;
		case 4:
			menuResponsable();
			break;
		case 0:
			break;
		default:
			echo "Valor ingresado incorrecto.\n";
	}
} while ($opcion != 0);

// function verTabla($mysqli)
// {
//     echo "\n\n------------  EMPRESAS  ---------------\n";
//     $query = "SELECT * FROM empresa";
//     $result = $mysqli->query($query);
//     if ($result->num_rows > 0) {
//         while ($row = $result->fetch_assoc()) {
//             echo "Id:" . $row["idempresa"] . " | Nombre: " . $row["enombre"] . " | Dirección: " . $row["edireccion"] . "\n";
//         }
//     } else {
//         echo "No se encontraron resultados";
//     }
// }

/**********************************MENU VIAJE************************************************************/

function menuViaje()
{

	do {
		limpiarConsola();
		echo "************************* MENU VIAJE ************************************\n\n";
		echo "1) Crear viaje\n";
		echo "2) Modificar datos viaje\n";
		echo "3) Eliminar viaje\n";
		echo "4) Listar viajes\n";
		echo setColor("5) Volver\n\n", "red");
		echo "Ingrese una opción: ";
		$opcion = trim(fgets(STDIN));
		switch ($opcion) {
			case 1:
				opcionCrearViaje();
				break;
			case 5:
				break;
			default:
				echo "Valor ingresado incorrecto.\nPresione cualquier tecla para contiuar...";
				fgets(STDIN);
		}

		// if ($opcion == 1) {
		// 	$rta = false;

		// 	echo "Ingrese id: ";
		// 	$idViaje = trim(fgets(STDIN));
		// 	echo "Ingrese destino: ";
		// 	$vdestino = trim(fgets(STDIN));
		// 	echo "Ingrese max pasajeros: ";
		// 	$maxpasa = trim(fgets(STDIN));
		// 	echo "Ingrese importe: ";
		// 	$importe = trim(fgets(STDIN));

		// 	//da las coleccion de empresas y busca el id para verificar que exista  y despues lo setea a la funcion cargar
		// 	$objEmpresa = new empresa();
		// 	$colEmpresas = $objEmpresa->listar("");

		// 	foreach ($colEmpresas as $empresas) {

		// 		echo "-------------------------------------------------------";
		// 		echo $empresas;
		// 		echo "-------------------------------------------------------";
		// 	}

		// 	echo "\nIngrese id empresa: ";
		// 	$idempresa = trim(fgets(STDIN));
		// 	$objEmpresa->Buscar($idempresa);

		// 	//da las coleccion de responsables y busca el numero para verificar que exista  y despues lo setea a la funcion cargar
		// 	$objRespo = new responsable();
		// 	$colResponsable = $objRespo->listar();

		// 	foreach ($colResponsable as $responsable) {

		// 		echo "-------------------------------------------------------";
		// 		echo $responsable;
		// 		echo "-------------------------------------------------------";
		// 	}


		// 	echo "\nIngrese nel numero de responsable: ";
		// 	$nror = trim(fgets(STDIN));
		// 	$objRespo->buscar($nror);


		// 	$objViaje = new viaje();
		// 	$colViajes = $objViaje->listar("");

		// 	foreach ($colViajes as $viaje) {
		// 		if ($viaje->getVDestino() == $vdestino) {
		// 			echo "No se puede agregar dos viajes con el mismo destino ";
		// 			$value = false;
		// 		} else {
		// 			$value = true;
		// 		}
		// 	}
		// 	if ($value) {
		// 		$objViaje->cargar($idViaje, $vdestino, $maxpasa, $objRespo, $importe, $objEmpresa);
		// 		$rta = $objViaje->insertar();
		// 	}

		// 	if ($rta == true) {
		// 		echo "\nSE INSERTO EL VIAJE EN LA BD\n";
		// 		$colViajes = $objViaje->listar();
		// 		foreach ($colViajes as $viaje) {

		// 			echo "-------------------------------------------------------";
		// 			echo $viaje;
		// 			echo "-------------------------------------------------------";
		// 		}
		// 	}
		// } else if ($opcion == 2) {
		// 	$objviaje = new viaje();
		// 	$rta = false;

		// 	echo "\nIngrese el id del viaje que desea modificar: ";
		// 	$num = trim(fgets(STDIN));

		// 	if ($objviaje->Buscar($num) == true) {

		// 		echo "Ingrese nuevo destino: ";
		// 		$des = trim(fgets(STDIN));
		// 		echo "Ingrese cant max pasajero: ";
		// 		$max = trim(fgets(STDIN));
		// 		echo "Ingrese nuevo importe : ";
		// 		$importe = trim(fgets(STDIN));

		// 		//da las coleccion de empresas y busca el id para verificar que exista  y despues lo setea a la funcion cargar
		// 		$objEmpresa = new empresa();
		// 		$colEmpresas = $objEmpresa->listar();

		// 		foreach ($colEmpresas as $empresas) {

		// 			echo "-------------------------------------------------------";
		// 			echo $empresas;
		// 			echo "-------------------------------------------------------";
		// 		}

		// 		echo "\nIngrese id de la nueva empresa: ";
		// 		$idempresa = trim(fgets(STDIN));
		// 		$objEmpresa->Buscar($idempresa);

		// 		//da las coleccion de responsables y busca el numero para verificar que exista  y despues lo setea a la funcion cargar
		// 		$objRespo = new responsable();
		// 		$colResponsable = $objRespo->listar();

		// 		foreach ($colResponsable as $responsable) {

		// 			echo "-------------------------------------------------------";
		// 			echo $responsable;
		// 			echo "-------------------------------------------------------";
		// 		}


		// 		echo "\nIngrese nuevo nro responsable: ";
		// 		$nror = trim(fgets(STDIN));
		// 		$objRespo->Buscar($nror);

		// 		$objviaje->setVDestino($des);
		// 		$objviaje->setVcantMaxPasajeros($max);
		// 		$objviaje->setRnumeroempleado($objRespo);
		// 		$objviaje->setVimporte($importe);
		// 		$objviaje->setIdEmpresa($objEmpresa);

		// 		$rta = $objviaje->modificar();
		// 	} else {
		// 		echo "\n -- No se encontro  un viaje con ese id \n";
		// 	}


		// 	if ($rta == true) {
		// 		echo "\n SE MODIFICO EL VIAJE \n";
		// 		$colViajes = $objviaje->listar("");
		// 		foreach ($colViajes as $viaje) {

		// 			echo "-------------------------------------------------------";
		// 			echo $viaje;
		// 			echo "-------------------------------------------------------";
		// 		}
		// 	} else {
		// 		echo $objviaje->getMensajeOperacion();
		// 	}
		// } else if ($opcion == 3) {

		// 	$objviaje = new viaje();
		// 	$rta = false;

		// 	echo "Ingrese id del viaje que desea eliminar : ";
		// 	$id = trim(fgets(STDIN));


		// 	if ($objviaje->Buscar($id)) {

		// 		$objPasaj = new pasajero();
		// 		$colPasajeros = $objPasaj->listar("idviaje=" . $objviaje->getIdViaje());

		// 		if (count($colPasajeros) > 0) {
		// 			echo "\n -- No se puede eliminar este viaje por que tiene pasajeros \n";
		// 		} else {
		// 			$rta = $objviaje->eliminar();
		// 		}
		// 	} else {
		// 		echo "\n--No se encontro un viaje con ese id \n";
		// 	}


		// 	if ($rta == true) {
		// 		echo " \n SE ELIMINO EL VIAJE DE LA BD \n";

		// 		$colViaje = $objviaje->listar();
		// 		foreach ($colViaje as $viaje) {

		// 			echo "-------------------------------------------------------";
		// 			echo $viaje;
		// 			echo "-------------------------------------------------------";
		// 		}
		// 	} else {
		// 		echo $objviaje->getMensajeOperacion();
		// 	}
		// } else if ($opcion == 4) {

		// 	$objViaje = new Viaje();
		// 	$colViajes = $objViaje->listar();

		// 	foreach ($colViajes as $viaje) {

		// 		echo "-------------------------------------------------------";
		// 		echo $viaje;
		// 		echo "-------------------------------------------------------";
		// 	}
		// }
	} while ($opcion != 5);
}

function opcionCrearViaje()
{
	do {
		do {
			limpiarConsola();
			echo "************************* CREAR VIAJE ************************************\n\n";
			$rta = false;
			echo "Empresas";
			verTabla('empresa');

			// // $idempresa = readline("\nIngrese el ID de la empresa: ");
			echo ("\nIngresar ID de la empresa: ");
			$idEmpresa = trim(fgets(STDIN));
			$empresa = new Empresa();

			if ($empresa->buscar($idEmpresa)) {
				$vdestino = readline("Ingresar destino: ");
				do {
					echo "\nResponsables";
					verTabla('responsable');
					// $idResponsable = readline("\nIngresar ID del responsable del viaje");
					echo ("\nIngresar el N° de empleado del responsable del viaje: ");
					$idResponsable = trim(fgets(STDIN));
					$responsable = new Responsable();
					if (!($responsable->buscar($idResponsable))) {
						echo "No existe el responsable\nVuelva a intentarlo";
					} else {
						$rnumeroEmpleado = $responsable->getRnumeroEmpleado();
					}
				} while (!($responsable->buscar($idResponsable)));
				$vcantMaxPasajeros = readline("Ingresar cantidad máxima de pasajeros: ");
				$vimporte = readline("Ingrese costo del viaje");
				$rta = true;
			} else {
				echo "No el ID de la empresa\nVuelva a intentarlo";
			}
		} while (!($empresa->buscar($idEmpresa)));
		if ($rta) {
			$viaje = new Viaje();
			$viaje->cargar($idViaje = "", $vdestino, $vcantMaxPasajeros, $rnumeroEmpleado, $vimporte, $idEmpresa);
			if ($viaje->insertar()) {
				$destino = $viaje->getVdestino();
				echo "\n El viaje a $destino fue " . setColor("creado exitomasamente", "green");
				echo setColor("\n  Presione cualquier tecla para contiuar...", "yellow");
				fgets(STDIN);
			} else {
				echo setColor("Error al cargar", "red");
				echo setColor("Presione cualquier tecla para contiuar...", "yellow");
				fgets(STDIN);
			};
		}
	} while ($rta == false);


	echo "Ingrese id: ";
	$idViaje = trim(fgets(STDIN));
	echo "Ingrese destino: ";
	$vdestino = trim(fgets(STDIN));
	echo "Ingrese max pasajeros: ";
	$maxpasa = trim(fgets(STDIN));
	echo "Ingrese importe: ";
	$importe = trim(fgets(STDIN));

	//da las coleccion de empresas y busca el id para verificar que exista  y despues lo setea a la funcion cargar
	$objEmpresa = new empresa();
	$colEmpresas = $objEmpresa->listar("");

	foreach ($colEmpresas as $empresas) {

		echo "-------------------------------------------------------";
		echo $empresas;
		echo "-------------------------------------------------------";
	}

	echo "\nIngrese id empresa: ";
	$idempresa = trim(fgets(STDIN));
	$objEmpresa->Buscar($idempresa);

	//da las coleccion de responsables y busca el numero para verificar que exista  y despues lo setea a la funcion cargar
	$objRespo = new responsable();
	$colResponsable = $objRespo->listar();

	foreach ($colResponsable as $responsable) {

		echo "-------------------------------------------------------";
		echo $responsable;
		echo "-------------------------------------------------------";
	}


	echo "\nIngrese nel numero de responsable: ";
	$nror = trim(fgets(STDIN));
	$objRespo->buscar($nror);


	$objViaje = new viaje();
	$colViajes = $objViaje->listar("");

	foreach ($colViajes as $viaje) {
		if ($viaje->getVDestino() == $vdestino) {
			echo "No se puede agregar dos viajes con el mismo destino ";
			$value = false;
		} else {
			$value = true;
		}
	}
	if ($value) {
		$objViaje->cargar($idViaje, $vdestino, $maxpasa, $objRespo, $importe, $objEmpresa);
		$rta = $objViaje->insertar();
	}

	if ($rta == true) {
		echo "\nSE INSERTO EL VIAJE EN LA BD\n";
		$colViajes = $objViaje->listar();
		foreach ($colViajes as $viaje) {

			echo "-------------------------------------------------------";
			echo $viaje;
			echo "-------------------------------------------------------";
		}
	}
}

/***************************MENU PASAJERO*****************************/
function menuPasajero()
{

	do {
		echo "************************* MENU PASAJERO ************************************\n\n";
		echo "1) Crear pasajero\n";
		echo "2) Modificar datos pasajero\n";
		echo "3) Eliminar pasajero\n";
		echo "4) Listar pasajero\n";
		echo setColor("5) Volver", "red") . "\n\n ";
		echo "Ingrese una opción: ";
		$opcion = trim(fgets(STDIN));

		switch ($opcion) {
			case 1:
				opcionCrearPasajero();
				break;
			default:
				echo "Valor ingresado incorrecto.\nPresione cualquier tecla para contiuar...";
				fgets(STDIN);
		}

		if ($opcion == 1) {
			$rta = false;

			echo "Ingrese dni pasajero: ";
			$dni = trim(fgets(STDIN));
			echo "Ingrese nombre del pasajero: ";
			$nom = trim(fgets(STDIN));
			echo "Ingrese el apellido del pasajero: ";
			$ape = trim(fgets(STDIN));
			echo "Ingrese el telefono del pasajero: ";
			$tele = trim(fgets(STDIN));
			echo "Ingrese id del viaje: ";
			$idviaje = trim(fgets(STDIN));

			$newPasaj = new pasajero();
			$objviaje = new viaje();
			$objviaje->buscar($idviaje);

			$newPasaj->cargar($dni, $nom, $ape, $tele, $objviaje);
			$rta = $newPasaj->insertar();

			if ($rta == true) {

				echo "\n EL PASAJERO FUE INGRESADA A LA BD \n";
				$colPasajeros = $newPasaj->listar("");

				foreach ($colPasajeros as $pasajero) {
					echo "-------------------------------------------------------";
					echo  $pasajero;
					echo "-------------------------------------------------------";
				}
			} else {
				echo $newPasaj->getMensajeOperacion();
			}
		} else if ($opcion == 2) {
			$objPasaj = new pasajero();
			$rta = false;

			echo "\nIngrese el dni del pasajero que desea modificar: ";
			$num = trim(fgets(STDIN));

			if ($objPasaj->buscar($num) == true) {
				echo "Ingrese nuevo nombre: ";
				$nom = trim(fgets(STDIN));
				echo "Ingrese nuevo apellido: ";
				$ape = trim(fgets(STDIN));
				echo "Ingrese nuevo telefono: ";
				$tele = trim(fgets(STDIN));

				$objPasaj->setPnombre($nom);
				$objPasaj->setPapellido($ape);
				$objPasaj->setPtelefono($tele);

				$rta = $objPasaj->modificar();
			} else {
				echo "\n -- No se encontro  un pasajero con ese dni \n";
			}

			if ($rta == true) {
				echo "\n SE MODIFICO AL PASAJERO \n";
				$colPasajeros = $objPasaj->listar("");
				foreach ($colPasajeros  as $pasajero) {

					echo "-------------------------------------------------------";
					echo $pasajero;
					echo "-------------------------------------------------------";
				}
			} else {
				echo $objPasaj->getMensajeOperacion();
			}
		} else if ($opcion == 3) {

			$objPasaj = new pasajero();
			$rta = false;

			echo "Ingrese dni del pasajero que desea eliminar : ";
			$dni = trim(fgets(STDIN));

			if ($objPasaj->buscar($dni) == true) {
				$rta = $objPasaj->eliminar();
			} else {
				echo "\n -- No se encontro pasajero con ese dni \n";
			}


			if ($rta == true) {
				echo " \n SE ELIMINO EL PASAJERO DE LA BD \n";

				$colPasa = $objPasaj->listar("");
				foreach ($colPasa as $pasajero) {

					echo "-------------------------------------------------------";
					echo $pasajero;
					echo "-------------------------------------------------------";
				}
			} else {
				echo $objPasaj->getMensajeOperacion();
			}
		} else if ($opcion == 4) {

			$objPasajero = new pasajero();
			$colPasajeros = $objPasajero->listar("");

			foreach ($colPasajeros as $pasajero) {

				echo "-------------------------------------------------------";
				echo $pasajero;
				echo "-------------------------------------------------------";
			}
		}
	} while ($opcion <= 4);
}

function opcionCrearPasajero()
{
	$rta = false;
	$dni = readline("Ingrese DNI: ");
	$nom = readline("Ingrese nombre: ");
	$ape = readline("Ingrese apellido: ");
	$tele = readline("Ingrese telefono: ");

	echo "Ingrese dni pasajero: ";
	$dni = trim(fgets(STDIN));
	echo "Ingrese nombre del pasajero: ";
	$nom = trim(fgets(STDIN));
	echo "Ingrese el apellido del pasajero: ";
	$ape = trim(fgets(STDIN));
	echo "Ingrese el telefono del pasajero: ";
	$tele = trim(fgets(STDIN));
	echo "Ingrese id del viaje: ";
	$idviaje = trim(fgets(STDIN));

	$newPasaj = new pasajero();
	$objviaje = new viaje();
	$objviaje->buscar($idviaje);

	$newPasaj->cargar($dni, $nom, $ape, $tele, $objviaje);
	$rta = $newPasaj->insertar();

	if ($rta == true) {

		echo "\n EL PASAJERO FUE INGRESADA A LA BD \n";
		$colPasajeros = $newPasaj->listar("");

		foreach ($colPasajeros as $pasajero) {
			echo "-------------------------------------------------------";
			echo  $pasajero;
			echo "-------------------------------------------------------";
		}
	} else {
		echo $newPasaj->getMensajeOperacion();
	}
}

/***************************MENU RESPONSABLE*****************************/
function menuResponsable()
{

	do {
		limpiarConsola();
		echo "************************* MENU RESPONSABLE ************************************\n\n";
		echo "1) Crear responsable\n";
		echo "2) Modificar datos responsable\n";
		echo "3) Eliminar responsable\n";
		echo "4) Listar responsable\s\n";
		echo setColor("5) Volver", "red") . "\n\n ";
		echo "Ingrese una opción: ";
		$opcion = trim(fgets(STDIN));

		switch ($opcion) {
			case 1:
				opcionCrearResponsable();
				break;
			case 2:
				opcionModificarResponsable();
				break;
			case 3:
				opcionEliminarResponsable();
				break;
			case 4:
				opcionListarResponsable();
				break;
			case 5:
				break;
			default:
				echo "Valor ingresado incorrecto.\nPresione cualquier tecla para contiuar...";
				fgets(STDIN);
		}


		// if ($opcion == 1) {
		// 	$rta = false;

		// 	echo "Ingrese numero responsable: ";
		// 	$num = trim(fgets(STDIN));
		// 	echo "Ingrese numero licencia responsable ";
		// 	$lic = trim(fgets(STDIN));
		// 	echo "Ingrese el nombre del responsable: ";
		// 	$nombre = trim(fgets(STDIN));
		// 	echo "Ingrese el apellido del responsable: ";
		// 	$ape = trim(fgets(STDIN));

		// 	$newResp = new responsable();
		// 	$newResp->cargar($num, $lic, $nombre, $ape);
		// 	$rta = $newResp->insertar();

		// 	if ($rta == true) {
		// 		echo "\n EL RESPONSABLE FUE INGRESADO A LA BD \n";

		// 		$colResponsable = $newResp->listar("");
		// 		foreach ($colResponsable as $unResp) {
		// 			echo "-------------------------------------------------------";
		// 			echo  $unResp;
		// 			echo "-------------------------------------------------------";
		// 		}
		// 	} else {
		// 		echo $newResp->getMensajeOperacion();
		// 	}
		// } else if ($opcion == 2) {
		// 	$objRespo = new responsable();
		// 	$rta = false;

		// 	echo "\nIngrese el numero del responsable que desea modificar: ";
		// 	$num = trim(fgets(STDIN));

		// 	if ($objRespo->buscar($num) == true) {
		// 		echo "Ingrese nuevo numero de licencia: ";
		// 		$lic = trim(fgets(STDIN));
		// 		echo "Ingrese nuevo nombre de responsable: ";
		// 		$nombre = trim(fgets(STDIN));
		// 		echo "Ingrese nueva apellido de responsable: ";
		// 		$ape = trim(fgets(STDIN));

		// 		$objRespo->setRnumerolicencia($lic);
		// 		$objRespo->setRnombre($nombre);
		// 		$objRespo->setRapellido($ape);
		// 		$rta = $objRespo->modificar();
		// 	} else {
		// 		echo "\n -- No se encontro  un responsable con ese id \n";
		// 	}


		// 	if ($rta == true) {
		// 		echo "\nSE MODIFICO EL RESPONSABLE\n";
		// 		$colResponsable = $objRespo->listar("");
		// 		foreach ($colResponsable as $unResp) {

		// 			echo "-------------------------------------------------------";
		// 			echo $unResp;
		// 			echo "-------------------------------------------------------";
		// 		}
		// 	} else {
		// 		echo $objRespo->getMensajeOperacion();
		// 	}
		// } else if ($opcion == 3) {

		// 	$objRespo = new responsable();
		// 	$rta = false;

		// 	echo "Ingrese numero del responsable que desea eliminar : ";
		// 	$num = trim(fgets(STDIN));

		// 	if ($objRespo->buscar($num) == true) {
		// 		$rta = $objRespo->eliminar();
		// 	} else {
		// 		echo "\n -- No se encontro responsable con ese numero \n";
		// 	}


		// 	if ($rta == true) {
		// 		echo " \n SE ELIMINO EL RESPONSABLE DE LA BD \n";

		// 		$colResponsable = $objRespo->listar();
		// 		foreach ($colResponsable as $resp) {

		// 			echo "-------------------------------------------------------";
		// 			echo $resp;
		// 			echo "-------------------------------------------------------";
		// 		}
		// 	} else {
		// 		echo $objRespo->getMensajeOperacion();
		// 	}
		// } else if ($opcion == 4) {

		// 	$objRespo = new responsable();
		// 	$colResponsable = $objRespo->listar("");

		// 	foreach ($colResponsable as $responsable) {

		// 		echo "-------------------------------------------------------";
		// 		echo $responsable;
		// 		echo "-------------------------------------------------------";
		// 	}
		// }
	} while ($opcion <= 4);
}

function opcionCrearResponsable()
{
	$rta = false;
	$rnumerolicencia = readline("Ingrese n° de licencia: ");
	$rnombre = readline("Ingrese nombre: ");
	$rapellido = readline("Ingrese apellido: ");
	$newResponsable = new Responsable();
	$newResponsable->cargar($rnumeroEmpleado = "", $rnumerolicencia, $rnombre, $rapellido);
	if ($newResponsable->insertar()) {
		$nombre = $newResponsable->getRnombre();
		echo "\n El responsable $nombre fue " . setColor("creado exitomasamente", "green");
		echo setColor("Presione cualquier tecla para contiuar...", "yellow");
		fgets(STDIN);
	} else {
		echo setColor("Error al cargar", "red");
		echo setColor("Presione cualquier tecla para contiuar...", "yellow");
		fgets(STDIN);
	};
	// echo "Ingrese numero responsable: ";
	// $num = trim(fgets(STDIN));
	// echo "Ingrese numero licencia responsable ";
	// $lic = trim(fgets(STDIN));
	// echo "Ingrese el nombre del responsable: ";
	// $nombre = trim(fgets(STDIN));
	// echo "Ingrese el apellido del responsable: ";
	// $ape = trim(fgets(STDIN));

	// $newResp = new responsable();
	// $newResp->cargar($num, $lic, $nombre, $ape);
	// $rta = $newResp->insertar();

	// if ($rta == true) {
	// 	echo "\n EL RESPONSABLE FUE INGRESADO A LA BD \n";

	// 	$colResponsable = $newResp->listar("");
	// 	foreach ($colResponsable as $unResp) {
	// 		echo "-------------------------------------------------------";
	// 		echo  $unResp;
	// 		echo "-------------------------------------------------------";
	// 	}
	// } else {
	// 	echo $newResp->getMensajeOperacion();
	// }
}

function opcionModificarResponsable()
{
	do {
		limpiarConsola();
		echo "************************* MODIFICAR DATOS ************************************\n";
		echo "Responsables";
		verTabla('responsable');
		echo "\nOPCIONES\n1) Modificar\n" . setColor("2) Volver", "red") . "\n\nIngrese opcion: ";
		$opc = trim(fgets(STDIN));
		if ($opc == 1) {
			$objResponsable = new Responsable();
			$id = readline("Ingrese ID del responsable que desea modificar: ");
			if ($objResponsable->buscar($id)) {
				do {
					limpiarConsola();
					echo "Responsable$objResponsable\nOPCIONES\n1) Nuevo n° licencia\n2) Nuevo nombre\n3) Nuevo apellido\n" . setColor("4) Volver", "red") . "\n\nIngrese opcion: ";
					$opc = trim(fgets(STDIN));
					switch ($opc) {
						case 1:
							$newNumLicencia = readline("Ingrese nuevo N° Licencia: ");
							$objResponsable->setRnumerolicencia($newNumLicencia);
							if ($objResponsable->modificar()) {
								$numLicencia = $objResponsable->getRnumerolicencia();
								echo setColor("\nN° Licencia aztualizado.", "green") . "\nNuevo N° Licencia: " . setColor($numLicencia, "green") . "\n\n" . setColor("Presione cualquier tecla pra continuar...", "yellow");
								fgets(STDIN);
							} else {
								echo setColor("No se pudo actilzar el N° Licencia.", "red") . "\n" . setColor("Presione cualquier tecla para contiuar...", "yellow");
								fgets(STDIN);
							};
							break;
						case 2:
							$newNombre = readline("Ingrese nuevo nombre: ");
							$objResponsable->setRnombre($newNombre);
							if ($objResponsable->modificar()) {
								$nombre = $objResponsable->getRnombre();
								echo setColor("\nNombre aztualizado.", "green") . "\nNuevo Nombre: " . setColor($nombre, "green") . "\n\n" . setColor("Presione cualquier tecla pra continuar...", "yellow");
								fgets(STDIN);
							} else {
								echo setColor("No se pudo actilzar el nombre.", "red") . "\n" . setColor("Presione cualquier tecla para contiuar...", "yellow");
								fgets(STDIN);
							};
							break;
						case 3:
							$newApellido = readline("Ingrese nuevo apellido: ");
							$objResponsable->setRapellido(($newApellido));
							if ($objResponsable->modificar()) {
								$apellido = $objResponsable->getRapellido();
								echo setColor("\nApellido aztualizado.", "green") . "\nNuevo Apellido: " . setColor($apellido, "green") . "\n\n" . setColor("Presione cualquier tecla pra continuar...", "yellow");
								fgets(STDIN);
							} else {
								echo setColor("No se pudo actilzar el apellido.", "red") . "\n" . setColor("Presione cualquier tecla para contiuar...", "yellow");
								fgets(STDIN);
							};
							break;
						case 4:
							break;
						default:
							echo setColor("Valor ingresado incorrecto.", "red") . "\n" . setColor("Presione cualquier tecla para contiuar...", "yellow");
							fgets(STDIN);
							break;
					}
				} while ($opc != 4);
			}
		}
	} while ($opc != 2);
	// $objRespo = new responsable();
	// $rta = false;

	// echo "\nIngrese el numero del responsable que desea modificar: ";
	// $num = trim(fgets(STDIN));

	// if ($objRespo->buscar($num) == true) {
	// 	echo "Ingrese nuevo numero de licencia: ";
	// 	$lic = trim(fgets(STDIN));
	// 	echo "Ingrese nuevo nombre de responsable: ";
	// 	$nombre = trim(fgets(STDIN));
	// 	echo "Ingrese nueva apellido de responsable: ";
	// 	$ape = trim(fgets(STDIN));

	// 	$objRespo->setRnumerolicencia($lic);
	// 	$objRespo->setRnombre($nombre);
	// 	$objRespo->setRapellido($ape);
	// 	$rta = $objRespo->modificar();
	// } else {
	// 	echo "\n -- No se encontro  un responsable con ese id \n";
	// }


	// if ($rta == true) {
	// 	echo "\nSE MODIFICO EL RESPONSABLE\n";
	// 	$colResponsable = $objRespo->listar("");
	// 	foreach ($colResponsable as $unResp) {

	// 		echo "-------------------------------------------------------";
	// 		echo $unResp;
	// 		echo "-------------------------------------------------------";
	// 	}
	// } else {
	// 	echo $objRespo->getMensajeOperacion();
	// }
}

function opcionEliminarResponsable()
{
	do {
		limpiarConsola();
		echo "************************* ELIMINAR RESPONSABLE ************************************\n";
		echo "Responsables";
		verTabla('responsable');
		echo "\nOPCIONES\n1) Eliminar\n2) Volver\n\nIngrese opcion: ";
		$opc = trim(fgets(STDIN));
		if ($opc == 1) {
			$objResponsable = new Responsable();
			$id = readline("Ingrese el ID del responsable que desea eliminar:");
			if ($objResponsable->buscar($id)) {
				if ($objResponsable->eliminar()) {
					echo "Se elimino la empresa";
					fgets(STDIN);
				} else {
					echo "No se encontro el responsable";
					fgets(STDIN);
				}
			} else {
				echo "\n .. Noe se econtro el responsable con ese ID";
			}
		}
	} while ($opc != 2);
}

function opcionListarResponsable()
{
	do {
		limpiarConsola();
		echo "************************* LISTA RESPONSABLES ************************************\n";
		echo "Responsables";
		verTabla('responsable');
		echo "\nOPCIONES\n1) Volver\n\nIngrese opcion: ";
		$opc = trim(fgets(STDIN));
	} while ($opc != 1);
}

/************************* MENU EMPRESA ************************************/
function menuEmpresa()
{
	do {
		limpiarConsola();
		echo "************************* MENU EMPRESA ************************************\n\n";
		echo "1) Crear empresa\n";
		echo "2) Modificar datos empresa\n";
		echo "3) Eliminar empresa\n";
		echo "4) Listar empresa\n";
		echo setColor("x) Salir", "red") . "\n\n ";
		echo "Ingrese una opción: ";
		$opcion = trim(fgets(STDIN));
		switch ($opcion) {
			case 1:
				opcionCrearEmpresa();
				break;
			case 2:
				opcionModificarEmpresa();
				break;
			case 3:
				opcionEliminarEmpresa();
				break;
			case 4:
				opcionListarEmpresa();
				break;
			default:
				echo "Valor ingresado incorrecto.\nPresione cualquier tecla para contiuar...";
				fgets(STDIN);
		}


		// if ($opcion == 1) {
		// 	limpiarConsola();
		// 	echo "************************* CREAR EMPRESA ************************************\n\n";
		// 	$rta = false;
		// 	// $idempresa = readline('Ingrese el id de la empresa: ');
		// 	$enombre = readline('Ingrese el nombre de la empresa: ');
		// 	$edireccion = readline('Ingrese la dirección de la empresa: ');
		// 	// echo "Ingrese el id de la empresa: ";
		// 	// $idempresa = trim(fgets(STDIN));
		// 	// echo "Ingrese el nombre de la empresa: ";
		// 	// $enombre = trim(fgets(STDIN));
		// 	// echo "Ingrese Direccion: ";
		// 	// $edireccion = trim(fgets(STDIN));
		// 	$newEmpresa = new empresa();
		// 	// $newEmpresa->cargar($idempresa, $enombreangio, $edireccion);
		// 	$newEmpresa->cargar($idempresa = "", $enombre, $edireccion);
		// 	// $rta = ;
		// 	if ($newEmpresa->insertar()) {
		// 		$nombre = $newEmpresa->getEnombre();
		// 		echo "\n La empresa $nombre fue creada\n";
		// 		echo "Presione cualquier tecla para contiuar...";
		// 		fgets(STDIN);
		// 		// echo $newEmpresa;

		// 		// $colEmpresas = $newEmpresa->listar("");
		// 		// foreach ($colEmpresas as $unaEmpresa) {
		// 		// 	echo "-------------------------------------------------------";
		// 		// 	echo  $unaEmpresa;
		// 		// 	echo "-------------------------------------------------------";
		// 		// }
		// 		// } else {
		// 		// 	echo $newEmpresa->getMensajeOperacion();
		// 		// }
		// 	} else {
		// 		echo "No se puede cargar con ese id";
		// 	};
		// } else if ($opcion == 2) {
		// 	//modificar datos de una empresa
		// 	limpiarConsola();
		// 	echo "************************* MODIFICAR DATOS ************************************\n";
		// 	echo "Empresas";
		// 	verTabla();

		// 	$objEmpresa = new empresa();
		// 	$rta = false;
		// 	echo "\n\nIngrese el id de la empresa que desea modificar: ";
		// 	$id = trim(fgets(STDIN));

		// 	if ($objEmpresa->buscar($id) == true) {
		// 		echo "Ingrese nuevo nombre: ";
		// 		$empNombre = trim(fgets(STDIN));
		// 		echo "Ingrese nueva direccion: ";
		// 		$dire = trim(fgets(STDIN));
		// 		$objEmpresa->setEnombre($empNombre);
		// 		$objEmpresa->setEdireccion($dire);
		// 		$rta = $objEmpresa->modificar();
		// 	} else {
		// 		echo "\n -- No se encontro empresa con ese id \n";
		// 	}


		// 	if ($rta == true) {
		// 		$colEmpresas = $objEmpresa->listar("");
		// 		foreach ($colEmpresas as $empresa) {

		// 			echo "-------------------------------------------------------";
		// 			echo $empresa;
		// 			echo "-------------------------------------------------------";
		// 		}
		// 	} else {
		// 		echo $objEmpresa->getMensajeOperacion();
		// 	}

		// } else if ($opcion == 3) {
		// 	$objEmpresa = new empresa();
		// 	$rta = false;

		// 	echo "Ingrese el id de la empresa que desea eliminar : ";
		// 	$id = trim(fgets(STDIN));

		// 	if ($objEmpresa->buscar($id) == true) {
		// 		$rta = $objEmpresa->eliminar();
		// 	} else {
		// 		echo "\n -- No se encontro empresa con ese id \n";
		// 	}


		// 	if ($rta == true) {
		// 		echo " \n SE ELIMINO LA EMPRESA DE LA BD \n";
		// 		$colEmpresas = $objEmpresa->listar("");
		// 		foreach ($colEmpresas as $empresa) {

		// 			echo "-------------------------------------------------------";
		// 			echo $empresa;
		// 			echo "-------------------------------------------------------";
		// 		}
		// 	} else {
		// 		echo $objEmpresa->getMensajeOperacion();
		// 	}
		// } else if ($opcion == 4) {

		// 	$objEmpresa = new empresa();
		// 	$colEmpresas = $objEmpresa->listar("");

		// 	foreach ($colEmpresas as $empresa) {

		// 		echo "-------------------------------------------------------";
		// 		echo $empresa;
		// 		echo "-------------------------------------------------------";
		// 	}
		// }
	} while ($opcion <= 4);
}

function opcionCrearEmpresa()
{
	limpiarConsola();
	echo "************************* CREAR EMPRESA ************************************\n\n";
	$rta = false;
	$enombre = readline('Ingrese el nombre de la empresa: ');
	$edireccion = readline('Ingrese la dirección de la empresa: ');
	$newEmpresa = new Empresa();
	$newEmpresa->cargar($idempresa = "", $enombre, $edireccion);
	if ($newEmpresa->insertar()) {
		$nombre = $newEmpresa->getEnombre();
		echo "\n La empresa $nombre fue creada\n";
		echo "Presione cualquier tecla para contiuar...";
		fgets(STDIN);
	} else {
		echo "No se puede cargar con ese id";
		echo "Presione cualquier tecla para contiuar...";
		fgets(STDIN);
	};
}

function opcionModificarEmpresa()
{
	//modificar datos de una empresa
	do {
		limpiarConsola();
		echo "************************* MODIFICAR DATOS ************************************\n";
		echo "Empresas";
		verTabla('empresa');
		echo "\nOPCIONES\n1) Modificar\n2) Volver\n\nIngrese opcion: ";
		$opc = trim(fgets(STDIN));
		if ($opc == 1) {
			$objEmpresa = new empresa();
			$id = readline("Ingrese el ID de la empresa desea modificar: ");
			if ($objEmpresa->buscar($id) == true) {
				do {
					limpiarConsola();
					echo "Empresa$objEmpresa\nOPCIONES\n1) Nuevo nombre.\n2) Nueva Direccion\n3) Volver\n\nOpcion:";
					$opc = trim(fgets(STDIN));
					switch ($opc) {
						case 1:
							$newNombre = readline('Ingrese nuevo nombre:');
							$objEmpresa->setEnombre($newNombre);
							if ($objEmpresa->modificar()) {
								$nombre = $objEmpresa->getEnombre();
								echo "Nombre actualizado.\nNuevo nombre:$nombre\n\n  Presione cualquier tecla para contiuar...";
								fgets(STDIN);
							} else {
								echo "No se pudo actilzar el nombre.\nPresione cualquier tecla para contiuar...";
								fgets(STDIN);
							};
							break;
						case 2:
							$newDireccion = readline('Ingrese nueva dirección:');
							$objEmpresa->setEdireccion($newDireccion);
							if ($objEmpresa->modificar()) {
								$direccion = $objEmpresa->getEdireccion();
								echo "Dirección actualizada.\nNueva dirección: $direccion\n\n  Presione cualquier tecla para contiuar...";
								fgets(STDIN);
							} else {
								echo "No se pudo actilzar la dirección.\nPresione cualquier tecla para contiuar...";
								fgets(STDIN);
							};
							break;
						case 3:
							break;
						default:
							echo "Valor ingresado incorrecto.\nPresione cualquier tecla para contiuar...";
							fgets(STDIN);
							break;
					}
				} while ($opc != 3);

				// echo "Ingrese nuevo nombre: ";
				// $empNombre = trim(fgets(STDIN));
				// echo "Ingrese nueva direccion: ";
				// $dire = trim(fgets(STDIN));
				// $objEmpresa->setEnombre($empNombre);
				// $objEmpresa->setEdireccion($dire);
				// $rta = $objEmpresa->modificar();
			} else {
				echo "\n -- No se encontro empresa con ese id \n";
			}
		}
	} while ($opc != 2);


	// if ($rta == true) {
	// 	$colEmpresas = $objEmpresa->listar("");
	// 	foreach ($colEmpresas as $empresa) {

	// 		echo "-------------------------------------------------------";
	// 		echo $empresa;
	// 		echo "-------------------------------------------------------";
	// 	}
	// } else {
	// 	echo $objEmpresa->getMensajeOperacion();
	// }
}

function opcionEliminarEmpresa()
{
	do {
		limpiarConsola();
		echo "************************* ELIMINAR EMPRESA ************************************\n";
		echo "Empresas";
		verTabla('empresa');
		echo "\nOPCIONES\n1) Eliminar\n2) Volver\n\nIngrese opcion: ";
		$opc = trim(fgets(STDIN));
		if ($opc == 1) {
			$objEmpresa = new empresa();
			$id = readline("Ingrese el ID de la empresa desea eliminar: ");
			if ($objEmpresa->buscar($id) == true) {
				if ($objEmpresa->eliminar()) {
					echo "Se elimino la empresa";
					fgets(STDIN);
				} else {
					echo "No se econtro la empresa";
					fgets(STDIN);
				}
			}
			// do {
			// 	limpiarConsola();
			// 	echo "Empresa$objEmpresa\nOPCIONES\n1) Nuevo nombre.\n2) Nueva Direccion\n3) Volver\n\nOpcion:";
			// 	$opc = trim(fgets(STDIN));
			// 	switch ($opc) {
			// 		case 1:
			// 			$newNombre = readline('Ingrese nuevo nombre:');
			// 			$objEmpresa->setEnombre($newNombre);
			// 			if ($objEmpresa->modificar()) {
			// 				$nombre = $objEmpresa->getEnombre();
			// 				echo "Nombre actualizado.\nNuevo nombre:$nombre\n\n  Presione cualquier tecla para contiuar...";
			// 				fgets(STDIN);
			// 			} else {
			// 				echo "No se pudo actilzar el nombre.\nPresione cualquier tecla para contiuar...";
			// 				fgets(STDIN);
			// 			};
			// 			break;
			// 		case 2:
			// 			$newDireccion = readline('Ingrese nueva dirección:');
			// 			$objEmpresa->setEdireccion($newDireccion);
			// 			if ($objEmpresa->modificar()) {
			// 				$direccion = $objEmpresa->getDireccion();
			// 				echo "Dirección actualizada.\nNueva dirección: $direccion\n\n  Presione cualquier tecla para contiuar...";
			// 				fgets(STDIN);
			// 			} else {
			// 				echo "No se pudo actilzar la dirección.\nPresione cualquier tecla para contiuar...";
			// 				fgets(STDIN);
			// 			};
			// 			break;
			// 		case 3:
			// 			break;
			// 		default:
			// 			echo "Valor ingresado incorrecto.\nPresione cualquier tecla para contiuar...";
			// 			fgets(STDIN);
			// 			break;
			// 	}
			// } while ($opc != 3);

			// echo "Ingrese nuevo nombre: ";
			// $empNombre = trim(fgets(STDIN));
			// echo "Ingrese nueva direccion: ";
			// $dire = trim(fgets(STDIN));
			// $objEmpresa->setEnombre($empNombre);
			// $objEmpresa->setEdireccion($dire);
			// $rta = $objEmpresa->modificar();
		} else {
			echo "\n -- No se encontro empresa con ese id \n";
		}
	} while ($opc != 2);
}

function opcionListarEmpresa()
{
	do {
		limpiarConsola();
		echo "************************* LISTA EMPRESA ************************************\n";
		echo "Empresas";
		verTabla('empresa');
		echo "\nOPCIONES\n1) Volver\n\nIngrese opcion: ";
		$opc = trim(fgets(STDIN));
	} while ($opc != 1);
}

/**
 * Funcion que recibe un array y la muestra por pantalla.
 * @param Array $array
 */
function listarArray($array)
{
	$texto = "\n-------------------\n";
	foreach ($array as $item) {
		$texto = $texto . $item->__toString() . "\n";
	}
	echo $texto;
}

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
//CONEXION CON LA BASE DE DATOS
$base = new BaseDatos();

//Limpia los datos de la consola para poder mostrar nuevos.
function limpiarConsola()
{
	echo "\033[2J\033[H";
}

//muestra los datos de una tabla de la base de datos.
function verTabla($tabla)
{
	if ($tabla == 'viaje') {
		$tablaViajes = new Viaje();
		$viajes = $tablaViajes->listar("");
		foreach ($viajes as $viaje) {
			echo $viaje;
			echo "----------------------------------------------------------------";
		}
	}

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

	if ($tabla == 'pasajero') {
		$tablaPasajero = new Pasajero();
		$pasajeros = $tablaPasajero->listar("");
		foreach ($pasajeros as $pasajero) {
			echo $pasajero;
			echo "----------------------------------------------------------------\n";
		}
	}
}

/**********************************MENU GENERAL*****************************************/

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
		echo setColor("5) Volver", "red") . "\n\n ";
		echo "Ingrese una opción: ";
		$opcion = trim(fgets(STDIN));
		switch ($opcion) {
			case 1:
				opcionCrearEmpresa();
				break;
			case 2:
				if (existenEmpresas()) {
					opcionModificarEmpresa();
				} else {
					echo "Opcion no disponible. Ingrese una empresa para continuar.\n";
				}
				break;
			case 3:
				if (existenEmpresas()) {
					opcionEliminarEmpresa();
				} else {
					echo "Opcion no disponible. Ingrese una empresa para continuar. \n";
				}
				break;
			case 4:
				opcionListarEmpresa();
				break;
			case 5:
				break;
			default:
				echo "Valor ingresado incorrecto.\nPresione cualquier tecla para contiuar...";
				fgets(STDIN);
		}
	} while ($opcion != 5);
}

function opcionCrearEmpresa()
{
	do {
		limpiarConsola();
		echo "************************* CREAR EMPRESA ************************************\n\n";
		echo "OPCIONES\n1) Crear\n" . setColor("2) Volver\n\n", "purple") . "Elije una opcion: ";
		$opc = fgets(STDIN);
		if ($opc == 1) {
			limpiarConsola();
			echo "************************* CREAR EMPRESA ************************************\n\n";
			$idEmpresa = "";
			$enombre = readline('Ingrese el nombre de la empresa: ');
			$edireccion = readline('Ingrese la dirección de la empresa: ');
			$newEmpresa = new Empresa();
			$newEmpresa->cargar($idEmpresa, $enombre, $edireccion);
			if ($newEmpresa->insertar()) {
				$nombre = $newEmpresa->getEnombre();
				echo "\n La empresa " . setColor($nombre, "cyan") . setColor("  fue creada con exito.\n", "green");
				echo setColor("Presione cualquier tecla para contiuar...", 'yellow');
				fgets(STDIN);
			} else {
				echo setColor("No se puede cargar con ese id","red");
				echo setColor("  Presione cualquier tecla para contiuar...","yellow");
				fgets(STDIN);
			};
		}
		if ($opc != 2) {
			echo setColor("Opcion Incorrecta.", "red") . "\n" . setColor("Presione cualquier tecla para contiuar...", 'yellow');
			fgets(STDIN);
		}
	} while ($opc != 2);
}

/**
 * Funcion que retorna true o false segun si hay empresas cargadas en la bd
 * @return Array
 * */
function existenEmpresas()
{
	$empresa = new Empresa();
	$empresas = $empresa->listar();
	$hayEmpresasCargadas = sizeof($empresas) > 0;
	return $hayEmpresasCargadas;
}

function opcionModificarEmpresa()
{
	//modificar datos de una empresa
	do {
		limpiarConsola();
		echo "************************* MODIFICAR DATOS ************************************\n";
		echo "Empresas";
		verTabla('empresa');
		echo "\nOPCIONES\n1) Modificar\n". setColor("2) Volver\n\n","purple") . "Ingrese opcion: ";
		$opc = trim(fgets(STDIN));
		if ($opc == 1) {
			$objEmpresa = new empresa();
			$id = readline("Ingrese el ID de la empresa desea modificar: ");
			if ($objEmpresa->buscar($id)) {
				do {
					limpiarConsola();
					echo "Empresa $objEmpresa \nOPCIONES\n1) Nuevo nombre.\n2) Nueva Direccion\n".setColor("3) Volver\n\n","purple"). "Opcion: ";
					$opc = trim(fgets(STDIN));
					switch ($opc) {
						case 1:
							$newNombre = readline('Ingrese nuevo nombre: ');
							$objEmpresa->setEnombre($newNombre);
							if ($objEmpresa->modificar()) {
								limpiarConsola();
								$nombre = $objEmpresa->getEnombre();
								echo setColor("Nombre actualizado.\n\n","green"). "Nuevo nombre: ". setColor($nombre,"cyan") . setColor("\n\n  Presione cualquier tecla para contiuar...","yellow");
								fgets(STDIN);
							} else {
								echo setColor("No se pudo actilzar el nombre.\n  ","red"). setColor("Presione cualquier tecla para contiuar...","purple");
								fgets(STDIN);
							};
							break;
						case 2:
							$newDireccion = readline('Ingrese nueva dirección: ');
							$objEmpresa->setEdireccion($newDireccion);
							if ($objEmpresa->modificar()) {
								limpiarConsola();
								$direccion = $objEmpresa->getEdireccion();
								echo setColor("Dirección actualizada.\n\n","green") . "Nueva dirección: ".setColor($direccion,"cyan") . setColor("\n\n  Presione cualquier tecla para contiuar...","yellow");
								fgets(STDIN);
							} else {
								echo setColor("No se pudo actilzar la dirección.\n  ","red"). setColor("Presione cualquier tecla para contiuar...","purple");
								fgets(STDIN);
							};
							break;
						case 3:
							break;
						default:
						echo setColor("Valor ingresado incorrecto.\n  ","red"). setColor("Presione cualquier tecla para contiuar...","purple");
							fgets(STDIN);
							break;
					}
				} while ($opc != 3);
			} else {
				echo setColor("\n -- No se encontro empresa con ese id \n","red");
				fgets(STDIN);
			}
		}
	} while ($opc != 2);
}

/**
 * Funcion que retorna los viajes pertenecientes a la empresa que recibe por parametro
 * @param Empresa $empresa
 * @return Array
 */
function viajesDeEmpresa($empresa)
{
	$viaje = new Viaje();
	$condicion = "idempresa = '{$empresa->getIdEmpresa()}'";
	$viajesDeEmpresa = $viaje->listar($condicion);
	return $viajesDeEmpresa;
}

/**
 * Funcion que recibe un pasajero y lo elimina en la bd
 * @param Pasajero $pasajero
 */
function eliminarPasajero($pasajero)
{
	if ($pasajero->eliminar()) {
		echo "Pasajero eliminado con exito.\n";
	} else {
		echo "Ocurrio un error al eliminar el pasajero.\n";
		echo $pasajero->getMensajeoperacion() . "\n";
	}
}

/**
 * Funcion que recibe un idViaje y retorna la lista de los pasajeros de este viaje
 * @param int $idViaje
 * @return Array
 */
function pasajerosEnViaje($idViaje)
{
	$pasajero = new Pasajero();
	$condicion = 'idviaje = ' . $idViaje;
	$pasajeros = $pasajero->listar($condicion);
	return $pasajeros;
}

/**
 * Funcion que recibe un viaje y elimina todos sus pasajeros
 * @param Viaje $viaje
 */
function eliminarPasajerosEnViaje($viaje)
{
	$pasajeros = pasajerosEnViaje($viaje->getIdviaje());
	foreach ($pasajeros as $pasajero) {
		eliminarPasajero($pasajero);
	}
}

/**
 * Funcion que elimina todos los viajes de una empresa y sus pasajeros.
 * @param Empresa $empresa
 */
function eliminarViajesEnEmpresa($empresa)
{
	$viaje = new Viaje();
	$condicion = 'idempresa = ' . $empresa->getIdEmpresa();
	$viajes = $viaje->listar($condicion);
	foreach ($viajes as $itemViaje) {
		eliminarPasajerosEnViaje($itemViaje); //elimino los pasajeros del viaje.
		if ($itemViaje->eliminar()) { //elimino el viaje.
			echo "Se eliminó el viaje.\n";
		} else {
			echo "No se eliminó el viaje.\n";
			echo $itemViaje->getMensajeOperacion();
		};
	}
}

function opcionEliminarEmpresa()
{
	do {
		limpiarConsola();
		echo "************************* ELIMINAR EMPRESA ************************************\n";
		echo "Empresas";
		verTabla('empresa');
		echo "\nOPCIONES\n1) Eliminar\n".setColor("2) Volver\n\n","purple") . "Ingrese opcion: ";
		$opc = trim(fgets(STDIN));
		if ($opc == 1) {
			$objEmpresa = new empresa();
			if (existenEmpresas()) {
				echo "Ingrese el ID de la empresa a eliminar: ";
				$id = trim(fgets(STDIN));
				if ($objEmpresa->buscar($id)) {
					$viajesDeEmpresa = new Viaje();
					$condicion = 'idempresa = ' . $id;
					$viajesDeEmpresa = $viajesDeEmpresa->listar($condicion);
					if (sizeof($viajesDeEmpresa) > 0) {  //la empresa tiene viajes, los borra o los deja y elimina empresa sola
						echo "La empresa tiene viajes, desea borrar la empresa, todos sus viajes y pasajeros?(si/no): ";
						$eleccion = trim(fgets(STDIN));
						if ($eleccion == 'si') {
							eliminarViajesEnEmpresa($objEmpresa);
							if ($objEmpresa->eliminar()) {
								echo "Se elimino la empresa con exito.\n";
							} else {
								echo "No se pudo eliminar la empresa.\n";
								echo $objEmpresa->getMensajeoperacion();
							}
						}
					} else {  //si la empresa no tiene viajes, se la elimina sin problema
						if ($objEmpresa->eliminar()) {
							echo "Se elimino la empresa con exito.\n";
						} else {
							echo "No se pudo eliminar la empresa.\n";
							echo $objEmpresa->getMensajeoperacion();
						}
					}
				} else {
					echo "No existe empresa con el ID ingresado.\n";
				}
			} else {
				echo "Opcion no disponible. Ingrese una empresa para continuar.\n";
			}
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
/**********************************MENU VIAJE************************************************************/

function menuViaje()
{
	do {
		limpiarConsola();
		$viaje = new Viaje();
		echo "************************* MENU VIAJE ************************************\n\n";
		echo "1) Crear viaje\n";
		echo "2) Modificar datos viaje\n";
		echo "3) Eliminar viaje\n";
		echo "4) Listar viajes\n";
		echo "5) Listar pasajeros de un viaje.\n";
		echo setColor("6) Volver\n\n", "red");
		echo "Ingrese una opción: ";
		$opcionViaje = trim(fgets(STDIN));
		switch ($opcionViaje) {
			case 1:
				if (existenEmpresas() && existenResponsables()) {
					opcionCrearViaje();
				} else {
					echo setColor("Opcion no disponible.", "red") . " Inserte una empresa y/o un responsable para continuar.\n";
					echo setColor("   Presione cualquier tecla para continuar...\n", "yellow");
					fgets(STDIN);
				}
				break;
			case 2:
				if (existenViajes()) {
					opcionModificarViaje();
				} else {
					"Opcion no disponible. Inserte un viaje para continuar.\n";
				}
				break;
			case 3:
				if (existenViajes()) {
					opcionEliminarViaje();
				} else {
					"Opcion no disponible. Inserte un viaje para continuar.\n";
				}
				break;
			case 4:
				$viajes = $viaje->listar();
				if (sizeof($viajes) > 0) {
					opcionListarViajes();
				} else {
					echo "No hay viajes cargados.\n";
				}
				break;
			case 5:
				if (existenViajes()) {
					verTabla('viaje');
					echo "\nIngrese el ID del viaje que desea ver los pasajeros: ";
					$idViaje = trim(fgets(STDIN));

					if ($viaje->buscar($idViaje)) {
						limpiarConsola();
						echo "Pasajeros: \n";
						$pasajeros = pasajerosEnViaje($idViaje);
						if (sizeof($pasajeros) > 0) {
							listarArray($pasajeros);
						} else {
							echo "El viaje no tiene pasajeros.\n";
						}
					} else {
						echo "No se encontro el viaje con el ID solicitado.\n";
					}
				} else {
					echo "Opcion no disponible. Inserte un viaje para continuar.\n";
				}
				fgets(STDIN);
				break;
			default:
				echo "Opción inválida. Por favor, seleccione una opción válida.\n";
				break;
		}
	} while ($opcionViaje != 6);
}

/**
 * Funcion que recibe un idViaje y retorna la lista de los pasajeros de este viaje
 * @param int $idViaje
 * @return Array
 */
function listadoPasajerosEnViaje($idViaje)
{
	$pasajero = new Pasajero();
	$condicion = 'idviaje = ' . $idViaje;
	$pasajeros = $pasajero->listar($condicion);
	return $pasajeros;
}

/**
 * Funcion que retorna un boolean segun si quedan asientos disponibles en el viaje que se recibe por parametro
 * @param int $idViaje
 * @return boolean
 */
function hayLugar($idViaje)
{
	$viaje = new Viaje();
	$viaje->buscar($idViaje);
	return sizeof(listadoPasajerosEnViaje($idViaje)) < $viaje->getVcantMaxPasajeros();
}

/**
 * Funcion que retorna un boolean segun si hay viajes cargados en la bd
 * @return boolean
 */
function existenViajes()
{
	$viaje = new Viaje();
	$viajes = $viaje->listar();
	$hayViajesCargados = sizeof($viajes) > 0;
	return $hayViajesCargados;
}

function opcionCrearViaje()
{
	do {
		do {
			limpiarConsola();
			echo "************************* CREAR VIAJE ************************************\n\n";
			$rta = false;
			echo "Empresas";
			verTabla('empresa'); //muestro empresas al usuario para que ingrese id
			echo ("\nIngresar ID de la empresa: ");
			$idEmpresa = trim(fgets(STDIN));
			$empresa = new Empresa();

			if ($empresa->buscar($idEmpresa)) {
				$vdestino = readline("Ingresar destino: ");
				do {
					echo "\nResponsables\n";
					verTabla('responsable');
					echo ("\nIngresar el N° de empleado del responsable del viaje: ");
					$rnumeroEmpleado = trim(fgets(STDIN));
					$responsable = new Responsable();
					if (!($responsable->buscar($rnumeroEmpleado))) {
						echo setColor("No existe el responsable", "red") . "\nVuelva a intentarlo\n";
					} else {
						$rnumeroEmpleado = $responsable->getRnumeroEmpleado();
					}
				} while (!($responsable->buscar($rnumeroEmpleado)));
				$vcantMaxPasajeros = readline("Ingresar cantidad máxima de pasajeros: ");
				$vimporte = readline("Ingrese costo del viaje: ");
				$rta = true;
			} else {
				echo "No el ID de la empresa\nVuelva a intentarlo";
			}
		} while (!($empresa->buscar($idEmpresa)));
		if ($rta) {
			$viaje = new Viaje();
			$vcolPasajeros = [];
			$idViaje = "";
			$viaje->cargar($idViaje, $vdestino, $vcantMaxPasajeros, $rnumeroEmpleado, $vcolPasajeros, $vimporte, $idEmpresa);
			if ($viaje->insertar()) {
				$destino = $viaje->getVdestino();
				echo "\n El viaje a " . setColor($destino, "light_cyan") . " " . setColor("creado exitomasamente", "green");
				echo setColor("\n  Presione cualquier tecla para contiuar...", "yellow");
				fgets(STDIN);
			} else {
				echo setColor("Error al cargar", "red");
				echo setColor("Presione cualquier tecla para contiuar...", "yellow");
				fgets(STDIN);
			};
		}
	} while ($rta == false);
}

function opcionModificarViaje()
{
	do {
		limpiarConsola();
		echo "************************* MODIFICAR DATOS ************************************\n";
		echo "Viaje";
		verTabla('viaje');
		echo "\nOPCIONES\n1) Modificar\n" .
			setColor("2) Volver", "red") .
			"\n\nIngrese opcion: ";
		$opc = trim(fgets(STDIN));
		if ($opc == 1) {
			echo "Ingrese el ID del Viaje\n";
			$idViaje = trim(fgets(STDIN));
			$objViaje = new Viaje();
			if ($objViaje->buscar($idViaje)) { //si el viaje existe, solicito los datos para modificarlo

				do {
					echo "Ingrese el ID de la nueva Empresa:\n";
					$idEmpresa = trim(fgets(STDIN));
					$respuesta = 's';
					$valor = false;
					$objEmpresa = new Empresa();
					if ($objEmpresa->buscar($idEmpresa)) {
						$valor = true;
						$objViaje->setIdEmpresa($objEmpresa->getIdEmpresa());
					} else {
						echo "No se encontro una Empresa con el ID ingresado\n ¿Desea volver a intentarlo? S/N\n";
						$respuesta = trim(fgets(STDIN));
					}
				} while (
					!$valor && ($respuesta == 'S' || $respuesta == 's')
				);
				if ($valor) {
					do {
						echo "Ingrese el numero de empleado del nuevo responsable:\n";
						$objResponsable = new Responsable();
						$rnumeroEmpleado = trim(fgets(STDIN));
						$respuesta = 's';
						$valor = false;
						if ($objResponsable->buscar($rnumeroEmpleado)) {
							$valor = true;
							$objViaje->setRnumeroempleado($objResponsable);
						} else {
							echo "No se encontro un responsable con el ID ingresado\n ¿Desea volver a intentarlo? S/N\n";
							$respuesta = trim(fgets(STDIN));
						}
					} while (
						!$valor &&
						($respuesta == 'S' || $respuesta == 's')
					);
				}
				if ($valor) {
					echo "Ingrese el nuevo importe: \n";
					$objViaje->setVimporte(trim(fgets(STDIN)));

					echo "Ingrese el nuevo destino del viaje: \n";
					$objViaje->setVdestino(trim(fgets(STDIN)));

					echo "Ingrese la nueva cantidad maxima de pasajeros: \n";
					$objViaje->setVcantmaxpasajeros(
						trim(fgets(STDIN))
					);

					// Ejecutar la modificación en la base de datos
					$respuesta = $objViaje->modificar();
					if ($respuesta) {
						echo "Viaje modificado exitosamente.\n";
						echo $objViaje . "\n"; // Muestra los datos actualizados de la empresa
					} else {
						echo 'Error al modificar el viaje: ' .
							$objViaje->getMensajeOperacion() . "\n";
					}
				}
			} else {
				echo 'No se encontro ningun viaje con ID: ' . $idViaje . "\n";
			}
		}
	} while ($opc != 2);
}

// function cargarColeccionPasajeros($viaje,$id)
// {

// 	if ($viaje->buscar($id)) {
// 		$condicion = 'idviaje = ' . $viaje->getIdViaje();
// 		$pasajeros = new Pasajero();
// 		$pasajeros->listar($condicion);
// 		$viaje->setVcolPasajeros($pasajeros);
// 	}
// 	return;
// }
function eliminarViaje($viaje)
{
	if ($viaje->eliminar()) {
		echo "Se eliminó el viaje.\n";
	} else {
		echo "No se eliminó el viaje.\n";
		echo $viaje->getMensajeOp();
	};
}


function opcionEliminarViaje()
{
	if (existenViajes()) {
		limpiarConsola();
		verTabla('viaje');
		echo "\nIngrese el ID del viaje a eliminar: ";
		$viaje = new Viaje();
		$idViaje = trim(fgets(STDIN));
		if ($viaje->buscar($idViaje)) {
			if (sizeOf(listadoPasajerosEnViaje($idViaje)) > 0) { //Verifico que el viaje tenga pasajeros y doy la opcion
				echo "El viaje contiene pasajeros, desea eliminarlo igual?(si/no): ";
				$eleccion = trim(fgets(STDIN));
				if ($eleccion == 'si') {
					eliminarPasajerosEnViaje($viaje);
					eliminarViaje($viaje);
				} elseif ($eleccion != 'si' && $eleccion != 'no') {
					echo "Opcion incorrecta.";
				}
			} else {   //si no tiene pasajeros, lo elimino.
				if ($viaje->eliminar()) {
					echo "Se eliminó el viaje.\n";
				} else {
					echo "No se eliminó el viaje.\n";
					echo $viaje->getMensajeOperacion();
				};
			}
		} else {
			echo "No se encontro el viaje con el ID solicitado.\n";
		}
	} else {
		echo "Opcion no disponible. Inserte un viaje para continuar.\n"; //ningun viaje en la bd, primero insertar uno
	}
}

function opcionListarViajes()
{
	do {
		limpiarConsola();
		echo "************************* LISTA VIAJES ************************************\n";
		echo "Viajes";
		$viaje = new Viaje();
		$viajes = $viaje->listar();
		if (sizeof($viajes) > 0) { //me fijo si hay viajes cargados para listar.
			verTabla('viaje');
			echo "\nOPCIONES\n1) Volver\n\nIngrese opcion: ";
			$opc = trim(fgets(STDIN));
		} else {
			echo "No hay viajes cargados.\n";
		}
	} while ($opc != 1);
}


/***************************MENU PASAJERO*****************************/
function menuPasajero()
{
	do {
		limpiarConsola();
		$pasajero = new Pasajero();
		echo "************************* MENU PASAJERO ************************************\n\n";
		echo "1) Crear pasajero\n";
		echo "2) Modificar datos pasajero\n";
		echo "3) Eliminar pasajero\n";
		echo "4) Listar pasajero\s\n";
		echo setColor("5) Volver", "red") . "\n\n ";
		echo "Ingrese una opción: ";
		$opcion = trim(fgets(STDIN));

		switch ($opcion) {
			case 1:
				if (existenViajes()) {
					opcionCrearPasajero();
				} else {
					echo setColor("Opcion no disponible. Inserte un viaje para continuar.\n", "red");
					echo setColor("   Presione cualquier tecla para continuar...\n", "yellow");
				}
				fgets(STDIN);
				break;
			case 2:
				limpiarConsola();
				echo "Pasajeros \n";
				verTabla('pasajero');
				echo "Ingrese el documento del pasajero a modificar: ";
				$pdocumento = trim(fgets(STDIN));
				if ($pasajero->buscar($pdocumento)) {
					opcionesModificarPasajero($pdocumento);
				} else {
					echo setColor("No se encontro el pasajero con el documento solicitado.\n", "red");
				}
				fgets(STDIN);
				break;
			case 3:
				opcionEliminarPasajero();
				break;
			case 4:
				opcionListarPasajero();
				break;
			case 5:
				break;
			default:
				echo "Valor ingresado incorrecto.\nPresione cualquier tecla para contiuar...";
				fgets(STDIN);
		}
	} while ($opcion <= 4);
}

/**
 * Funcion que pide los datos para insertar un pasajero y verifica que sean datos validos (el viaje solicitado existe, el documento no se repite)
 */
function opcionCrearPasajero()
{
	limpiarConsola();
	$pasajero = new Pasajero();
	echo "************************* CREAR PASAJERO ************************************\n\n";
	echo "Ingrese los datos del pasajero: \n";
	do {
		echo "Documento: ";
		$pdocumento = trim(fgets(STDIN));
		$existe = $pasajero->buscar($pdocumento);
		if ($existe) {
			echo setColor("El Documento ingresado ya existe.\n", "red"); //verifico que el dni ingresado no este en la bd
		}
	} while ($existe);
	echo "Nombre: ";
	$nombre = trim(fgets(STDIN));
	echo "Apellido: ";
	$apellido = trim(fgets(STDIN));
	echo "Telefono: ";
	$telefono = trim(fgets(STDIN));
	verTabla('viaje');
	do {
		echo "\nID del viaje: ";
		$idViaje = trim(fgets(STDIN));
		$viaje = new Viaje();
		$existe = $viaje->Buscar($idViaje);
		if (!$existe) {
			echo setColor("El ID de viaje ingresado no existe.\n", "red");
		} else {
			$pasajerosEnViaje = listadoPasajerosEnViaje($idViaje);
			$cantMax = $viaje->getVcantmaxpasajeros();
			if (sizeof($pasajerosEnViaje) >= $cantMax) {
				echo setColor("El viaje esta lleno. Elija otro.\n", "red");
				$existe = false;
			}
		}
	} while (!$existe);
	$pasajero->cargar($nombre, $apellido, $pdocumento, $telefono, $viaje);
	if ($pasajero->insertar()) {
		echo "Se inserto el pasajero.\n";
	} else {
		echo "No se inserto el pasajero.\n";
		echo $pasajero->getMensajeoperacion() . "\n";
	}
	fgets(STDIN);
}

/**
 * Funcion que recibe un pasajero y lo modifica en la bd
 * @param Pasajero $pasajero
 */
function modificarPasajero($pasajero)
{
	if ($pasajero->modificar()) {
		echo "Se realizo la modificacion\n";
	} else {
		echo "Ocurrio un error.\n";
		echo $pasajero->getMensajeoperacion();
	}
}
/**
 * Funcion que recibe un dni de un pasajero y muestra las opciones para modificarlo
 * @return int $documento
 */
function opcionesModificarPasajero($documento)
{
	$pasajero = new Pasajero();
	do {
		$pasajero->buscar($documento);
		limpiarConsola();
		echo "------------------MODIFICACIONES PASAJERO-------------------- \n1) Nombre.\n2) Apellido.\n3) Telefono.\n4) Viaje. \n5) Volver.\nOpcion: ";
		$opcion = trim(fgets(STDIN));
		switch ($opcion) {
			case 1:
				echo "Ingrese nuevo nombre: ";
				$nuevoNombre = trim(fgets(STDIN));
				$pasajero->setPnombre($nuevoNombre);
				modificarPasajero($pasajero);
				break;
			case 2:
				echo "Ingrese nuevo apellido: ";
				$nuevoApellido = trim(fgets(STDIN));
				$pasajero->setPapellido($nuevoApellido);
				modificarPasajero($pasajero);
				break;
			case 3:
				echo "Ingrese nuevo telefono: ";
				$nuevoTelefono = trim(fgets(STDIN));
				$pasajero->setPtelefono($nuevoTelefono);
				modificarPasajero($pasajero);
				break;
			case 4:
				echo "Ingrese nuevo ID viaje: ";
				$nuevoID = trim(fgets(STDIN));
				$viaje = new Viaje();
				if ($viaje->buscar($nuevoID)) {
					if (hayLugar($nuevoID)) {   //Si no hay lugar en el viaje, no deja agregar un pasajero nuevo
						$pasajero->setIdviaje($viaje);
						modificarPasajero($pasajero);
					} else {
						echo "No hay lugar disponible en el viaje solicitado.\n";
					}
				} else {
					echo "No existe el viaje con el ID ingresado.\n";
				}
				break;
			case 5:
				break;
			default:
				echo "Opcion incorrecta.\n";
		}
	} while ($opcion != 5);
}

function opcionEliminarPasajero()
{
	do {
		limpiarConsola();
		echo "************************* ELIMINAR PASAJERO ************************************\n";
		echo "Pasajeros";
		verTabla('pasajero');
		echo "\nOPCIONES\n1) Eliminar\n2) Volver\n\nIngrese opcion: ";
		$opc = trim(fgets(STDIN));
		if ($opc == 1) {
			$objPasajero = new Pasajero();
			$idpasajero = readline("Ingrese el ID del pasajero que desea eliminar:");
			if ($objPasajero->buscar($idpasajero)) {
				if ($objPasajero->eliminar()) {
					echo setColor("Se elimino el pasajero", "green");
					fgets(STDIN);
				} else {
					echo setColor("Error.", "red");
					fgets(STDIN);
				}
			} else {
				echo setColor("\n .. No se encontro pasajero con ese DNI.", "red");
				fgets(STDIN);
			}
		}
	} while ($opc != 2);
}

function opcionListarPasajero()
{
	do {
		limpiarConsola();
		echo "************************* LISTA PASAJEROS ************************************\n";
		echo "Pasajeros";
		verTabla('pasajero');
		echo "\nOPCIONES\n1) Volver\n\nIngrese opcion: ";
		$opc = trim(fgets(STDIN));

		//$pasajeros = $pasajero->listar();
		//listarArray($pasajeros);

	} while ($opc != 1);
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
				if (existenResponsables()) {  //verifico que exista al menos 1 responsable para modificar
					opcionModificarResponsable();
				} else {
					echo "Opcion no disponible. Inserte un responsable para continuar.\n"; //si no primero tiene que ingresar uno
				}
				break;
			case 3:
				opcionEliminarResponsable();
				break;
			case 4:
				if (existenResponsables()) {
					opcionListarResponsable();
				} else {
					echo "No hay responsables cargados.\n";
				}
				break;
			case 5:
				break;
			default:
				echo "Valor ingresado incorrecto.\nPresione cualquier tecla para contiuar...";
				fgets(STDIN);
		}
	} while ($opcion <= 4);
}

/**
 * Funcion que retorna un boolean segun si hay responsables cargados o no
 * @return boolean
 */
function existenResponsables()
{
	$responsable = new Responsable();
	$responsables = $responsable->listar();
	$hayResponsablesCargados = sizeof($responsables) > 0;
	return $hayResponsablesCargados;
}

function opcionCrearResponsable()
{
	// $rnumeroEmpleado = readline("Ingrese n de empleado: ");
	$rnumerolicencia = readline("Ingrese n° de licencia: ");
	$rnombre = readline("Ingrese nombre: ");
	$rapellido = readline("Ingrese apellido: ");
	$newResponsable = new Responsable();
	$newResponsable->cargar($rnumeroEmpleado = "", $rnumerolicencia, $rnombre, $rapellido);
	if ($newResponsable->insertar()) {
		$nombre = $newResponsable->getPnombre();
		echo "\n El responsable $nombre fue " . setColor("creado exitomasamente", "green");
		echo setColor("Presione cualquier tecla para contiuar...", "yellow");
		fgets(STDIN);
	} else {
		echo setColor("Error al cargar", "red");
		echo setColor("Presione cualquier tecla para contiuar...", "yellow");
		fgets(STDIN);
	};
}

function opcionModificarResponsable()
{
	do {
		limpiarConsola();
		echo "************************* MODIFICAR DATOS ************************************\n";
		echo "Responsables";
		verTabla('responsable');  //mostramos los responsables para que pueda elegir cual modificar.
		echo "\nOPCIONES\n1) Modificar\n" . setColor("2) Volver", "red") . "\n\nIngrese opcion: ";
		$opc = trim(fgets(STDIN));
		if ($opc == 1) {
			$objResponsable = new Responsable();
			$id = readline("Ingrese ID del responsable que desea modificar: ");
			if ($objResponsable->buscar($id)) {
				do {
					limpiarConsola();
					echo "Responsable $objResponsable \n
					OPCIONES\n
					1) Nuevo n° licencia\n
					2) Nuevo nombre\n
					3) Nuevo apellido\n" .
						setColor("4) Volver", "red") .
						"\n\nIngrese opcion: ";
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
			echo "Ingrese el Num. Empleado del responsable a eliminar: ";
			$numEmpleado = trim(fgets(STDIN));
			if ($objResponsable->buscar($numEmpleado)) {
				$viaje = new Viaje(); //verifico que el responsable no tenga viaje asignado para poder eliminarlo.
				$condicion = 'rnumeroempleado = ' . $numEmpleado;
				$viajesDeResponsable = $viaje->listar($condicion);
				if (sizeOf($viajesDeResponsable) == 0) {
					if ($objResponsable->eliminar()) {
						echo "Responsable eliminado con exito.\n";
					} else {
						echo "No se pudo eliminar el responsable.\n";
						echo $objResponsable->getMensajeoperacion();
					}
				} else {
					echo "No se puede eliminar un responsable a cargo de viajes.\n";
				}
			} else {
				echo "No existe el Num. Empleado solicitado.\n";
			}
		} else {
			echo "Opcion no disponible. Inserte un responsable para continuar.\n";
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

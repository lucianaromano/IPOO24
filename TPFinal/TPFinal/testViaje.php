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


$base = new BaseDatos();

/**********************************MENU GENERAL*****************************************/
do {

    echo "---------------------------OPCIONES GENERALES----------------------------
        1) Acceder a tabla Empresas.
        2) Acceder a tabla Viajes.
        3) Acceder a tabla Pasajeros.
        4) Acceder a tabla Responsables.
        0) Salir.
        Opcion: ";
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

/**********************************MENU VIAJE************************************************************/

function menuViaje(){
	
	do {
		echo "\nMENU VIAJE: \n";  
		echo "(1)Ingresar viaje\n";
		echo "(2)Modificar datos viaje\n";
		echo "(3)Eliminar viaje\n";
		echo "(4)Listar viajes\n ";
		echo "(x)salir\n ";
		echo "INGRESE UNA OPCION: ";
		$opcion= trim(fgets(STDIN));
	
			if ($opcion == 1) {
				$rta = false;

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

					foreach ($colEmpresas as $empresas){
						
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

					foreach ($colResponsable as $responsable){
						
						echo "-------------------------------------------------------";
						echo $responsable;
						echo "-------------------------------------------------------";
					}
					 
				
				echo "\nIngrese nel numero de responsable: ";
				$nror = trim(fgets(STDIN));
				$objRespo->buscar($nror);
			

				$objViaje = new viaje(); 
				$colViajes = $objViaje ->listar("");

				foreach ($colViajes as $viaje) {
					if($viaje->getVDestino() == $vdestino){
						echo "No se puede agregar dos viajes con el mismo destino ";
						$value = false;
					}
					else{
						$value = true;
					}
				} if ($value) {	
					$objViaje->cargar($idViaje,$vdestino,$maxpasa,$objRespo,$importe,$objEmpresa);
					$rta = $objViaje->insertar();		
				}
				
				if ($rta == true) {
					echo "\nSE INSERTO EL VIAJE EN LA BD\n";
					$colViajes = $objViaje->listar();
					foreach ($colViajes as $viaje){
										
						echo "-------------------------------------------------------";
						echo $viaje;
						echo "-------------------------------------------------------";
					}
				}
				
			}
			else if($opcion == 2){
				$objviaje= new viaje();
				$rta = false;

				echo "\nIngrese el id del viaje que desea modificar: ";
				$num = trim(fgets(STDIN));

						if ($objviaje->Buscar($num) == true) {
							
							echo "Ingrese nuevo destino: ";
							$des = trim(fgets(STDIN));
							echo "Ingrese cant max pasajero: ";
							$max = trim(fgets(STDIN));
							echo "Ingrese nuevo importe : ";
							$importe = trim(fgets(STDIN));

							//da las coleccion de empresas y busca el id para verificar que exista  y despues lo setea a la funcion cargar
							$objEmpresa = new empresa();
							$colEmpresas = $objEmpresa->listar();	

								foreach ($colEmpresas as $empresas){
									
									echo "-------------------------------------------------------";
									echo $empresas;
									echo "-------------------------------------------------------";
								}
								
							echo "\nIngrese id de la nueva empresa: ";
							$idempresa = trim(fgets(STDIN));
							$objEmpresa->Buscar($idempresa);

							//da las coleccion de responsables y busca el numero para verificar que exista  y despues lo setea a la funcion cargar
							$objRespo = new responsable();
							$colResponsable = $objRespo->listar();	

								foreach ($colResponsable as $responsable){
									
									echo "-------------------------------------------------------";
									echo $responsable;
									echo "-------------------------------------------------------";
								}
								
							
							echo "\nIngrese nuevo nro responsable: ";
							$nror = trim(fgets(STDIN));
							$objRespo->Buscar($nror);
			
							$objviaje->setVDestino($des);
							$objviaje->setVcantMaxPasajeros($max);
							$objviaje->setRnumeroempleado($objRespo);
							$objviaje->setVimporte($importe);
							$objviaje->setIdEmpresa($objEmpresa);
						
							$rta = $objviaje->modificar();	
						
						}
						else{
							echo "\n -- No se encontro  un viaje con ese id \n";
						}
					
								   
				if($rta == true){
					echo "\n SE MODIFICO EL VIAJE \n";
					$colViajes = $objviaje->listar("");
					foreach ($colViajes as $viaje){
						
						echo "-------------------------------------------------------";
						echo $viaje;
						echo "-------------------------------------------------------";
					}	
				}
				else{
					echo $objviaje->getMensajeOperacion();
				   }
				
			}
			else if($opcion == 3){
				
				$objviaje = new viaje();
				$rta = false;

				echo "Ingrese id del viaje que desea eliminar : ";
				$id = trim(fgets(STDIN));
				 

				if ($objviaje ->Buscar($id)){
				
					$objPasaj = new pasajero();
					$colPasajeros = $objPasaj->listar("idviaje=".$objviaje->getIdViaje());

					if ( count($colPasajeros) > 0 ) {
						echo "\n -- No se puede eliminar este viaje por que tiene pasajeros \n";
						
					}	
					else{
						$rta = $objviaje->eliminar();
					}								
					
				}
				else{
					echo "\n--No se encontro un viaje con ese id \n";
				}
				
				
				if ($rta == true) {
					echo " \n SE ELIMINO EL VIAJE DE LA BD \n";

					$colViaje = $objviaje->listar();	
					foreach ($colViaje as $viaje){
						
						echo "-------------------------------------------------------";
						echo $viaje;
						echo "-------------------------------------------------------";
					}
			   }
			   else{
				echo $objviaje->getMensajeOperacion();
			   }
			}
			else if($opcion == 4){
				
				$objViaje = new Viaje();
				$colViajes = $objViaje->listar();	

					foreach ($colViajes as $viaje){
						
						echo "-------------------------------------------------------";
						echo $viaje;
						echo "-------------------------------------------------------";
					}
			}

	}while ($opcion <= 3); 
}

/***************************MENU PASAJERO*****************************/
function menuPasajero(){
	
	do {
		echo "\nMENU PASAJERO: \n";  
		echo "(1)Ingresar pasajero\n";
		echo "(2)Modificar datos pasajero\n";
		echo "(3)Eliminar pasajero\n";
		echo "(4)Listar pasajero\n";
		echo "(x)salir\n ";
		echo "INGRESE UNA OPCION: ";
		$opcion= trim(fgets(STDIN));
	
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

				$newPasaj->cargar($dni,$nom,$ape,$tele,$objviaje);
				$rta = $newPasaj->insertar();	
				
				if ($rta == true) {
				
					echo "\n EL PASAJERO FUE INGRESADA A LA BD \n";					
					$colPasajeros = $newPasaj->listar("");

					foreach ($colPasajeros as $pasajero){
						echo "-------------------------------------------------------";
						echo  $pasajero;
						echo "-------------------------------------------------------";
					} 
				}
				else{
					echo $newPasaj->getMensajeOperacion();
				}
				
	
			}
			else if($opcion == 2){
				$objPasaj= new pasajero();
				$rta = false;

				echo "\nIngrese el dni del pasajero que desea modificar: ";
				$num = trim(fgets(STDIN));

						if ($objPasaj->buscar($num) == true) {
							echo "Ingrese nuevo nombre: ";
							$nom = trim(fgets(STDIN));
							echo "Ingrese nuevo apellido: ";
							$ape = trim(fgets(STDIN));
							echo "Ingrese nuevo telefono: ";
							$tele= trim(fgets(STDIN));
							
							$objPasaj->setPnombre($nom);
							$objPasaj->setPapellido($ape);
							$objPasaj->setPtelefono($tele);
							
							$rta = $objPasaj->modificar();	
						}
						else{
							echo "\n -- No se encontro  un pasajero con ese dni \n";
						}
								   
				if($rta == true){
					echo "\n SE MODIFICO AL PASAJERO \n";
					$colPasajeros = $objPasaj->listar("");
					foreach ($colPasajeros  as $pasajero){
						
						echo "-------------------------------------------------------";
						echo $pasajero;
						echo "-------------------------------------------------------";
					}	
				}
				else{
					echo $objPasaj->getMensajeOperacion();
				   }
				
			}
			else if($opcion == 3){
				
				$objPasaj = new pasajero();
				$rta = false;

				echo "Ingrese dni del pasajero que desea eliminar : ";
				$dni = trim(fgets(STDIN));
					
					if ($objPasaj->buscar($dni) == true) {
						$rta = $objPasaj->eliminar();
					}
					else{
						echo "\n -- No se encontro pasajero con ese dni \n";
					}
				
				
				if ($rta == true) {
					echo " \n SE ELIMINO EL PASAJERO DE LA BD \n";

					$colPasa = $objPasaj->listar("");	
					foreach ($colPasa as $pasajero){
						
						echo "-------------------------------------------------------";
						echo $pasajero;
						echo "-------------------------------------------------------";
					}
			   }
			   else{
				echo $objPasaj->getMensajeOperacion();
			   }
			}
			else if($opcion == 4){
				
				$objPasajero = new pasajero();
				$colPasajeros = $objPasajero->listar("");	

					foreach ($colPasajeros as $pasajero){
						
						echo "-------------------------------------------------------";
						echo $pasajero;
						echo "-------------------------------------------------------";
					}
			
			}

	}while ($opcion <= 4); 
}

/***************************MENU RESPONSABLE*****************************/
function menuResponsable(){
	
	do {
		echo "\nMENU RESPONSABLE: \n";  
		echo "(1)Ingresar responsable\n";
		echo "(2)Modificar datos responsable\n";
		echo "(3)Eliminar responsable\n";
		echo "(4)Listar responsable\s\n";
		echo "(x)salir\n ";
		echo "INGRESE UNA OPCION: ";
		$opcion= trim(fgets(STDIN));
	
			if ($opcion == 1) {
				$rta = false;

				echo "Ingrese numero responsable: ";
				$num= trim(fgets(STDIN));	
				echo "Ingrese numero licencia responsable ";
				$lic= trim(fgets(STDIN));	
				echo "Ingrese el nombre del responsable: ";
				$nombre= trim(fgets(STDIN));	
				echo "Ingrese el apellido del responsable: ";
				$ape = trim(fgets(STDIN));
				
				$newResp = new responsable();
				$newResp->cargar($num,$lic,$nombre,$ape);
				$rta = $newResp->insertar();	
				
				if ($rta == true) {
					echo "\n EL RESPONSABLE FUE INGRESADO A LA BD \n";
					
					$colResponsable = $newResp->listar("");
					foreach ($colResponsable as $unResp){
						echo "-------------------------------------------------------";
						echo  $unResp;
						echo "-------------------------------------------------------";
					} 
				}
				else{
					echo $newResp->getMensajeOperacion();
				}
				
	
			}
			else if($opcion == 2){
				$objRespo = new responsable();
				$rta = false;

				echo "\nIngrese el numero del responsable que desea modificar: ";
				$num = trim(fgets(STDIN));

						if ($objRespo->buscar($num) == true) {
							echo "Ingrese nuevo numero de licencia: ";
							$lic = trim(fgets(STDIN));
							echo "Ingrese nuevo nombre de responsable: ";
							$nombre = trim(fgets(STDIN));
							echo "Ingrese nueva apellido de responsable: ";
							$ape = trim(fgets(STDIN));

							$objRespo->setRnumerolicencia($lic);
							$objRespo->setRnombre($nombre);
							$objRespo->setRapellido($ape);
							$rta = $objRespo->modificar();	
							
						}
						else{
							echo "\n -- No se encontro  un responsable con ese id \n";
						}
					
								   
				if($rta == true){
					echo "\nSE MODIFICO EL RESPONSABLE\n";
					$colResponsable = $objRespo->listar("");
					foreach ($colResponsable as $unResp){
						
						echo "-------------------------------------------------------";
						echo $unResp;
						echo "-------------------------------------------------------";
					}	
				}
				else{
					echo $objRespo->getMensajeOperacion();
				   }
				
			}
			else if($opcion == 3){
				
				$objRespo = new responsable();
				$rta = false;

				echo "Ingrese numero del responsable que desea eliminar : ";
				$num = trim(fgets(STDIN));
					
					if ($objRespo->buscar($num) == true) {
						$rta = $objRespo->eliminar();
					}
					else{
						echo "\n -- No se encontro responsable con ese numero \n";
					}
				
				
				if ($rta == true) {
					echo " \n SE ELIMINO EL RESPONSABLE DE LA BD \n";

					$colResponsable = $objRespo->listar();	
					foreach ($colResponsable as $resp){
						
						echo "-------------------------------------------------------";
						echo $resp;
						echo "-------------------------------------------------------";
					}
			   }
			   else{
				echo $objRespo->getMensajeOperacion();
			   }
			}
			else if($opcion == 4){
				
				$objRespo = new responsable();
				$colResponsable = $objRespo->listar("");	

					foreach ($colResponsable as $responsable){
						
						echo "-------------------------------------------------------";
						echo $responsable;
						echo "-------------------------------------------------------";
					}
			
			}

	}while ($opcion <= 4); 
}
/************************* MENU EMPRESA ************************************/
function menuEmpresa(){
	
	do {
		echo "\nMENU EMPRESA: \n";  
		echo "(1)Ingresar empresa\n";
		echo "(2)Modificar datos empresa\n";
		echo "(3)Eliminar empresa\n";
		echo "(4)Listar empresa\n";
		echo "(x)salir\n ";
		echo "INGRESE UNA OPCION: ";
		$opcion= trim(fgets(STDIN));
	

			if ($opcion == 1) {
				$rta = false;

				echo "Ingrese el id de la empresa: ";
				$idempresa= trim(fgets(STDIN));	
				echo "Ingrese el nombre de la empresa: ";
				$enombre= trim(fgets(STDIN));	
				echo "Ingrese Direccion: ";
				$edireccion = trim(fgets(STDIN));

				$newEmpresa = new empresa();
				$newEmpresa->cargar($idempresa,$enombre,$edireccion);
				$rta = $newEmpresa->insertar();	
				
				if ($rta == true) {
					echo "\n LA EMPRESA FUE INGRESADA A LA BD \n";
					
					$colEmpresas = $newEmpresa->listar("");
					foreach ($colEmpresas as $unaEmpresa){
						echo "-------------------------------------------------------";
						echo  $unaEmpresa;
						echo "-------------------------------------------------------";
					} 
				}
				else{
					echo $newEmpresa->getMensajeOperacion();
				}
				
	
			}			
			else if ($opcion == 2) {//modificar datos de una empresa
				$objEmpresa = new empresa();
				$rta = false;
				echo "\nIngrese el id de la empresa que desea modificar: ";
				$id = trim(fgets(STDIN));

						if ($objEmpresa->buscar($id) == true) {
							echo "Ingrese nuevo nombre: ";
							$empNombre = trim(fgets(STDIN));
							echo "Ingrese nueva direccion: ";
							$dire = trim(fgets(STDIN));
							$objEmpresa->setEnombre($empNombre);
							$objEmpresa->setEdireccion($dire);
							$rta = $objEmpresa->modificar();	
						
						}
						else{
							echo "\n -- No se encontro empresa con ese id \n";
							
						}
					
								   
				if($rta == true){
					echo "\n SE MODIFICO LA EMPRESA\n";
					$colEmpresas = $objEmpresa->listar("");
					foreach ($colEmpresas as $empresa){
						
						echo "-------------------------------------------------------";
						echo $empresa;
						echo "-------------------------------------------------------";
					}	
				}
				else{
					echo $objEmpresa->getMensajeOperacion();
				}
				
				
			}
			else if ($opcion == 3) {
				$objEmpresa = new empresa();
				$rta = false;

				echo "Ingrese el id de la empresa que desea eliminar : ";
				$id = trim(fgets(STDIN));
					
					if ($objEmpresa->buscar($id) == true) {
						$rta = $objEmpresa->eliminar();
						
					}
					else{
						echo "\n -- No se encontro empresa con ese id \n";
					}
				
				
				if ($rta == true) {
					echo " \n SE ELIMINO LA EMPRESA DE LA BD \n";
					$colEmpresas = $objEmpresa->listar("");	
					foreach ($colEmpresas as $empresa){
						
						echo "-------------------------------------------------------";
						echo $empresa;
						echo "-------------------------------------------------------";
					}
			   }
			   else{
				echo $objEmpresa->getMensajeOperacion();
			   }
			}
			else if($opcion == 4){
				
				$objEmpresa = new empresa();
				$colEmpresas = $objEmpresa->listar("");	

					foreach ($colEmpresas as $empresa){
						
						echo "-------------------------------------------------------";
						echo $empresa;
						echo "-------------------------------------------------------";
					}
			
			}
	
	} while ($opcion <= 4);
	
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
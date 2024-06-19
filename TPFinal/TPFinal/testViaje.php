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

/**********************************MENU GENERAL*****************************************/
function menuGeneral(){

	do{	
		echo "\n MENU GENERAL \n";
		echo "(1)VIAJES\n"; 
		echo "(2)PASAJEROS \n";
		echo "(3)RESPONSABLE VIAJE \n";
		echo "(4)EMPRESA \n";
		echo "(x)salir\n ";
		echo "Ingrese una opcion: \n";
		$opcion= trim(fgets(STDIN));

		if ($opcion == 1) {
			echo menuViaje();
		}
		else if ($opcion == 2) {
			echo  menuPasajero();
		}	
		else if ($opcion == 3) {
			echo menuResponsable();
		}
		else if ($opcion == 4) {
			echo menuEmpresa();
		}		
		else {
			echo "Saliendo del programa";
		}	

	}while ($opcion <= 4);	

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

					$colResponsable = $objRespo->listar("");	
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

echo menuGeneral();
<?php

include_once 'Banco.php';
include_once 'Cola.php';
include_once 'Mostrador.php';
include_once 'Tramite.php';
include_once 'Cliente.php';


/**
 * Permite crear el obj Banco, precargando a los clientes, los tramites que realiza, las colas y crea un arreglo de objs mostradores.
 * @return object Banco
 */
function crearBanco(){
    
    // OBJ $tramite1, $tramite2, $tramite3, $tramite4, $tramite5, $tramite6, $tramite7, $tramite8, $tramite9, $tramite10, $tramite11, $tramite12, $tramite13, $tramite14, $tramite15, $tramite16, $tramite17, $tramite18
    // OBJ $cliente1, $cliente2, $cliente3, $cliente4, $cliente5, $cliente6, $cliente7, $cliente8, $cliente9, $cliente10, $cliente11, $cliente12, $cliente13, $cliente14, $cliente15, $cliente16, $cliente17, $cliente18
    // OBJ $cola, $cola2, $cola3, $cola4
    // OBJ $mostrador1, $mostrador2, $mostrador3, $mostrador4
    // ARRAY $arregloCliente,$arregloCliente2, $arregloCliente3, $arregloCliente4, $arregloTramitesAtiende1, $arregloTramitesAtiende2, $arregloTramitesAtiende3, $arregloTramitesAtiende4, $arregloBanco
    
    
    $tramite1 = new Tramite("transferencia", "11:38", "12:00");
    $tramite2 = new Tramite("pagoFactura", "10:10", "10:11");
    $tramite3 = new Tramite("transferencia", "09:19", "12:15");
    $tramite4 = new Tramite("pagoFactura", "09:02", "09:03");
    $tramite5 = new Tramite("pagoFactura", "08:39", "08:40");
    $tramite6 = new Tramite("pagoFactura", "08:23", "08:24");
    
    $cliente1 = new Cliente(299457,$tramite1);
    $cliente2 = new Cliente(718272,$tramite2);
    $cliente3 = new Cliente(293821,$tramite3);
    $cliente4 = new Cliente(29933,$tramite4);
    $cliente5 = new Cliente(48222,$tramite5);
    $cliente6 = new Cliente(203322, $tramite6);
    
    $arregloCliente = array ();
    $arregloCliente[0] = $cliente1;
    $arregloCliente[1] = $cliente2;
    $arregloCliente[2] = $cliente3;
    $arregloCliente[3] = $cliente4;
    $arregloCliente[4] = $cliente5;
    $arregloCliente[5] = $cliente6;
    
    $arregloTramitesAtiende1 = array();
    $arregloTramitesAtiende1[0] = "transferencia";
    $arregloTramitesAtiende1[1] = "pagoFactura";
     
    $cola1= new Cola(40, 6, $arregloCliente);
    
    $mostrador1 = new Mostrador($arregloTramitesAtiende1, $cola1, 1);
    
   // -------------------------------------------------------------
   
    $tramite7 = new Tramite("prestamo", "08:01", "10:23");
    $tramite8 = new Tramite("depositar", "09:10", "09:11");
    $tramite9 = new Tramite("prestamo", "09:32", "13:15");
    $tramite10 = new Tramite("depositar", "10:02", "10:03");
    $tramite11 = new Tramite("prestamo", "08:49", "11:02");
    $tramite12 = new Tramite("prestamo", "09:39", "11:12");
    
    
    $cliente7 = new Cliente(759128,$tramite7);
    $cliente8 = new Cliente(7931683,$tramite8);
    $cliente9 = new Cliente(231232,$tramite9);
    $cliente10 = new Cliente(957912,$tramite10);
    $cliente11 = new Cliente(9851682,$tramite11);
    $cliente12 = new Cliente(949729,$tramite12);
    
    $arregloCliente2 = array ();
    $arregloCliente2[0] = $cliente7;
    $arregloCliente2[1] = $cliente8;
    $arregloCliente2[2] = $cliente9;
    $arregloCliente2[3] = $cliente10;
    $arregloCliente2[4] = $cliente11;
    $arregloCliente2[5] = $cliente12;
    
    $arregloTramitesAtiende2 = array();
    $arregloTramitesAtiende2[0] = "prestamo";
    $arregloTramitesAtiende2[1] = "depositar";
    
    $cola2= new Cola(7, 6, $arregloCliente2);

    
    $mostrador2 = new Mostrador($arregloTramitesAtiende2, $cola2,2);
    
   // ---------------------------------------------------------------------- 
   
    $tramite13 = new Tramite("consultarSaldo", "10:38", "10:39");
    $tramite14 = new Tramite("consultarSaldo", "10:49", "10:50");
    $tramite15 = new Tramite("retirar", "11:23", "11:24");
    
    $cliente13 = new Cliente(605023,$tramite13);
    $cliente14 = new Cliente(375990,$tramite14);
    $cliente15 = new Cliente(958282,$tramite15);
    
    $arregloCliente3 = array ();
    $arregloCliente3[0] = $cliente13;
    $arregloCliente3[1] = $cliente14;
    $arregloCliente3[2] = $cliente15;
    
    $arregloTramitesAtiende3 = array();
    $arregloTramitesAtiende3[0] = "consultarSaldo";
    $arregloTramitesAtiende3[1] = "retirar";

    $cola3= new Cola(6, 3, $arregloCliente3);
    $mostrador3 = new Mostrador($arregloTramitesAtiende3, $cola3,3);
    
    // ------------------------------------------------------------
    
    $tramite16 = new Tramite("transferencia", "08:52", "09:33");
    $tramite17 = new Tramite("retirar", "10:58", "11:00");
    $tramite18 = new Tramite("depositar", "12:19", "12:20");
    
    $cliente16 = new Cliente(5617269,$tramite16);
    $cliente17 = new Cliente(9571927,$tramite17);
    $cliente18 = new Cliente(294727,$tramite18);
    
    $arregloCliente4 = array ();
    $arregloCliente4[0] = $cliente16;
    $arregloCliente4[1] = $cliente17;
    $arregloCliente4[2] = $cliente18;
    
    $cola4= new Cola(12, 3, $arregloCliente4);
    
    $arregloTramitesAtiende4 = array();
    $arregloTramitesAtiende4[0] = "transferencia";
    $arregloTramitesAtiende4[1] = "retirar";
    $arregloTramitesAtiende4[2] = "depositar";
    
    $mostrador4 = new Mostrador($arregloTramitesAtiende4, $cola4,4);
    
    //---------------------------------------
    
    $arregloBanco = array();
    $arregloBanco[0] = $mostrador1;
    $arregloBanco[1] = $mostrador2;
    $arregloBanco[2] = $mostrador3;
    $arregloBanco[3] = $mostrador4;

    $banco = new Banco($arregloBanco); 
    return $banco;
}

/**
 * Permite que el usuario elija que opcion desea
 * @return int $opcion
 */


function menuOpciones(){
    echo "\n1) Indicar en que mostradores se puede atender determinado tramite.
          \n2) Indicar que mostrador es mas rapido para el tramite que desea realizar.
          \n3) Ubicar en un mostrador, ingresando el tramite que desea.
          \n4) Salir.\n";
    $opcion = trim(fgets(STDIN));
    
    if (!($opcion==1 || $opcion ==2 || $opcion ==3 || $opcion == 4)) {
        echo "Ingrese una opcion valida";
    }
    return $opcion;
}

/** Programa principal
 */
function main(){
    
    // OBJECT $banco, $mostrador, $nuevoTramite, $nuevoCliente, $mostradorAAsignar, $colaAAsignar, 
    // INT $opcionElegida, $mostradorMasLigero, $nroCuenta, $i, $nroMostradorAsignado, 
    // STRING $tramiteIngresado, $horarioCreacion, $horarioResolucion, 
    // ARRAY $arregloAtienden
    
    $banco = crearBanco();    

    do {
        $opcionElegida = menuOpciones ();
        if ($opcionElegida == 1 ){
            
            echo "Ingrese un tramite \n";
            $tramiteIngresado = trim(fgets(STDIN));
            if ($tramiteIngresado == "transferencia" || $tramiteIngresado == "pagoFactura" || $tramiteIngresado == "prestamo" || $tramiteIngresado == "depositar" || $tramiteIngresado == "consultarSaldo" || $tramiteIngresado == "retirar"){
                $arregloAtienden =             $banco->mostradoresAtiendenTramite($tramiteIngresado);
                if (count($arregloAtienden)>0){
                    for ($i=0;$i<count($arregloAtienden);$i++){
                        $mostrador=$arregloAtienden[$i];
                        echo $mostrador -> __toString();
                    }
                }
            }else {
                echo "Por favor ingrese un tramite valido.\n";
            }
        }    
        
            elseif ($opcionElegida == 2){
            echo "Ingrese un tramite: \n";
            $tramiteIngresado = trim(fgets(STDIN));
            
            if ($tramiteIngresado == "transferencia" || $tramiteIngresado == "pagoFactura" || $tramiteIngresado == "prestamo" || $tramiteIngresado == "depositar" || $tramiteIngresado == "consultarSaldo" || $tramiteIngresado == "retirar"){
            
                $mostradorMasLigero = $banco -> mostradorMasRapido($tramiteIngresado);
                echo "El mostrador mas rapido para su tramite es el: " . $mostradorMasLigero;
            } else {
                echo "Por favor ingrese un tramite valido.\n";
            }
            
        } elseif ($opcionElegida == 3){
            
            echo "Ingrese numero de cuenta: \n" ;
            $numeroCuenta = trim(fgets(STDIN));
            echo "Ingrese un tramite:\n ";
            $tramiteIngresado = trim(fgets(STDIN));
            
            
            if ($tramiteIngresado == "transferencia" || $tramiteIngresado == "pagoFactura" || $tramiteIngresado == "prestamo" || $tramiteIngresado == "depositar" || $tramiteIngresado == "consultarSaldo" || $tramiteIngresado == "retirar"){
                
                echo "Ingrese horario de creacion: \n";
                $horarioCreacion = trim(fgets(STDIN));
                echo "Ingrese horario de resolucion: \n" ;
                $horarioResolucion = trim(fgets(STDIN));
                
                $nuevoTramite = new Tramite($tramiteIngresado, $horarioCreacion, $horarioResolucion);
                $nuevoCliente = new Cliente($numeroCuenta, $nuevoTramite);
                $nroMostradorAsignado = $banco -> atender ($nuevoCliente);
                
                if ($nroMostradorAsignado <> null){
                
                    $mostradorAAsignar = $banco -> getColeccionMostrador()[$nroMostradorAsignado-1];
                    $colaAAsignar = $mostradorAAsignar -> getObjCola();
                    echo "Sera atendido por el mostrador numero: " . $nroMostradorAsignado;
                }else {
                echo "Sera atendido cuando haya lugar en algun mostrador.";
                }
  
            }else{
                echo "Por favor ingrese un tramite valido.";
            }
        } 
    } while ($opcionElegida <> 4);

 }
main();
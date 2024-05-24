<?php

include_once ('Edificio.php');
include_once ('Inmueble.php');
include_once ('Persona.php');

    //1.Se crea un objeto Edificio con los siguientes datos: Direccion= Juab B. Justo 3456 y responsable 
    //(DNI, 27432561, Carlos,Martinez,154321233).
    $objAdministrador1= new Persona ("DNI", 27432561, "Carlos", "Martinez",154321233);
    //$objEdificio1 = new Edificio ("Juan B. Justo 3456", null ,$objAdministrador1);

    //2. Crear 5 objetos inmuebles con la información de la tabla:

    $objInquilino1 = new Persona ("DNI", 12333456, "Pepe", "Suarez" , 4456722);
    $objInquilino2= new Persona ("DNI", 12333422, "Pedro", "Suarez", 446678);

    $objInmueble1 = new Inmueble (11,1,"local comercial",50000, $objInquilino1);
    $objInmueble2 = new Inmueble (12,1, "local comercial", 50000, null );
    $objInmueble3 = new Inmueble (13,2, "departamento",35000, $objInquilino2);
    $objInmueble4 = new Inmueble (14,2, "departamento",35000, null); 
    $objInmueble5 =  new Inmueble (15,3, "departamento",35000, null);
    
    //3. Implementar que el objeto Edificio que tiene los departmentos y los inquilinos creados en (1) y (2).    
    $colInmuebles = [$objInmueble1, $objInmueble2, $objInmueble3, $objInmueble4 , $objInmueble5];
    //$objEdificio1->setColInmuebles($colInmuebles);
    $objEdificio1 = new Edificio ("Juan B. Justo 3456", $colInmuebles, $objAdministrador1);

    //4.Invocar al método darInmueblesDisponiblesParaAlquiler con parámetros Tipo Uso igual a “departamento” 
    //y monto Máximo igual a 550000.  Visualizar el resultado.
    echo "\n****************EJERCICIO 4****************\n";
    function mostrarDatosColeccion ($unaColeccion){
        echo "-------------- INMUEBLE DISPONIBLES --------------". "\n";
        foreach ($unaColeccion as $unElemento){
            echo $unElemento . "\n";
        }
    }
    $colInmuebles = $objEdificio1 -> darInmueblesDisponibles("departamento", 550000) ;
    mostrarDatosColeccion ($colInmuebles);

    /**
     * 5.Invocar al método registrarAlquilerInmueble donde tipoUso = “departamento” y costoMaximo es 550000 }
     * y objPersona es una referencia a una instancia de la clase Persona con los  siguientes datos 
     * (DNI, 28765436, Mariela,Suarez,25543562). Visualizar un mensaje que represente si la acción pudo o no 
     * ser concretada. */ 
    echo "\n****************EJERCICIO 5****************\n"; 
    $objPersona = new Persona ("DNI", 28765436, "Mariela", "Suarez", 25543562);

    $resp = $objEdificio1 -> regristrarAlquilerInmueble("departamento",550000,$objPersona);

        if ($resp) {
            echo " El alquiler se registro correctamente.\n";
        } else {
            echo "Error. No se pudo registrar el alquiler. \n";
        }  

    /** 6.Invocar al método calculaCostoEdificio() y visualizar su resultado. */
    echo "\n****************EJERCICIO 6****************\n";   
    $costo = $objEdificio1-> calculaCostoEdificio(); 

    echo "El valor correspondiente a la suma de los costos de cada uno de los inmuebles alquilados es: " . $costo . "\n";
    /**7.Realizar un echo del objeto Edificio creado en el punto 1 */    
    echo "\n" ;
    echo "\n****************EJERCICIO 7****************\n";
    echo $objEdificio1; 

    echo "\n";
    
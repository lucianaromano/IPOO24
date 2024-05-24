<?php

class Torneo {
    private $coleccionPartidos; 
    private $premio; 

    public function __construct($premio){
        $this->coleccionPartidos = [];
        $this->premio = $premio;
    }

    //OBSERVADORES
    public function setColPartidos($colPartidos){
        $this->coleccionPartidos= $colPartidos;
    }

    public function getColeccionPartidos(){
        return $this->coleccionPartidos;
    }

    public function setPremio($premio){
        $this->premio= $premio;
    }

    public function getPremio(){
        return $this->premio;
    }

    //OTROS METODOS
    public function __toString(){
        $cadena = "Partidos: " . $this->mostrarDatosColeccion($this->getColeccionPartidos())."\n";
        $cadena = $cadena . "Premio: " .$this->getPremio()."\n";
    }

    function mostrarDatosColeccion ($unaColeccion){
        echo "-------------- INMUEBLE DISPONIBLES --------------". "\n";
        foreach ($unaColeccion as $unElemento){
            echo $unElemento . "\n";
        }
    }

    /**Implementar el método ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido) en la  clase Torneo
     * el cual recibe por parámetro 2 equipos, la fecha en la que se realizará el partido y si se trata de un 
     * partido de futbol o basquetbol . El método debe crear y retornar la instancia de la clase Partido que 
     * corresponda y almacenarla en la colección de partidos del Torneo. Se debe chequear que los 2 equipos 
     * tengan la misma categoría e igual cantidad de jugadores, caso contrario no podrá ser registrado ese 
     * partido en el torneo.  */

    public function ingresarPartido ($OBJEquipo1,$OBJEquipo2,$fecha,$tipoPartido){
        $partido = null; 
        $colPartidos = $this-> getColeccionPartidos();
        $idPartido = count ($colPartidos);
        //verifico que tengan igual categoria y igual cantidad de jugadores
        if ($OBJEquipo1->getObjCategoria()->getIdCategoria() == $OBJEquipo2->getObjCategoria()->getIdCategoria() && $OBJEquipo1->getCantJugadores() == $OBJEquipo2->getCantJugadores()){
            if ($tipoPartido == "futbol") {
                $partido = new PartidoFutbol ($idPartido, $fecha,$OBJEquipo1,0,$OBJEquipo2,0);
                array_push ($colPartidos,$partido);
                $this->setColPartidos($colPartidos);
            } else if ($tipoPartido == "basquet") {
                $partido = new PartidoBasquet ($idPartido, $fecha,$OBJEquipo1,0,$OBJEquipo2,0, 0);
                array_push ($colPartidos,$partido);
                $this->setColPartidos($colPartidos);
            }
        }
        return $partido;
    }

    /**Implementar el método darGanadores($deporte) en la clase Torneo que recibe por parámetro si se trata de 
     * un partido de fútbol o de básquetbol y en  base  al parámetro busca entre esos partidos los equipos 
     * ganadores ( equipo con mayor cantidad de goles). El método retorna una colección con los objetos de 
     * los equipos encontrados.*/
    public function darGanadores ($deporte){
        $coleccionPartidos = $this->getColeccionPartidos();
        $coleccionGanadores = [];
        foreach ($coleccionPartidos as $objPartido){ 
            if (is_A($objPartido,$deporte)){
                $ganador = $objPartido->darEquipoGanador();
                //verifico que el ganador no sea nulo
                if (!is_null ($ganador)){
                    array_push ($coleccionGanadores,$ganador);
                }
            }
        }
        return $coleccionGanadores;
    }

    /**Implementar el método calcularPremioPartido($OBJPartido) que debe retornar un arreglo asociativo donde 
     * una de sus claves es ‘equipoGanador’  y contiene la referencia al equipo ganador; y la otra clave es 
     * ‘premioPartido’ que contiene el valor obtenido del coeficiente del Partido por el importe configurado 
     * para el torneo. */
    //(premioPartido = Coef_partido * ImportePremio)

     public function calcularPremioPartido ($OBJPartido){
        //return array
        $arrayAsociativo = [];
        $ganador = $OBJPartido->darEquipoGanador();
        $importePremio = $this->getPremio();
        $coefPartido = $OBJPartido->getCoefBase();

        if (!is_null ($ganador)) {
            $arrayAsociativo = ["equipoGanador"=> $ganador, "premioPartido" => ($coefPartido * $importePremio)  ];
        } else {
            $arrayAsociativo = ["equipoGanador"=> null, "premioPartido" => 0];
        }
        return $arrayAsociativo; 
     }



}
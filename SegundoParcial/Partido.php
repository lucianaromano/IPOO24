<?php
class Partido{
    private $idPartido;
    private $fecha;
    private $objEquipo1;
    private $cantGolesE1;
    private $objEquipo2;
    private $cantGolesE2;
    private $coefBase;

    //CONSTRUCTOR
    public function __construct($idPartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2){
            $this->idPartido = $idPartido;
            $this->fecha = $fecha;
            $this->objEquipo1 =$objEquipo1;
            $this->cantGolesE1 = $cantGolesE1;
            $this->objEquipo2 = $objEquipo2;
            $this->cantGolesE2 = $cantGolesE2;
            $this->coefBase = 0.5;


    }

    //OBSERVADORES
    public function setIdpartido($idpartido){
         $this->idPartido= $idpartido;
    }

    public function getIdpartido(){
        return $this->idPartido;
    }

    public function setFecha($fecha){
        $this->fecha= $fecha;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setCantGolesE1($cantGolesE1){
        $this->cantGolesE1= $cantGolesE1;
    }

    public function getCantGolesE1(){
        return $this->cantGolesE1;
    }
    public function setCantGolesE2($cantGolesE2){
        $this->cantGolesE2= $cantGolesE2;
    }

    public function getCantGolesE2(){
        return $this->cantGolesE2;
    }

    public function setObjEquipo1($objEquipo1){
        $this->objEquipo1= $objEquipo1;
    }
    public function getObjEquipo1(){
        return $this->objEquipo1;
    }

    public function setObjEquipo2($objEquipo2){
        $this->objEquipo2= $objEquipo2;
    }
    public function getObjEquipo2(){
        return $this->objEquipo2;
    }

    public function setCoefBase($coefBase){
        $this->coefBase = $coefBase;
    }
    public function getCoefBase(){
        return $this->coefBase;
    }



    public function __toString(){
        //string $cadena
        $cadena = "idpartido: ".$this->getIdpartido()."\n";
        $cadena = $cadena. "Fecha: ".$this->getFecha()."\n";
        $cadena = $cadena."\n"."--------------------------------------------------------"."\n";
        $cadena = $cadena. "<Equipo 1> "."\n".$this->getObjEquipo1()."\n";
        $cadena = $cadena. "Cantidad Goles E1: ".$this->getCantGolesE1()."\n";
        $cadena = $cadena. "\n"."--------------------------------------------------------"."\n";
        $cadena = $cadena. "\n"."--------------------------------------------------------"."\n";
        $cadena = $cadena. "<Equipo 2> "."\n".$this->getObjEquipo2()."\n";
        $cadena = $cadena. "Cantidad Goles E2: ".$this->getCantGolesE2()."\n";
        $cadena = $cadena. "\n"."--------------------------------------------------------"."\n";
        return $cadena;
    }


    //otros metodos

    /**Implementar en la clase Partido el método darEquipoGanador() que retorna el equipo ganador de 
     * un partido (equipo con mayor cantidad de goles del partido), en caso de empate debe retornar
     *  a los dos equipos.*/

    public function darEquipoGanador(){
        $equipoGanador = null;
        $golesEquipo1 = $this->getCantGolesE1();
        $golesEquipo2 = $this->getCantGolesE2();
        $equipo1 = $this->getObjEquipo1();
        $equipo2 = $this->getObjEquipo2();
        
        if ($golesEquipo1 > $golesEquipo2){
            $equipoGanador = $equipo1;
        } else if ($golesEquipo1 < $golesEquipo2){
            $equipoGanador = $equipo2;
        } else {
            $equipoGanador = $equipo1. "\n-------------\n". $equipo2;
        }

        return $equipoGanador;
    }

    /**Implementar el método coeficientePartido() en la clase Partido el cual retorna el valor obtenido 
     * por el coeficiente base, multiplicado por la cantidad de goles y la cantidad de jugadores. Redefinir
     *  dicho método según corresponda. */
    public function coeficientePartido(){
        $coeficiente = 0.5; 
        $cantGoles = $this->getCantGolesE1() + $this->getCantGolesE2();
        $cantJugadores = ($this->getObjEquipo1()->getCantJugadores()) + ($this->getObjEquipo2()->getCantJugadores());
        $coeficiente *= $cantGoles * $cantJugadores; 
        return $coeficiente;

    }
}
?>
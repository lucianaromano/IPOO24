<?php
/**La clase "PasajeroVIP" tiene como atributos adicionales el número de viajero frecuente
 *  y cantidad de millas de pasajero. */
class PasajeroVip extends Pasajero {
    private $numVFrecuente;
    private $millas;

    public function __construct($n,$a,$doc,$tel,$numAsiento,$numTicket,$numVFrecuente, $millas){
        parent :: __construct($n,$a,$doc,$tel,$numAsiento,$numTicket);
        $this-> numVFrecuente = $numVFrecuente;
        $this-> millas = $millas;
    }

    //metodos de acceso
    public function getNumVFrecuente(){
        return $this-> numVFrecuente;
    }

    public function getMillas(){
        return $this-> millas;
    }

    public function setNumVFrecuente ($numVFrecuente){
        $this-> numVFrecuente = $numVFrecuente;
    }

    public function setMillas ($millas){
        $this-> millas = $millas;
    }

    //otros metodos
    public function __toString(){
        //invoco al toString de persona
        $cadena = parent:: __toString();
        $cadena = "Número de viajero frecuente: ".$this->getNumVFrecuente()."\n";
        $cadena = "Cantidad de millas: ".$this->getMillas()."\n";
        return $cadena;
    }

    /**Implementar el método darPorcentajeIncremento() que retorne el porcentaje que debe aplicarse como
     *incremento según las características del pasajero. Para un pasajero VIP se incrementa el importe 
     un 35% y si la cantidad de millas acumuladas supera a las 300 millas se realiza un incremento del 30%.*/
    public function darPorcentajeIncremento(){
        $incremento = parent :: darPorcentajeIncremento();
        $millas = $this-> getMillas();
        if ($millas > 300){
            $incremento = 30;
        } else {
            $incremento = 35;
        }
        return $incremento;
    }

}
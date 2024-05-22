<?php

/**La clase Pasajeros con necesidades especiales se refiere a pasajeros que pueden requerir servicios 
 *especiales como sillas de ruedas, asistencia para el embarque o desembarque, o comidas especiales para personas con alergias o restricciones alimentarias.  */
class PasajeroEspecial extends Pasajero {
    private $sillaRuedas;
    private $asistencia;
    private $comidas;

    public function __construct($n,$a,$doc,$tel,$numAsiento,$numTicket,$sillaRuedas,$asistencia,$comidas){
        parent :: __construct($n,$a,$doc,$tel,$numAsiento,$numTicket);
        $this-> sillaRuedas = $sillaRuedas;
        $this-> asistencia = $asistencia;
        $this-> comidas = $comidas;
    }

    //metodos de acceso
    public function getSillaRuedas(){
        return $this-> sillaRuedas;
    }

    public function getAsistencia(){
        return $this-> asistencia;
    }

    public function getComidas(){
        return $this-> comidas;
    }
    
    public function setSillaRuedas ($sillaRuedas){
        $this-> sillaRuedas = $sillaRuedas;
    }

    public function setAsistencia ($asistencia){
        $this-> asistencia = $asistencia;
    }

    public function setComidas ($comidas){
        $this-> comidas = $comidas;
    }
    //otros metodos
    public function __toString(){
        //invoco al toString de persona
        $cadena = parent:: __toString();
        $cadena = "Servicio especial requerido: ".$this->getSillaRuedas()."\n" . $this->getAsistencia()."\n".$this->getComidas()."\n";
        return $cadena;
    }

    /**Si el pasajero tiene necesidades especiales y requiere 
     *silla de ruedas, asistencia y comida especial entonces el pasaje tiene un incremento del 30% */
    public function darPorcentajeIncremento(){
        $sillaRuedas = $this->getSillaRuedas();
        $asistencia = $this->getAsistencia();
        $comidas = $this->getComidas();
        if ($sillaRuedas != null && $asistencia != null && $comidas != null) {
            $incremento = 30;
        }else{
            $incremento = 10;
        }
        return $incremento;
    
    }

}


<?php
//Diseñar e implementar la clase Reloj que simule el comportamiento de un cronómetro digital
//(con los comportamientos: puesta_a_cero, incremento, etc.). Cuando el contador llegue a 23:59:59 y
//reciba el mensaje de incremento deberá pasar a 00:00:00.

class Reloj{
    private $horas; //int
    private $minutos; //int
    private $segundos; //int

    public function __construct($hora,$minuto,$segundo){
        $this->horas=$hora;
        $this->minutos=$minuto;
        $this->segundos=$segundo;
    }

    public function getHoras(){
        return $this->horas;
    }

    public function getMinutos(){
        return $this->minutos;
    }
    
    public function getSegundos(){
        return $this->segundos;
    }

    public function setHoras($hora){
        $this-> horas=$hora;
    }
    
    public function setMinutos($minuto){
        $this-> minutos=$minuto;
    }
    
    public function setSegundos($segundo){
        $this-> segundos=$segundo;
    }
    //metodos

    public function incremento(){
    $segundos= $this->getSegundos();
    $minutos=$this->getMinutos();
    $horas=$this->getHoras();
        if ($segundos > 59) {
            $segundos=0;
            $minutos++; 
            if($minutos>59) {
               $minutos=0;
               $horas++;
            if($horas>23) {
               $horas=0;
            } 
        }
    }
    //actualizo los set
    $this->setSegundos($segundos);
    $this->setMinutos($minutos);
    $this->setHoras($horas);
}

    public function puestaACero(){
        $this->setHoras(0); //es lo mismo que $this->horas=0;
        $this->setMinutos(0);
        $this->setSegundos(0);
    }
    //metodo toString de la clase
    public function  __toString()
    {
        $cadena = "La hora es: " .$this->getHoras().":" .$this->getMinutos().":" .$this->getSegundos() ;
        return $cadena;
    }
       //verificar toString con el test
}
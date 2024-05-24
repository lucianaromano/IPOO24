<?php

/*si se trata de un partido de basquetbol  se almacena la cantidad de infracciones de manera tal que
 al coeficiente base se debe restar un coeficiente de penalización, cuyo valor por defecto es: 0.75, * 
(por) la cantidad de infracciones. Es decir:
coef  = coeficiente_base_partido  - (coef_penalización*cant_infracciones);
*/


class PartidoBasquet extends Partido {
    private $cantInfracciones; 

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2, $cantInfracciones){
        parent :: __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->cantInfracciones = $cantInfracciones;
    }

    public function getCantInfracciones(){
        return $this->cantInfracciones;
    }

    public function setCantInfracciones($cantInfracciones){
        $this-> cantInfracciones = $cantInfracciones;
    }


    //otros metodos
    public function __toString(){
        //invoco al toString de persona
        $cadena = parent:: __toString();
        $cadena = $cadena. "Cantidad de infracciones: " .$this->getCantInfracciones()."\n";
        return $cadena;
    }

    /**al coeficiente base se debe restar un coeficiente de penalización, cuyo valor por defecto es: 0.75, * 
     * (por) la cantidad de infracciones. Es decir:
    coef  = coeficiente_base_partido  - (coef_penalización*cant_infracciones); */
    public function coeficientePartido(){
        $coeficiente = parent :: coeficientePartido();
        $coeficientePenalizacion = 0.75;
        $cantInfracciones = $this-> getCantInfracciones();
        $coeficienteBasquet = $coeficiente - ($coeficientePenalizacion *  $cantInfracciones);
    
        return $coeficienteBasquet;
    }
    

}
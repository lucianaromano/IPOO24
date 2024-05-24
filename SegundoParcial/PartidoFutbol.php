<?php

/*Si se trata de un partido de fútbol, se deben gestionar el valor de 3 coeficientes que serán aplicados 
según la categoría del partido (coef_Menores,coef_juveniles,coef_Mayores) .  A continuación se presenta 
una tabla en la que se detalla los valores por defecto de cada  coeficiente aplicado a una categoría de 
un partido  fútbol: */
class PartidoFutbol extends Partido {

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2){
        parent :: __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
    }

    //otros metodos
    public function __toString(){
        //invoco al toString de persona
        $cadena = parent:: __toString();
        return $cadena;
    }

    public function coeficientePartido(){
        $coeficiente = parent :: coeficientePartido();
        $nombreCategoria1 = $this->getObjEquipo1()->getCategoria()->getDescripcion();
        $nombreCategoria2 = $this->getObjEquipo2()->getCategoria()->getDescripcion();
        $coeficienteFutbol = 0;

        switch ($nombreCategoria1 && $nombreCategoria2 ){
            case "Menores" : 
                $coeficienteFutbol += $coeficiente * 0.13;
                break;
            case "Juveniles" : 
                $coeficienteFutbol += $coeficiente * 0.19;
                break;
            case "Mayores" :
                $coeficienteFutbol += $coeficiente * 0.27;
                break;
        }
        return $coeficienteFutbol;
    }

}
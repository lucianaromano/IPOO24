<?php

/**las motos importadas, se debe almacenar  el país desde el que se importa y el  importe correspondiente 
 *a los impuestos de importación que la empresa paga por el ingreso al país */
class MotoImportada extends Moto {
    private $paisOrigen;
    private $impuesto;

    public function __construct($codigo,$costo,$anioFabricacion,$descripcion,$porcentaje,$activo,$paisOrigen, $impuesto){
        parent :: __construct($codigo,$costo,$anioFabricacion,$descripcion,$porcentaje,$activo);
        $this-> paisOrigen = $paisOrigen;
        $this-> impuesto = $impuesto;
    }

    //metodos de acceso
    public function getPaisOrigen(){
        return $this-> paisOrigen;
    }

    public function getImpuesto(){
        return $this-> impuesto;
    }

    public function setPaisOrigen ($paisOrigen){
        $this-> paisOrigen = $paisOrigen;
    }

    public function setImpuesto ($impuesto){
        $this-> impuesto = $impuesto;
    }

    //otros metodos
    public function __toString(){
        //invoco al toString de persona
        $cadena = parent:: __toString();
        $cadena = "Pais de importacion: ".$this->getPaisOrigen()."\n".
        $cadena = "Impuestos de importacion: " .$this->getImpuesto()."\n";
        return $cadena;
    }

    public function darPrecioVenta(){
        $precio = parent :: darPrecioVenta();
        $impuesto = $this->getImpuesto();
        $precioImportado = $precio + (($precio * $impuesto) / 100);
        return $precioImportado;
    }

}
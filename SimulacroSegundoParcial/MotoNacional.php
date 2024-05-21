<?php
/**Con el objetivo de incentivar el consumo de productos Nacionales, se desea almacenar un porcentaje de 
 * descuento en las motos Nacionales que será aplicado al momento de la venta (por defecto el valor del 
 * descuento es del 15%).*/
class MotoNacional extends Moto {
    private $descuento;

    public function __construct($codigo,$costo,$anioFabricacion,$descripcion,$porcentaje,$activo){
        parent :: __construct($codigo,$costo,$anioFabricacion,$descripcion,$porcentaje,$activo);
        $this-> descuento = 15;
    }

    //metodos de acceso
    public function getDescuento(){
        return $this-> descuento;
    }

    public function setDescuento ($descuento){
        $this-> descuento = $descuento;
    }

    //otros metodos
    public function __toString(){
        //invoco al toString de persona
        $cadena = parent:: __toString();
        $cadena = "Descuento: " .$this->getdescuento()."% \n";
        return $cadena;
    }

    public function darPrecioVenta(){
        $precio = parent :: darPrecioVenta();
        $descuento = $this->getDescuento();
        $precioNacional = $precio - ($precio * $descuento / 100);
        return $precioNacional;
    }
}
<<<<<<< HEAD
<?php

/**
 * Una tienda de indumentaria deportiva desea registrar y sistematizar las ventas de los  productos que 
 * comercializa. Para ello guarda  información de cada uno de sus productos como: talle, color, marca y 
 * cantidad en stock. También guarda información de sus clientes y además guarda toda la información de 
 * la venta realizada: fecha, productos y cliente.En la primera etapa de sistematización se van a implementar
 *  las siguientes clases: Tienda, Producto, Venta e ítem.
 */

 //clase Producto: Se registra la siguiente información: código barra, marca, color, talle, descripción y cantidad en stock. 

 class Producto {
    private $codigoBarra;
    private $marca;
    private $color;
    private $talle;
    private $descripcion;
    private $stock;

    //metodo constructor
    public function __construct($codigoBarra, $marca, $color, $talle, $descripcion, $stock){
        $this->codigoBarra = $codigoBarra;
        $this->marca = $marca;
        $this->color = $color;
        $this->talle = $talle;
        $this->descripcion = $descripcion;
        $this->stock = $stock;
    }

    //OBSERVADORES
    public function getCodigoBarra(){
        return $this->codigoBarra;
    }

    public function getMarca(){
        return $this->marca;
    }

    public function getColor(){
        return $this->color;
    }

    public function getTalle(){
        return $this->talle;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getStock(){
        return $this->stock;
    }

    //MODIFICADORES
    public function setCodigoBarra($cod){
        $this->codigoBarra = $cod;
    }

    public function setMarca($marca){
        $this->marca = $marca;
    }

    public function setColor($color){
        $this->color = $color;
    }

    public function setTalle($talle){
        $this->talle = $talle;
    }

    public function setDescripcion($desc){
        $this->descripcion = $desc;
    }

    public function setStock($stock){
        $this->stock = $stock;
    }

    public function __toString(){
        return "Codigo: " . $this->getCodigoBarra() . "\n" .
               "Marca: " . $this->getMarca() . "\n" .
               "Color: " . $this->getColor() . "\n" .
               "Talle: " . $this->getTalle() . "\n" .
               "Descripcion: " . $this->getDescripcion() . "\n" .
               "Stock: " . $this->getStock();
    }

    /**Se debe definir el método actualizarStock que recibe por parámetro una cantidad y actualiza el valor
     * del stock del producto según corresponda. Si el valor recibido por parámetro es >0, entonces se incrementa
     * el stock y si el valor es <0 se decrementa el stock del producto. */
    public function actualizarStock($cantStock){
        $stock = $this->getStock();
        $this->setStock ($stock + $cantStock);
        }
}
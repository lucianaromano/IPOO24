<?php

date_default_timezone_set("America/Argentina/Buenos_Aires");

class Venta{
    private $fecha;
    private $refProductos;
    private $cliente;

    public function __construct($date, $productos, $customer)
    {
        $this->fecha = $date;
        $this->refProductos = $productos;
        $this->cliente = $customer;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function getRefProductos(){
        return $this->refProductos;
    }

    public function setRefProductos($refProductos){
        $this->refProductos = $refProductos;
    }

    public function getCliente(){
        return $this->cliente;
    }

    public function setCliente($cliente){
        $this->cliente = $cliente;
    }

    public function __toString()
    {
        $info = "Fecha de venta: {$this->getFecha()}\n".
        "Producto/s comprado/s: {$this->getRefProductos()}\n".
        "Cliente: {$this->getCliente()}\n";
        return $info;
    }

    /** Final amount of a sale
     * @return int
     */

    public function darImporteVenta(){
        $productos = $this->getRefProductos();
        $n = count($productos);
        $importe = 0;
        for($i = 0; $i < $n; $i++){
            if(1 <= $productos[$i]->getStock()){
                $importe =+ $productos[$i]->darPrecioVenta();
                $nuevoStock = 1 - $productos[$i]->getStock();
                $productos[$i]->setStock($nuevoStock);
            }
        }
        return $importe;
    }
}
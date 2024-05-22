<?php

class Productos{
    private $codigoBarra;
    private $descripcion;
    private $stock;
    private $porcIva;
    private $precioCompra;
    private $refRubro;

    public function __construct($codigo, $descr, $stock, $iva, $precioCompra, $rubro)
    {
        $this->codigoBarra = $codigo;
        $this->descripcion = $descr;
        $this->stock = $stock;
        $this->porcIva = $iva;
        $this->precioCompra = $precioCompra;
        $this->refRubro = $rubro;
    }
    

    public function getCodigoBarra(){
        return $this->codigoBarra;
    }

    public function setCodigoBarra($codigoBarra){
        $this->codigoBarra = $codigoBarra;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function getStock(){
        return $this->stock;
    }

    public function setStock($stock){
        $this->stock = $stock;
    }

    public function getPorcIva(){
        return $this->porcIva;
    }

    public function setPorcIva($porcIva){
        $this->porcIva = $porcIva;
    }

    public function getPrecioCompra(){
        return $this->precioCompra;
    }

    public function setPrecioCompra($precioCompra){
        $this->precioCompra = $precioCompra;
    }

    public function getRefRubro(){
        return $this->refRubro;
    }

    public function setRefRubro($refRubro){
        $this->refRubro = $refRubro;
    }

    public function __toString()
    {
        $info = "Codigo de Barra: {$this->getCodigoBarra()}\n".
        "Descripcion: {$this->getCodigoBarra()}\n".
        "Stock: {$this->getStock()}\n".
        "Porcentaje Iva: {$this->getPorcIva()}\n".
        "Precio compra: {$this->getPrecioCompra()}\n".
        "Rubro: {$this->getRefRubro()}\n";
        return $info;
    }

    /** Calcula el precio de venta de un producto
     * @return int
     */
    
    public function darPrecioVenta(){
        $precioCompra = $this->getPrecioCompra();
        $porcIva = $this->getPorcIva() / 100;
        $porcRubro = $this->getRefRubro()->getPorcentajeGanancia() / 100;
        $precioVenta = $precioCompra + (($precioCompra * $porcIva) + ($precioCompra * $porcRubro));
        return $precioVenta;
    }
}
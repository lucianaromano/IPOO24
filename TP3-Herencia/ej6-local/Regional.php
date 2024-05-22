<?php

class Regional extends Productos{
    private $porcDescuento;

    public function __construct($codigo, $descr, $stock, $iva, $precioCompra, $rubro, $porcDescuento)
    {
        parent::__construct($codigo, $descr, $stock, $iva, $precioCompra, $rubro);
        $this->porcDescuento = $porcDescuento;
    }
    

    public function getPorcDescuento(){
        return $this->porcDescuento;
    }

    public function setPorcDescuento($porcDescuento){
        $this->porcDescuento = $porcDescuento;
    }

    public function __toString()
    {
        $info = parent::__toString();
        $info .= "Porcentaje Descuento: {$this->getPorcDescuento()}\n";
        return $info;
    }

    public function darPrecioVenta()
    {
        $precioVenta = parent::darPrecioVenta();
        $descuento = $this->getPorcDescuento();
        $precioVenta += $precioVenta * $descuento;
        return $precioVenta;
    }
}
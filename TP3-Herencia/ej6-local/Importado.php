<?

class Importado extends Productos{
    private $origen;

    public function __construct($codigo, $descr, $stock, $iva, $precioCompra, $rubro, $origen)
    {
        parent::__construct($codigo, $descr, $stock, $iva, $precioCompra, $rubro);
        $this->origen = $origen;
    }
    
    public function getOrigen(){
        return $this->origen;
    }

    public function setOrigen($origen){
        $this->origen = $origen;
    }

    public function __toString()
    {
        $info = parent::__toString();
        $info .= "Origen: {$this->getOrigen()}\n";
        return $info;
    }

    public function darPrecioVenta()
    {
        $precioVenta = parent::darPrecioVenta();
        $incremento = 0.5;
        $impuesto = 0.1;
        $precioVenta += $precioVenta * ($incremento + $impuesto);
        return $precioVenta;
    }
}
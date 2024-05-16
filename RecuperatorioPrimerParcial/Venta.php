<<<<<<< HEAD
<?php
/*clase Venta: Se registra la fecha, el cliente, número de factura, tipo de comprobante (Tipo A o B) y 
la colección de ítems vendidos.*/

class Venta {
    private $fecha;
    private $cliente;
    private $numeroFactura;
    private $tipoComprobante;
    private $colItems;
    
    //CONSTRUCTOR
    public function __construct($fecha, $cliente, $factura, $comprobante, $colItems)
    {
        $this->fecha = $fecha;
        $this->cliente = $cliente;
        $this->numeroFactura = $factura;
        $this->tipoComprobante = $comprobante;
        $this->colItems = $colItems;
    }

    //OBSERVADORES
    public function getFecha(){
        return $this->fecha;
    }

    public function getCliente(){
        return $this->cliente;
    }

    public function getNumeroFactura(){
        return $this->numeroFactura;
    }

    public function getTipoComprobante(){
        return $this->tipoComprobante;
    }

    public function getColItems(){
        return $this->colItems;
    }

    //MODIFICADORES
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function setCliente($cliente){
        $this->cliente = $cliente;
    }

    public function setNumeroFactura($factura){
        $this->numeroFactura = $factura;
    }

    public function setTipoComprobante($comprobante){
        $this->tipoComprobante = $comprobante;
    }

    public function setColItems($colItems){
        $this->colItems = $colItems;
    }

    public function __toString(){
        return "Fecha: " . $this->getFecha() . "\n" .
                "Cliente: " . $this->getCliente() . "\n" .
                "Factura n°: " . $this->getNumeroFactura() ."\n".
                "Tipo de comprobante:  " . $this->getTipoComprobante() . "\n" .
                "Items vendidos: ".$this->colItemsAString();
    }

    public function colItemsAString() {
        $retorno = "";
        $coleccion = $this->getColItems();
        for ($i=0; $i < count($coleccion); $i++) { 
            $retorno .= $coleccion[$i] . "\n";
            $retorno .= "--------------------\n";
        }
        return $retorno;
    }

/**Se pide un método incorporarProducto que recibe por parámetro un producto y la cantidad que desea registrarse 
 * en la venta. Si es posible realizar la venta, teniendo en cuenta la cantidad solicitada y la cantidad en stock 
 * del producto, se crea un item y se incorpora a la colección de items de la venta.
 * Recordar que debe actualizarse el stock del producto si la venta se realiza con éxito.
 * El método debe retornar el objeto de productos modificado si se pudo realizar la venta o null en caso contrario.*/
    public function incorporarProducto($objProducto, $cantidadAVender) {
        $exito = false;
        if(($objProducto->getStock() - $cantidadAVender) >= 0) {
            $coleccion = $this->getColItems();
            $objProducto->actualizarStock($cantidadAVender);
            $nuevoItem = new Item($cantidadAVender, $objProducto);
            array_push($coleccion, $nuevoItem);
            $this->setColItems($coleccion);
            $exito = true;
        }
        return $exito;
    }
}
=======
<?php
/*clase Venta: Se registra la fecha, el cliente, número de factura, tipo de comprobante (Tipo A o B) y 
la colección de ítems vendidos.*/

class Venta {
    private $fecha;
    private $cliente;
    private $numeroFactura;
    private $tipoComprobante;
    private $colItems;
    
    //CONSTRUCTOR
    public function __construct($fecha, $cliente, $factura, $comprobante, $colItems)
    {
        $this->fecha = $fecha;
        $this->cliente = $cliente;
        $this->numeroFactura = $factura;
        $this->tipoComprobante = $comprobante;
        $this->colItems = $colItems;
    }

    //OBSERVADORES
    public function getFecha(){
        return $this->fecha;
    }

    public function getCliente(){
        return $this->cliente;
    }

    public function getNumeroFactura(){
        return $this->numeroFactura;
    }

    public function getTipoComprobante(){
        return $this->tipoComprobante;
    }

    public function getColItems(){
        return $this->colItems;
    }

    //MODIFICADORES
    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function setCliente($cliente){
        $this->cliente = $cliente;
    }

    public function setNumeroFactura($factura){
        $this->numeroFactura = $factura;
    }

    public function setTipoComprobante($comprobante){
        $this->tipoComprobante = $comprobante;
    }

    public function setColItems($colItems){
        $this->colItems = $colItems;
    }

    public function __toString(){
        return "Fecha: " . $this->getFecha() . "\n" .
                "Cliente: " . $this->getCliente() . "\n" .
                "Factura n°: " . $this->getNumeroFactura() ."\n".
                "Tipo de comprobante:  " . $this->getTipoComprobante() . "\n" .
                "Items vendidos: ".$this->colItemsAString();
    }

    public function colItemsAString() {
        $retorno = "";
        $coleccion = $this->getColItems();
        for ($i=0; $i < count($coleccion); $i++) { 
            $retorno .= $coleccion[$i] . "\n";
            $retorno .= "--------------------\n";
        }
        return $retorno;
    }

/**Se pide un método incorporarProducto que recibe por parámetro un producto y la cantidad que desea registrarse 
 * en la venta. Si es posible realizar la venta, teniendo en cuenta la cantidad solicitada y la cantidad en stock 
 * del producto, se crea un item y se incorpora a la colección de items de la venta.
 * Recordar que debe actualizarse el stock del producto si la venta se realiza con éxito.
 * El método debe retornar el objeto de productos modificado si se pudo realizar la venta o null en caso contrario.*/
    public function incorporarProducto($objProducto, $cantidadAVender) {
        $exito = false;
        if(($objProducto->getStock() - $cantidadAVender) >= 0) {
            $coleccion = $this->getColItems();
            $objProducto->actualizarStock($cantidadAVender);
            $nuevoItem = new Item($cantidadAVender, $objProducto);
            array_push($coleccion, $nuevoItem);
            $this->setColItems($coleccion);
            $exito = true;
        }
        return $exito;
    }
}
>>>>>>> 68d1c376344af95067d6498f559d1c7dedc314dc

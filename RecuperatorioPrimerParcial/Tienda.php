<<<<<<< HEAD
<?php

/**En la clase Tienda se registra nombre, dirección, teléfono, la colección de productos y la colección de
 *  ventas realizadas. */

class Tienda{
    private $nombre;
    private $direccion;
    private $telefono;
    private $colProductos;
    private $colVentasRealizadas;

    //CONSTRUCTOR
    public function __construct($nombre, $direccion, $tel, $colProductos, $colVentasRealizadas){
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $tel;
        $this->colProductos = $colProductos;
        $this->colVentasRealizadas = $colVentasRealizadas;
    }

    //OBSERVADORES
    public function getNombre(){
        return $this->nombre;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getColProductos(){
        return $this->colProductos;
    }

    public function getColVentasRealizadas(){
        return $this->colVentasRealizadas;
    }

    //MODIFICADORES
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function setTelefono($tel){
        $this->telefono = $tel;
    }

    public function setColProductos($colProductos){
        $this->colProductos = $colProductos;
    }

    public function setColVentasRealizadas($colVentasRealizadas){
        $this->colVentasRealizadas = $colVentasRealizadas;
    }

    public function __toString(){
        return "Nombre: " . $this->getNombre() . "\n" . 
        "Direccion: " . $this->getDireccion() . "\n" . 
        "Telefono: " . $this->getTelefono() . "\n" .
        "Productos:\n" . $this->colAString($this->getColProductos()) . "\n" .
        "Ventas realizadas:\n" . $this->colAString($this->getColVentasRealizadas());
    }

    public function colAString($coleccion) {
        $retorno = "";
        for ($i=0; $i < count($coleccion); $i++) { 
            $retorno .= $coleccion[$i] . "\n";
            $retorno .= "--------------------\n";
        }
        return $retorno;
    }

    /** Implementar el método buscarProducto que dado un código de barra por parámetro, retorna la el subíndice 
     * donde se encuentra un objeto producto con ese código de barra. En caso de no encontrar el código de barra 
     * en la colección de productos retornar -1*/
    public function buscarProducto ($codBarra) {
        $encontrado = false;
        $i = 0;
        $colProductos = $this-> getColProductos ();
        while (!$encontrado && $i  < count ($colProductos)){
            $unProducto = $colProductos [$i];
            if ($unProducto-> getCodigoBarra == $codBarra){
            $encontrado = true;     
            $i = $colProductos[$i];
            $i++; 
        }if ($encontrado = true){
            return $i ;
        } else {
            return (-1);
        }
        }
    }

    /** Implementar el método realizarVenta que recibe por parámetro con arreglos asociativos que 
    * contienen la siguiente información: código barra correspondiente a un producto y cantidad de ejemplares del 
    * producto  que desea venderse.  
    * El procedimiento debe buscar los productos según el código de barra, verificar el stock disponible y realizar 
    * el registro de la venta en caso de ser posible. 
    * El procedimiento debe retornar un objeto Venta con los ítems correspondientes a aquellos productos que se 
    *pudo vender.  */
    public function realizarVenta($colInfoVenta) {
        $numVenta = count($this->getColVentasRealizadas());
        $fecha = date("d-m-Y");
        $unaVenta = null;
        foreach ($colInfoVenta as $unItem) {

            if ($this->buscarProducto ($producto->getCodigoBarra()) != null){
                $indiceProducto = $indice; 
            } if ($indiceProducto != 1 ){
                $unObjProducto = $this-> getColProductos()[$indiceProducto];
                if ($unObjProducto->getCantStock()>= $unItem['cantidadAVender']){
                    if($unaVenta= null){
                        $date=new  DateTime();
                        $unaVenta= new Venta (date ->format ('Y-m-d H:i:s')), "Consumidor Final", count($this->getColVentas())+1, "B");
                    }
                }
            }
        }
    }
}
=======
<?php

/**En la clase Tienda se registra nombre, dirección, teléfono, la colección de productos y la colección de
 *  ventas realizadas. */

class Tienda{
    private $nombre;
    private $direccion;
    private $telefono;
    private $colProductos;
    private $colVentasRealizadas;

    //CONSTRUCTOR
    public function __construct($nombre, $direccion, $tel, $colProductos, $colVentasRealizadas){
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->telefono = $tel;
        $this->colProductos = $colProductos;
        $this->colVentasRealizadas = $colVentasRealizadas;
    }

    //OBSERVADORES
    public function getNombre(){
        return $this->nombre;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getTelefono(){
        return $this->telefono;
    }

    public function getColProductos(){
        return $this->colProductos;
    }

    public function getColVentasRealizadas(){
        return $this->colVentasRealizadas;
    }

    //MODIFICADORES
    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function setTelefono($tel){
        $this->telefono = $tel;
    }

    public function setColProductos($colProductos){
        $this->colProductos = $colProductos;
    }

    public function setColVentasRealizadas($colVentasRealizadas){
        $this->colVentasRealizadas = $colVentasRealizadas;
    }

    public function __toString(){
        return "Nombre: " . $this->getNombre() . "\n" . 
        "Direccion: " . $this->getDireccion() . "\n" . 
        "Telefono: " . $this->getTelefono() . "\n" .
        "Productos:\n" . $this->colAString($this->getColProductos()) . "\n" .
        "Ventas realizadas:\n" . $this->colAString($this->getColVentasRealizadas());
    }

    public function colAString($coleccion) {
        $retorno = "";
        for ($i=0; $i < count($coleccion); $i++) { 
            $retorno .= $coleccion[$i] . "\n";
            $retorno .= "--------------------\n";
        }
        return $retorno;
    }

    /** Implementar el método buscarProducto que dado un código de barra por parámetro, retorna la el subíndice 
     * donde se encuentra un objeto producto con ese código de barra. En caso de no encontrar el código de barra 
     * en la colección de productos retornar -1*/
    public function buscarProducto ($codBarra) {
        $encontrado = false;
        $i = 0;
        $colProductos = $this-> getColProductos ();
        while (!$encontrado && $i  < count ($colProductos)){
            $unProducto = $colProductos [$i];
            if ($unProducto-> getCodigoBarra == $codBarra){
            $encontrado = true;     
            $i = $colProductos[$i];
            $i++; 
        }if ($encontrado = true){
            return $i ;
        } else {
            return (-1);
        }
        }
    }

    /** Implementar el método realizarVenta que recibe por parámetro con arreglos asociativos que 
    * contienen la siguiente información: código barra correspondiente a un producto y cantidad de ejemplares del 
    * producto  que desea venderse.  
    * El procedimiento debe buscar los productos según el código de barra, verificar el stock disponible y realizar 
    * el registro de la venta en caso de ser posible. 
    * El procedimiento debe retornar un objeto Venta con los ítems correspondientes a aquellos productos que se 
    *pudo vender.  */
    public function realizarVenta($colInfoVenta) {
        $numVenta = count($this->getColVentasRealizadas());
        $fecha = date("d-m-Y");
        $unaVenta = null;
        foreach ($colInfoVenta as $unItem) {

            if ($this->buscarProducto ($producto->getCodigoBarra()) != null){
                $indiceProducto = $indice; 
            } if ($indiceProducto != 1 ){
                $unObjProducto = $this-> getColProductos()[$indiceProducto];
                if ($unObjProducto->getCantStock()>= $unItem['cantidadAVender']){
                    if($unaVenta= null){
                        $date=new  DateTime();
                        $unaVenta= new Venta (date ->format ('Y-m-d H:i:s')), "Consumidor Final", count($this->getColVentas())+1, "B");
                    }
                }
            }
        }
    }
}
>>>>>>> 68d1c376344af95067d6498f559d1c7dedc314dc

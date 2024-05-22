<?php

class Local{
    private $productosEnVenta;
    private $productosImportados;
    private $productosRegionales;
    private $colVentasHechas;

    public function __construct($productos, $importados, $regionales)
    {
        $this->productosEnVenta = $productos;
        $this->productosImportados = $importados;
        $this->productosRegionales = $regionales;
    }

    public function getProductosEnVenta(){
        return $this->productosEnVenta;
    }

    public function setProductosEnVenta($productosEnVenta){
        $this->productosEnVenta = $productosEnVenta;
    }

    public function getProductosImportados(){
        return $this->productosImportados;
    }

    public function setProductosImportados($productosImportados){
        $this->productosImportados = $productosImportados;
    }

    public function getProductosRegionales(){
        return $this->productosRegionales;
    }

    public function setProductosRegionales($productosRegionales){
        $this->productosRegionales = $productosRegionales;
    }

    public function getColVentasHechas(){
        return $this->colVentasHechas;
    }

    public function setColVentasHechas($colVentasHechas){
        $this->colVentasHechas = $colVentasHechas;
    }
    /** incorporates a new product if it is not in the store
     * @param $objProducto
     * @return bool
     */

    public function incorporarProductoTienda($objProducto){
        $productos = $this->getProductosEnVenta();
        $n = count($productos);
        if($n == 0){
            $incorporated = true;
        } else{
            for($i = 0; $i < $n; $i++){
                if($objProducto->getCodigoBarra() != $productos[$i]->getCodigoBarra()){
                    $incorporated = true;
                }else{
                    $incorporated = false;
                }
            }
        }
        
        if($incorporated == true){
            $productos[$n] = $objProducto;
            $this->setProductosEnVenta($productos);
        }
        return $incorporated;
    }

    /** Returns the sale price of a product
     * @param int $codProducto
     * @param int
     */

    public function retornarImporteProducto($codProducto){
        $productos = $this->getProductosEnVenta();
        $n = count($productos);
        $precio = 0;
        for($i = 0; $i < $n; $i++){
            if($codProducto == $productos[$i]->getCodigoBarra()){
                $precio = $productos[$i]->darPrecioVenta();
                break;
            }
        }
        return $precio;
    }

    /** We return the total cost in products that are in the store
     * @return int
     */

    public function retornarCostoProductoTienda(){
        $totalCosto = 0;
        $productos = $this->getProductosEnVenta();
        $n = count($productos);
        for($i = 0; $i < $n; $i++){
            $cantidad = $productos[$i]->getStock();
            $precio = $productos[$i]->darPrecioVenta();
            $totalCosto += ($cantidad * $precio);
        }
        return $totalCosto;
    }

    /** Returns the most economical product of an item
    *  @param string $rubro 
    *  @return object
    */
    public function productoMasEconomico($rubro){
        $productos = $this->getProductosEnVenta();
        $n = count($productos);
        $proMasBarato = null;
        $precio = 99999;
        for($i = 0; $i < $n; $i++){
            if($productos[$i]->getRefRubro() == $rubro){
                $precioProducto = $productos[$i]->darPrecioVenta();
                if($precioProducto <= $precio){
                    $precio = $precioProducto;
                    $proMasBarato = $productos[$i];
                }
            }
        }
        return $proMasBarato;
    }

    /** Returns the n best-selling products in the year
     * @param int $anio
     * @param int $n La cantidad de productos mas vendidos que queremos ver
     * @return array
     */

   /*  public function informarProductosMasVendidos($anio, $n){
        $productosEnLocal = $this->getProductosEnVenta();
        $e = count($productosEnLocal);
        $ventas = $this->getColVentasHechas();
        $d = count($ventas);
        for($i = 0; $i < $d; $i++){
            $fecha = $ventas[$i]->getFecha();
            $anioCompra = date("Y", $fecha);
            if($anioCompra == $anio){
                $productosComprados = $ventas[$i]->getRefProductos();
                $p = count($productosComprados);
                for($a = 0; $a < $p; $a++){
                    for($u = 0; $u < $e; $u++){
                        if($productosComprados[$a]->getCodigoBarra() == $productosEnLocal[$u]->getCodigoBarra()){

                        }
                    }
                    
                }
            }
        }
    } */

    /** Returns the average sales of imported products made
     * @return float
     */

    public function promedioVentasImportados(){
        $importados = $this->getProductosImportados();
        $s = count($importados);
        $ventas = $this->getColVentasHechas();
        $d = count($ventas);
        $totalProductosVendidos = 0;
        $importadosComprados = 0;
        for($i = 0; $i < $d; $i++){
            $productosVendidos = count($ventas[$i]->getRefProductos());
            $totalProductosVendidos += $productosVendidos;
            for($e = 0; $e < $productosVendidos; $e++){
                for($r = 0; $r < $s; $r++){
                    if($productosVendidos[$e] == $importados[$s]){
                        $importadosComprados += 1;
                    }
                }
            }
        }
        $promedio = ($importadosComprados * 100) / $totalProductosVendidos;
        return $promedio;
    }

    /** returns all the products that were
     *  purchased by the person identified
     *  with the typeDoc and numDoc received by parameter
     * @param string $tipoDoc
     * @param int $numDoc
     * @return array
     */
    public function informarConsumoCliente($tipoDoc, $numDoc){
        $ventas = $this->getColVentasHechas();
        $n = count($ventas);
        $productosCompradosXCliente = [];
        for($i = 0; $i < $n; $i++){
            if($tipoDoc == $ventas[$i]->getCliente()->getTipoDoc()
            && $numDoc == $ventas[$i]->getCliente()->getNumDoc()){
                array_push($productosCompradosXCliente, $ventas[$i]);
            }
        }
        return $productosCompradosXCliente;
    }
}

    
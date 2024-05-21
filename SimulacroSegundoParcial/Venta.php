<?php
/**1. Se registra la siguiente información: número, fecha, referencia al cliente, referencia a una colección de
motos y el precio final.
2. Método constructor que recibe como parámetros cada uno de los valores a ser asignados a cada
atributo de la clase.
3. Los métodos de acceso de cada uno de los atributos de la clase.
4. Redefinir el método _toString para que retorne la información de los atributos de la clase.
5. Implementar el método incorporarMoto($objMoto) que recibe por parámetro un objeto moto y lo
incorpora a la colección de motos de la venta, siempre y cuando sea posible la venta. El método cada
vez que incorpora una moto a la venta, debe actualizar la variable instancia precio final de la venta.
Utilizar el método que calcula el precio de venta de la moto donde crea necesario.
*/
class Venta{
    //atributos de la clase
    private $numero;
    private $fecha;
    private $refCliente;
    private $colMotos;
    private $precioFinal;
    
    //metodo constructor
    public function __construct($numero, $fecha, $refCliente, $colMotos, $precioFinal)
    {
        $this->numero = $numero;
        $this->fecha = $fecha;
        $this->refCliente = $refCliente;
        $this->colMotos = $colMotos;
        $this->precioFinal = $precioFinal;   
    }
    //metodos de acceso

    public function getNumero(){
        return $this->numero;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function getRefCliente(){
        return $this->refCliente;
    }

    public function getColMotos(){
        return $this->colMotos;
    }

    public function getPrecioFinal(){
        return $this->precioFinal;
    }

    public function setNumero($numero){
        $this->numero = $numero;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function setRefCliente($refCliente){
        $this->refCliente = $refCliente;
    }

    public function setColMotos($colMotos){
        $this->colMotos = $colMotos;
    }

    public function setPrecioFinal($precioFinal){
        $this->precioFinal = $precioFinal;
    }

    //otros metodos

    public function __toString(){
        //sting $cadena
        $cadena = "======== VENTA  " .$this->getNumero(). " ========\n";
        $cadena .= "Número: ".$this->getNumero()."\n";
        $cadena .= "Fecha: ".$this->getFecha()."\n"; 
        $cadena .= "Cliente: ----\n" .$this->getRefCliente()."---\n";
        $cadena .= "Coleccion de motos: ---\n" .$this->colMotosAString(). "---\n";
        $cadena .= "Precio final: " .$this->getPrecioFinal();

        return $cadena;
    }

    /**
     * Metodo que retona una variable de tipo String que contiene todas las motos de Colmotos
     * @return string
     */
    public function colMotosAString(){
        //string $cadena
        //array $motos
        $cadena = "";
        $motos= $this-> getColMotos();

        for($i=0; $i< count ($motos) ; $i++){
            $cadena = $cadena . "Moto n° [".$i."]:\n".$motos[$i]."\n--\n"; 
        }
        return $cadena;
    }


    /**
     * 5. Implementar el método incorporarMoto($objMoto) que recibe por parámetro un objeto vehículo
     * y lo incorpora a la colección de vehículos de la venta, siempre y cuando sea posible la venta. El método
     * cada vez que incorpora un vehículo a la venta, debe actualizar la variable instancia precio final de la
     * venta. Utilizar el método que calcula el precio de venta de un vehículo donde crea necesario.
     * @param moto
     * */


    public function incorporarMoto($objMoto){
    //array $colMotosCopia
    //float $precioMoto, $precioFinalCopia

    if($objMoto->getActivo()){
        $colMotosCopia = $this->getColMotos();
        array_push($colMotosCopia, $objMoto);
        $this->setColMotos($colMotosCopia);
        
        $precioMoto = $objMoto ->darPrecioVenta();
        $precioFinalCopia = $this->getPrecioFinal();
        $precioFinalCopia = $precioFinalCopia + $precioMoto;
        $this->setPrecioFinal($precioFinalCopia);
    }
    }

    /**Implementar el método retornarTotalVentaNacional() que retorna  la sumatoria del precio venta de
     *cada una de las motos Nacionales vinculadas a la venta.*/
    public function retornarTotalVentaNacional(){
        $totalNacional = 0;
        $colMotos = $this->getColMotos() ;
        $cantidadMotos = count ($colMotos);
        for($i=0;$i<$cantidadMotos;$i++){
            $unaMoto = $colMotos[$i];
            if($unaMoto instanceof MotoNacional){
                $precioVenta = $unaMoto->darPrecioVenta();
                $totalNacional = $totalNacional + $precioVenta;
            }
        }     
        return $totalNacional;  
    }

    /**Implementar el método retornarMotosImportadas() que retorna una colección de motos importadas
     * vinculadas a la venta. Si la venta solo se corresponde con motos Nacionales la colección 
     * retornada debe ser vacía.*/
    public function retornarMotosImportadas(){
        $colMotos = $this->getColMotos();
        $cantidadMotos = count($this->getColMotos());
        $colMotosImportadas = array();
        for($i=0;$i<$cantidadMotos;$i++){
            $unaMoto = $colMotos[$i];
            if($unaMoto instanceof MotoImportada){
                array_push($colMotosImportadas,$unaMoto);
            }
        }
        return $colMotosImportadas;
    }

}
?>
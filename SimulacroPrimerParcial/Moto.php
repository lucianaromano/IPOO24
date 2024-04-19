<?php
/**1. Se registra la siguiente información: código, costo, año fabricación, descripción, porcentaje
incremento anual, activa (atributo que va a contener un valor true, si la moto está disponible para la
venta y false en caso contrario).
2. Método constructor que recibe como parámetros los valores iniciales para los atributos definidos en la
clase.
3. Los métodos de acceso de cada uno de los atributos de la clase.
4. Redefinir el método toString para que retorne la información de los atributos de la clase. */
class Moto{
    private $codigo;
    private $costo;
    private $anioFabricacion; 
    private $descripcion;
    private $porcentaje;
    private $activo; //boolean
    
    //CONSTRUCTOR
    public function __construct($codigo,$costo,$anioFabricacion,$descripcion,$porcentaje,$activo){
        $this->codigo=$codigo;
        $this->costo=$costo;
        $this->anioFabricacion=$anioFabricacion;
        $this->descripcion=$descripcion;
        $this->porcentaje=$porcentaje;
        $this->activo=false;   
    }

    //OBSERVADORES
    public function getCodigo(){
        return $this->codigo;
    }

    public function getCosto(){
        return $this->costo;
    }

    public function getAnioFabricacion(){
        return $this->anioFabricacion;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    public function getPorcentaje(){
        return $this->porcentaje;
    }

    public function getActivo(){
        return $this->activo;
    }

    //MODIFICADORES
    public function setCodigo($codigo){
        $this->codigo = $codigo;
    }

    public function setCosto($costo){
        $this->costo = $costo;
    }

    public function setAnioFabricacion($anioFabricacion){
        $this->anioFabricacion = $anioFabricacion;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    public function setPorcentaje($porcentaje){
        $this->porcentaje = $porcentaje;
    }

    public function setActivo($valor){
        $this->activo = $valor;
    }

    //otros metodos
    public function __toString(){
        //string $cadena
        $cadena = "Código: ". $this->getCodigo()."\n";
        $cadena = $cadena. "Costo: $" .$this->getCosto()."\n";
        $cadena = $cadena. "Año de fabricacion: ".$this->getAnioFabricacion()."\n";
        $cadena = $cadena. "Descripcion: ".$this->getDescripcion ()."\n";
        $cadena = $cadena. "Porcentaje de incremento anual: ".$this->getPorcentaje()."\n";
        $cadena = $cadena. "Activa: ".$this->getActivo()."\n";

        return $cadena;
    }

    /**
     *  5. Implementar el método darPrecioVenta el cual calcula el valor por el cual puede ser vendido un
     * vehículo. Si el vehículo no se encuentra disponible para la venta retorna un valor < 0. Si el vehículo está
     * disponible para la venta, el método realiza el siguiente cálculo:
     * $_venta = $_compra + $_compra * (anio * por_inc_anual)
     * donde $_compra: es el costo del vehículo.
     * anio: cantidad de años transcurridos desde que se fabricó el vehículo.
     * por_inc_anual: porcentaje incremento anual del vehículo
     * @return float $precioVenta
    */
    public function darPrecioVenta(){
        //float $precioVenta, $costoBase
        //int $amiosTranscurridos

        if($this->getActivo() == false){
            $precioVenta = -1;
        } else {
            $costoBase = $this->getCosto();
            $aniosTranscurridos = date("Y") - $this->getAnioFabricacion();
            $precioVenta = $costoBase + ($costoBase * ($aniosTranscurridos * $this->getPorcentaje()));
        }
        return $precioVenta;
    }
}
?>
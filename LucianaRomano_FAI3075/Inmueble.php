<?php
/**En la clase Inmueble se registra la siguiente información: código de referencia, el número de piso 
 * en el que se encuentra dentro del edificio, el tipo de uso  (comercial o departamento), costo mensual
 *  y una referencia al inquilino si se encuentra alquilado.
*/
class Inmueble{
    private $codigo;
    private $numPiso;
    private $tipoUso;
    private $costoMensual;
    private $objInquilino;

    public function __construct($codigo,$numPiso,$uso, $costoMensual, $objInquilino){
        $this-> codigo = $codigo;
        $this-> numPiso = $numPiso;
        $this-> tipoUso = $uso;
        $this-> costoMensual = $costoMensual;
        $this-> objInquilino = $objInquilino;
    }

    //METODOS DE ACCESO GET
    public function getCodigo(){
        return $this -> codigo;
    }
    
    public function getNumPiso(){
        return $this -> numPiso;
    }

    public function getTipoUso(){
        return $this -> tipoUso;
    }

    public function getCostoMensual(){
        return $this -> costoMensual;
    }

    public function getObjInquilino(){
        return $this -> objInquilino;
    }

    //METODOS DE ACCESO SET
    public function setCodigo ($codigo){
        $this -> codigo = $codigo;
    }
    
    public function setNumPiso ($numPiso){
        $this -> numPiso = $numPiso;
    }
    public function setTipoUso ($uso){
        $this -> tipoUso = $uso;
    }
    
    public function setCostoMensual ($costoMensual){
        $this -> costoMensual = $costoMensual;
    }
    public function setObjInquilino ($inquilino){
        $this -> objInquilino = $inquilino;
    }

    //METODO TOSTRING
    public function __toString(){
        //string $cadena
        $cadena = "Codigo de referencia: ". $this->getCodigo()."\n";
        $cadena = $cadena. "Numero de piso dentro del edificio: " .$this->getNumPiso()."\n";
        $cadena = $cadena. "Tipo de uso: ".$this->getTipoUso()."\n";
        $cadena = $cadena. "Costo mensual: ".$this->getCostoMensual()."\n";
        $cadena = $cadena. "Datos del inquilino: ".$this->getObjInquilino()."\n";

        return $cadena;
    }

    //otros metodos
    /**
     *  Implementar el método estaDisponible el cual recibe como parámetro el tipo  de uso que se requiere y el 
     * monto máximo disponible para alquilar y determine si el inmueble está disponible o no. Tener en cuenta 
     * que un inmueble sólo puede ser alquilado si no se encuentra alquilado en ese momento. Ingrese una 
     * implementación posible para el método.
     */

     public function estaDisponible($tipoUso,$costoMaximo){
        //boolean $disponible
           $disponible  = false;
           if ($this->getObjInquilino() == null && $this->getTipoUso() == $tipoUso && $this->getCostoMensual() <= $costoMaximo) {
               $disponible = true;
           }
           return $disponible;
       }
    
       public function alquilarInmueble($objInquilino)
       {
           $exito = false;
           if ($this->getObjInquilino() == null) {
               $this->setObjInquilino($objInquilino);
               $exito = true;
           }
           return $exito;
       }
}

?>
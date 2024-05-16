<?php
/**En la clase Edificio: se registra la dirección, la referencia a la colección de inmuebles que lo 
 * componen y la referencia a una instancia de la clase Persona que representa al administrador del edificio.
*/
class Edificio{
    private $direccion;
    private $colInmuebles;
    private $objPersona;

    public function __construct($direccion,$colInmuebles,$objPersona){
        $this-> direccion = $direccion;
        $this-> colInmuebles = $colInmuebles;
        $this-> objPersona = $objPersona;
    }

    //METODOS DE ACCESO GET
    public function getDireccion(){
        return $this -> direccion;
    }
    
    public function getColInmuebles(){
        return $this -> colInmuebles;
    }

    public function getObjPersona(){
        return $this -> objPersona;
    }

    //METODOS DE ACCESO SET
    public function setDireccion ($direccion){
        $this -> direccion = $direccion;
    }
    
    public function setColInmuebles ($colInmuebles){
        $this -> colInmuebles = $colInmuebles;
    }
    public function setobjPersona ($objPersona){
        $this -> objPersona = $objPersona;
    }
    
    //METODO TOSTRING
    public function __toString(){
        //string $cadena
        //$num = count($this->getColInmuebles());
        $cadena = "-Direccion del edificio: ". $this->getDireccion()."\n";
        $cadena = $cadena. "-Cantidad de inmuebles: " . count($this->getColInmuebles())."\n";
        $cadena = $cadena. "-Administrador del edificio: \n".$this->getObjPersona()."\n";
       

        return $cadena;
    }

    /**
     * Implementar el método darInmueblesDisponibles que recibe por parámetro el tipo de uso del
     *  inmueble y el costo mensual mensual máximo que se puede pagar y retorna una colección de 
     * todos los departamentos del tipo de uso  recibido (tipoUso) que se encuentran disponibles
     *  para ser alquilados y cuyo costo mensual no supera el valor recibido en el parámetro costoMaximo. 
     */

     public function darInmueblesDisponibles($tipoUso,$costoMaximo){
        $colInmuebles = $this-> getColInmuebles ();
        $colDisponibles = [ ];
        for ($i=0 ; $i< count ($colInmuebles) ; $i++){
             $unInm = $colInmuebles[$i];
             if ($unInm->estaDisponible($tipoUso, $costoMaximo) == true){
                array_push ($colDisponibles, $unInm);
             }
        }
        return $colDisponibles;
    }
    
    //SE DEBIA USAR EL METODO ESTA DISPONIBLE

    /**
     *  Implementar el método buscarInmueble que recibe por parámetro un objeto inmueble y 
     * retorna el índice de la colección donde se encuentra almacenado. Si el objeto no existe 
     * en la colección se debe retornar el valor-1
     */
    public function buscarInmueble($objInmueble){
        $inmuebleEncontrado = false;
        $i = 0;
        $codigo = $objInmueble ->getCodigo();
        $colInmueblesCopia = $this->getColInmuebles(); 
        while (!$inmuebleEncontrado && $i < count($colInmueblesCopia)){
            $unInm = $colInmueblesCopia[$i];
            if($unInm->getCodigo() == $codigo){
                $inmuebleEncontrado = true;
                $i = $colInmueblesCopia[$i];
                $i++;
        }
            if ($inmuebleEncontrado = true){
                return $i;
            }else {
                return (-1);
            }
    }
    }
   
    /**
     * Implementar el método registrarAlquilerInmueble que recibe por parámetro el tipo de uso que se requiere 
     * para el inmueble (tipoUso) , el monto máximo (montoMaximo) a pagar por mes y la referencia a la persona 
     * que  desea alquilar (objPersona) el inmueble. Tener en cuenta que solo se va a poder realizar el alquiler
     *  de dicho inmueble si se verifica la política de alquiler de la empresa.  Por política de la empresa, 
     * los inmuebles de un edificio se deben ir ocupando por piso y por tipo. Es decir, hasta que todos los 
     * inmuebles de un piso y de un tipo no se encuentren ocupados, no es posible alquilar un inmueble de un 
     * piso superior.
     * El método debe retornar verdadero en caso de poder registrar el alquiler o falso en caso contrario. 
     * Recordar actualizar las estructuras correspondientes
     */
    /*
     public function registrarAlquilerInmueble($objInmueble, $objPersona){
        //return boolean
        $exito = false;
        if ($this->verificarPisos($objInmueble)) {
            $colInmuebles = $this->getColInmuebles();
            $i = 0;
            while ($i < count($colInmuebles)) {
                if ($colInmuebles[$i]->getCodigo() == $objInmueble->getCodigo()) {
                    $colInmuebles[$i]->alquilarInmueble($objPersona);
                    $exito = true;
                    $i = count($colInmuebles);
                }
                $i++;
            }
        }
        return $exito;
    }
    */
    /*
    public function registrarAlquilerInmueble($tipoUso,$costoMaximo, $objPersona){
        //buscarInmueble ($objInmueble) return indice donde se encuentra o -1
        //darInmueblesDisponibles ($tipoUso, $costoMaximo) return $colDisponibles
        $colInmuebles = $this->getColInmuebles();
        $alquilerRegistrado = false;
        //Uso while porque sale cuando encuentra
        $encontro = false;
        $i = 0;
        while($i < count($colInmuebles) && !$encontro){
        $objPersona = $colInmuebles[$i]->getObjPersona();
        $nroPiso = $colInmuebles[$i]->getNroPiso();
        $tipoInmueble = $colInmuebles[$i]->getTipoUso();
        $codigo = $colInmuebles[$i]->getCodigo();
        $costo = $colInmuebles[$i]->getCostoMensual();
            if($objPersona == null && $tipoInmueble == $tipoUso){
                $encontro = true;
        }
            $i++;
        }
            if($encontro == true && $costo <=$costoMaximo){
                $alquilerRegistrado = true;
        }
            return $alquilerRegistrado;
        }
        */

    public function regristrarAlquilerInmueble($tipoUso,$costoMaximo,$objPersona){
        $respuesta = false;
        $coleccion = $this->darInmueblesDisponibles($tipoUso, $costoMaximo);  //obtengo el arreglo de inmuebles disponibles 
        $pisoMinimo= 99999;
        $indice = -1;
        $inmuebleReg = null; 
        if (count($coleccion) > 0 ){ //verifico que haya algun inmueble disponible
            foreach ($coleccion as $inmueble ){
                if($pisoMinimo > $inmueble ->getNumPiso()){
                    $respuesta = true;
                    $pisoMinimo = $inmueble->getNumPiso();
                    $indice = $this-> buscarInmueble($inmueble);
                    $inmuebleReg = $inmueble;
                }
            }
        }
        if($pisoMinimo!=99999){
            $inmuebleReg->setObjInquilino ($objPersona);
            $this->setColInmuebles($indice, $$inmuebleReg);
        }    
        return $respuesta;
    }
/* 
    public function verificarPisos($objInmueble){

        $lleno = true;
        $coleccion = $this->darInmueblesDisponibles($objInmueble->getTipoUso(), $objInmueble->getCostoMensual());
        if (count($coleccion) != 0) {
            $i = 0;
            while ($coleccion[$i]->getNumPiso() <= ($objInmueble->getNumPiso() - 1) && $lleno) {
                if ($coleccion[$i]->getObjInquilino() == null) {
                    $lleno = false;
                }
                $i++;
            }
        } else {
            $lleno = false;
        }
        return $lleno;
    }
    */

    public function ordenarPorPiso()
    {
        $coleccion = $this->getColInmuebles();
        $sinCambio = false;
        $i = 0;
        $largo = count($coleccion);

        while ($i < $largo && !$sinCambio) {
            $sinCambio = true;
            for ($j = 0; $j < $largo - $i - 1; $j++) {
                if ($coleccion[$j]->getNumPiso() > $coleccion[$j + 1]->getNumPiso()) {
                    $aux = $coleccion[$j];
                    $coleccion[$j] = $coleccion[$j + 1];
                    $coleccion[$j + 1] = $aux;
                    $sinCambio = false;
                }
            }
            $i++;
        }
        $this->setColInmuebles($coleccion);
    }
    /**
     * Implementar el método calculaCostoEdificio  método que retorna el valor  correspondiente a la suma de
     *  los costos de cada uno de los inmuebles que se encuentran alquilados. 
     */

     public function calculaCostoEdificio(){
        $costo = 0;
        foreach($this->getColInmuebles() as $unInm){
            if ($unInm->getObjInquilino() != null){
                $costo += $unInm->getCostoMensual();
            }
        }
        return $costo;
     }


}



?>
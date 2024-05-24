<?php
/**1. Se registra la siguiente información: denominación, dirección, la colección de clientes, colección de
motos y la colección de ventas realizadas.
2. Método constructor que recibe como parámetros los valores iniciales para los atributos de la clase.
3. Los métodos de acceso para cada una de las variables instancias de la clase.
4. Redefinir el método _toString para que retorne la información de los atributos de la clase. */

class Empresa{
    //atributos de la clase
    private $denominacion;
    private $direccion;
    private $colClientes; 
    private $colMotos;
    private $colVentas;

    //CONSTRUCTOR
    public function __construct($denominacion, $direccion, $colClientes, $colMotos, $colVentas)
    {
        $this->denominacion = $denominacion;
        $this->direccion = $direccion;
        $this->colClientes = $colClientes;
        $this->colMotos = $colMotos;
        $this->colVentas = $colVentas;   
    }
    //OBSERVADORES

    public function getDenominacion(){
        return $this->denominacion;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getColClientes(){
        return $this->colClientes;
    }

    public function getColMotos(){
        return $this->colMotos;
    }

    public function getColVentas(){
        return $this->colVentas;
    }
    //MODIFICADORES
    public function setDenominacion($denominacion){
        $this->denominacion = $denominacion;
    }

    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    public function setColClientes($colClientes){
        $this->colClientes = $colClientes;
    }

    public function setColMotos($colMotos){
        $this->colMotos = $colMotos;
    }

    public function setColVentas($colVentas){
        $this->colVentas = $colVentas;
    }

    //otros metodos
    private function retornarCadenaDesdeColeccion ($coleccion){
        $cadena = "";
        foreach ($coleccion as $unElementoCol){
            $cadena= $cadena . "." . $unElementoCol . "\n";
        }
        return $cadena;
    }
    public function __toString(){
        //string cadena 
        $cadena = "Denominacion: ". $this->getDenominacion() ."\n";
        $cadena = $cadena . "Direccion: ". $this->getDireccion()."\n";
        $cadena = $cadena . ">>>>> Coleccion de clientes: <<<<< \n" .$this->retornarCadenaDesdeColeccion($this->getColClientes())."\n";
        $cadena = $cadena . ">>>>> Coleccion de motos: <<<<< \n" .$this->retornarCadenaDesdeColeccion($this->getColMotos())."\n";
        $cadena = $cadena . ">>>>> Coleccion de ventas: <<<<< \n" .$this->retornarCadenaDesdeColeccion($this->getColVentas())."\n";
        
        return $cadena ;
    }
    
    /**
     * 5.Implementar el método retornarMoto($codigoMoto) que recorre la colección de motos de la Empresa y
     * retorna la referencia al objeto moto cuyo código coincide con el recibido por parámetro.*/
    public function retornarMoto ($codigoMoto){
        //boolean $motoEncontrada
        //int $posMoto
        //array $colMotosCopia
        //moto $motoEncontrada

        $motoObtenida = null;
        $motoEncontrada = false;  //bandera
        $posMoto= 0;
        $colMotosCopia = $this->getColMotos ();

        while (!$motoEncontrada && $posMoto < count($colMotosCopia)){
            if($colMotosCopia[$posMoto]->getCodigo() == $codigoMoto){
                $motoEncontrada = true;
                $motoObtenida = $colMotosCopia[$posMoto];
            }
            $posMoto++;
        }
        return $motoObtenida;
    }
    /*6. Implementar el método registrarVenta($colCodigosMoto, $objCliente) método que recibe por
    parámetro una colección de códigos de motos, la cual es recorrida, y por cada elemento de la colección
    se busca el objeto moto correspondiente al código y se incorpora a la colección de motos de la instancia
    Venta que debe ser creada. Recordar que no todos los clientes ni todas las motos, están disponibles
    para registrar una venta en un momento determinado.
    El método debe setear los variables instancias de venta que corresponda y retornar el importe final de la
    venta.
     * @param array $colCodigosMoto
     * @param cliente $objCliente
     * 
     * @return float
     */
    public function registrarVenta($colCodigosMoto, $objCliente){
        $importeFinal = 0 ;

        if($objCliente ->getEstado() ==  "alta"){ //el cliente esta activo
            $motosAVender = [];
            $copiaColVentas = $this-> getColVentas();
            $idVenta = count ($copiaColVentas) + 1 ;
            $nuevaVenta = new Venta ($idVenta, date("m/d/y"), $objCliente , $motosAVender, 0); 
            $colMotos = $this->getColMotos();
            foreach ($colCodigosMoto as $unCodigoMoto) { //Recorro la coleccion de CB
                $unObjMoto = $this->retornarMoto($unCodigoMoto);
                if ($unObjMoto!=null) {
                    //por cada moto encontrada y activa
                    $nuevaVenta->incorporarMoto($unObjMoto);
                }
            }
            if (count($nuevaVenta->getColMotos())>0){ //encontre motos a vender
                array_push($copiaColVentas, $nuevaVenta);
                $this->setColVentas($copiaColVentas); // actualizo la coleccion de ventas
                $importeFinal = $nuevaVenta ->getPrecioFinal();
            }
        }else {
            $importeFinal = -1;
        }
            return $importeFinal;
    }

    /**
     * 7. Implementar el método retornarVentasXCliente($tipo,$numDoc) que recibe por parámetro el tipo y
     *número de documento de un Cliente y retorna una colección con las ventas realizadas al cliente. 
     * @param string $tipo , $numDoc
     * @return array
     */ 
    public function retornarVentasXCliente($tipo,$numDoc){
       $colVentasRealizadas = $this->getColVentas();
       $colVentasCliente = array ();
       foreach ($colVentasRealizadas as $unObjVenta){
        if ($unObjVenta->getCliente()->getTipoDoc()== $tipo && $unObjVenta->getCliente()->getNroDoc()==$numDoc){
            array_push($colVentasCliente, $unObjVenta);
        }
       }
       return $colVentasCliente;
    }

    /** Implementar el método informarSumaVentasNacionales() que recorre la colección de ventas realizadas por 
     * la empresa y retorna el importe total de ventas Nacionales realizadas por la empresa.*/
    public function informarSumaVentasNacionales(){
        $colVentas = $this->getColVentas();
        $ventasNacionales = 0;
        for($i=0 ; $i < count($colVentas) ; $i++){
            $unaVenta = $colVentas[$i];
            $totalVenta = $unaVenta->retornarTotalVentaNacional();
            $ventasNacionales = $ventasNacionales + $totalVenta;
        }
        return $ventasNacionales;

    }

    /**Implementar el método informarVentasImportadas() que recorre la colección de ventas realizadas 
     * por la empresa y retorna una colección de ventas de motos  importadas. Si en la venta al menos
     *una de las motos es importada la venta debe ser informada.*/
    public function informarVentasImportadas(){
        $colVentas = $this->getColVentas();
        $ventasImportadas = [];
        
        for($i = 0; $i < count($colVentas); $i++){
            $unaVenta = $colVentas[$i];
            $ventaMotosImportadas = $unaVenta->retornarMotosImportadas();
            if(!empty($ventaMotosImportadas)){
                array_push($ventasImportadas,$ventaMotosImportadas);
            }
        }
        return $ventasImportadas;
    }

  /* otra forma  
    $colVentas = $this->getColVentas();
    $ventasImportadas= [];

    foreach ($colVentas as $unaVenta) {
        //recorro la coleccion de ventas 
        $colMotosImportadas = $unaVenta -> retornarMotosImportadas(); //por cada venta llamo al metodo para que
        //me de las motos importadas, podria devolverme una coleccion vacia, entonces compruebo q no este vacia 
        //y si es asi armo la coleccion de ventas que tiene al menos 1 moto importada
        if (empty($colMotosImportadas) == false) {
            array_push ($ventasImportadas, $unaVenta);
        }
    return $ventasImportadas;
    }
*/
}


?>
<?php
/**a clase Cliente:
0. Se registra la siguiente información: nombre, apellido, si está o no dado de baja, el tipo y el número de
documento. Si un cliente está dado de baja, no puede registrar compras desde el momento de su baja.
1. Método constructor que recibe como parámetros los valores iniciales para los atributos.
2. Los métodos de acceso de cada uno de los atributos de la clase.
3. Redefinir el método _toString para que retorne la información de los atributos de la clase */
class Cliente{
    //atributos de la clase
    private $nombre;
    private $apellido;
    private $baja; //Si un cliente está dado de baja, no puede registrar compras desde el momento de su baja
    private $tipoDoc;
    private $nroDoc;

    //metodo constructor
    public function __construct($nombre, $apellido, $baja, $tipoDoc, $nroDoc)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->baja = $baja;
        $this->tipoDoc = $tipoDoc;
        $this->nroDoc = $nroDoc;   
    }
    //metodos de acceso

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function getBaja(){
        return $this->baja;
    }

    public function getTipoDoc(){
        return $this->tipoDoc;
    }

    public function getNroDoc(){
        return $this->nroDoc;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function setBaja($baja){
        $this->baja = $baja;
    }

    public function setTipoDoc($tipoDoc){
        $this->tipoDoc = $tipoDoc;
    }

    public function setNroDoc($nroDoc){
        $this->nroDoc = $nroDoc;
    }

    //metodo toString de la clase
        public function __toString(){
        $cadena = "Nombre: " . $this->getNombre() .
        "\nApellido: " . $this->getApellido() . 
        "\nBaja: " . $this->getBaja() . 
        "\nTipo de Documento: " . $this->getTipoDoc() .
        "\nNro Documento: " . $this->getNroDoc();
        return $cadena;
    }
}
?>
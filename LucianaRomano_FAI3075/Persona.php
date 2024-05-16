<?php
/**
 * En la clase Persona se registra el  tipo y número de documento, nombre, apellido y teléfono de contacto.
 */
class Persona {
    private $tipoDocumento;
    private $nroDocumento;
    private $nombre;
    private $apellido;
    private $telefono;


    public function __construct($tipo,$num,$nombre,$apellido,$tel){
        $this-> tipoDocumento = $tipo;
        $this-> nroDocumento = $num;
        $this-> nombre = $nombre;
        $this-> apellido = $apellido;
        $this-> telefono = $tel;
    }

    //METODOS DE ACCESO GET
    public function getTipoDocumento(){
        return $this -> tipoDocumento;
    }
    
    public function getNroDocumento(){
        return $this -> nroDocumento;
    }

    public function getNombre(){
        return $this -> nombre;
    }

    public function getApellido(){
        return $this -> apellido;
    }

    public function getTelefono(){
        return $this -> telefono;
    }

    //METODOS DE ACCESO SET
    public function setTipoDocumento ($tipo){
        $this -> tipoDocumento = $tipo;
    }
    
    public function setNroDocumento ($num){
        $this -> nroDocumento = $num;
    }
    public function setNombre ($nombre){
        $this -> nombre = $nombre;
    }
    
    public function setApellido ($apellido){
        $this -> apellido = $apellido;
    }
    public function setTelefono ($tel){
        $this -> telefono = $tel;
    }

    //METODO TOSTRING
    public function __toString(){
        //string $cadena
        $cadena = "Tipo de documento: ". $this->getTipoDocumento()."\n";
        $cadena = $cadena. "Numero de documento: " .$this->getNroDocumento()."\n";
        $cadena = $cadena. "Nombre: ".$this->getNombre()."\n";
        $cadena = $cadena. "Apellido: ".$this->getApellido()."\n";
        $cadena = $cadena. "Telefono: ".$this->getTelefono()."\n";

        return $cadena;
    }
    



}



?>
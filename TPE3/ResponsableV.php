<?php
/*se desea guardar la información de la persona responsable de realizar el viaje, para ello 
cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido. */
class ResponsableV{
    private $empleado;
    private $licencia;
    private $nombre;
    private $apellido;

    public function __construct($e,$l,$n,$a){
        $this->empleado= $e;
        $this->licencia= $l;
        $this->nombre= $n;
        $this->apellido= $a;
    }

    //metodos de acceso get
    public function getEmpleado (){
        return $this->empleado;
    }

    public function getLicencia (){
        return $this->licencia;
    }

    public function getNombre(){
        return $this-> nombre;
    }

    public function getApellido(){
        return $this-> apellido;
    }

    //metodos de acceso set
    public function setEmpleado($e){
        $this->empleado=$e;
    }

    public function setLicencia($l){
        $this->licencia=$l;
    }

    public function setNombre($n){
        $this->nombre=$n;
    }

    public function setApellido ($a){
        $this->apellido=$a;
    }
    //metodo toString de la clase
    public function __toString(){
        $infoResponsableV= "-----------RESPONSABLE V-----------
         \nNumero de empleado: ". $this->getEmpleado().
        "\nNúmero de licencia: ".$this->getLicencia().
        "\nNombre: ".$this->getNombre().
        "\nApellido: " .$this->getApellido() ."\n";
        return $infoResponsableV;
    }
}



?>
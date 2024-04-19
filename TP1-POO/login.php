<?php

class Login {
    private $nombreUsuario;
    private $contrasenia;
    private $frase;
    private $arregloContrasenias;
    private $indiceArreglo;

    public function __construct($n,$clave,$frase){
        $this-> nombreUsuario = $n;
        $this-> contrasenia = $clave;
        $this-> frase= $frase;
        $this->arregloContrasenias = [4];
        $this->indiceArreglo = 0; //inicializa el arreglo en 0
        $this->arregloContrasenias[$this->indiceArreglo] = $this->contrasenia; //en el indice 0 coloca la contraseña nueva 
        $this->indiceArreglo++;
    }

    public function getNombreUsuario(){
        return $this-> nombreUsuario;
    }

    public function getContrasenia(){
        return $this-> contrasenia;
    }
    
    public function getFrase(){
        return $this-> frase;
    }

    public function getArregloContrasenias(){
        return $this-> arregloContrasenias;
    }

    public function setNombreUsuario ($u){
        $this-> nombreUsuario = $u;
    }

    public function setContrasenia ($c){
        $this-> contrasenia = $c;
    }
    public function setFrase ($f){
        $this-> frase = $f;
    }


    //validar una contraseña con la almacenada
    public function validarContrasenia ($c){
        if ($this->contrasenia == $c) {
            $retorno = true;
        } else {
            $retorno = false;
        }
        return $retorno;
    }

    // cambiar la contraseña actual por otra nueva, el sistema deja cambiar la contraseña 
    //siempre y cuando esta no haya sido usada recientemente (esdecir no se encuentra dentro de las cuatro almacenadas)
    public function cambiarContrasenia($nuevaContrasenia)
    {
        $i = 0;
        $valida = true;
        while ($i < count($this->arregloContrasenias) && $valida) {
            if ($this->arregloContrasenias[$i] == $nuevaContrasenia) {
                $valida = false;
                echo "La contrasenia ingresada no puede ser igual a una anterior\n";
            } else {
                $i++;
            }
        }
        if ($valida) {
            $this->arregloContrasenias[$this->indiceArreglo] = $nuevaContrasenia;
            $this->indiceArreglo = ($this->indiceArreglo + 1) % 4;
        }
        return $valida;
    }


    public function recordar($usuario)
    {
        //String $retorno
        if ($this->nombreUsuario == $usuario) {
            $retorno = $this->fraseAyuda;
        } else {
            $retorno = "Usuario incorrecto\n";
        }
        return $retorno;
    }

    public function __destruct()
    {
        echo $this . " instancia destruida, no hay referencias a este objeto";
    }
}
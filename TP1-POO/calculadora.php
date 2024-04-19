<?php
//Diseñar e implementar la clase Calculadora que permite realizar las operaciones básicas: + , - , *, /

class Calculadora{
    private $num1; //int
    private $num2; //int

    public function __construct($numero1,$numero2){
        $this->num1=$numero1;
        $this->num2=$numero2;
    }

    public function getNum1(){
        return $this->num1;
    }

    public function getNum2(){
        return $this->num2;
    }

    public function setNum1($primero){
        $this-> num1= $primero;
    }
    public function setNum2($segundo){
        $this-> num2= $segundo;
    } 
    //funciones de operaciones basicas
    public function suma (){
        $suma = $this->getNum1() + $this->getNum2();
        return $suma;
    }

    public function Resta(){
        $resta = $this->getNum1() - $this->getNum2();
        return $resta;
    }

    public function multiplicacion(){
    $multiplicacion = $this->getNum1() * $this->getNum2();
    return $multiplicacion;
    }

    public function division(){
    $division = $this->getNum1() / $this->getNum2();
    return $division;
    }
     //metodo toString de la clase
    public function __toString()
    {
        $cadena = "El primer numero es " .$this->getNum1(). "/n El segundo numero es: ".$this->getNum2();
        return $cadena;
    }
}
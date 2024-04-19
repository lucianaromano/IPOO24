<?php

class fecha{
    private $dia;
    private $mes;
    private $anio;

    public function __construct($d,$m,$a)
    {
        $this->dia=$d;
        $this->mes=$m;
        $this->anio=$a;
    }
    //metodos de acceso
    public function getDia(){
        return $this->dia;
    }

    public function getMes(){
        return $this->mes;
    }

    public function getAnio(){
        return $this->anio;
    }

    public function setDia($d){
        $this-> dia=$d;
    }

    public function setMes($m){
        $this-> mes=$m;
    }

    public function setAnio($a){
        $this-> anio=$a;
    }

    //funcion para forma extendida
    public function formaExtendida(){
        $mes= $this->getMes();
        $meses =[
                1 => "Enero",
                2 => "Febrero",
                3 => "Marzo",
                4 => "Abril",
                5 => "Mayo",
                6 => "Junio",
                7 => "Julio",
                8 => "Agosto",
                9 => "Septiembre",
                10 => "Octubre",
                11 => "Noviembre",
                12 => "Diciembre",
        ];
        return $meses [$mes] ?? "Mes invalido";
    }
    public function bisiesto()
    {
        $nuevoAnio = $this->getAnio();
        $a = false;
        if ($nuevoAnio % 4 == 0 && $nuevoAnio % 100 != 0) {
            $a = true;
        } elseif ($nuevoAnio % 400 == 0) {
            $a = true;
        }
        return $a;
    }


    private function sumarDiasA31($numDia)
    {
        if (($this->getDia() + $numDia) > 31) {
            $this->incrementarMes(1);
            $this->setDia(1);
        } else {
            $incDia = $this->getDia() + $numDia;
            $this->setDia($incDia);
        }
    }

    private function sumarDiasA30($numDia)
    {
        if (($this->getDia() + $numDia) > 30) {
            $this->incrementarMes(1);
            $this->setDia(1);
        } else {
            $incDia = $this->getDia() + $numDia;
            $this->setDia($incDia);
        }
    }

    private function sumarDiasAFebrero($numDia)
    {
        if ($this->bisiesto()) {
            if (($this->getDia() + $numDia) > 29) {
                $this->incrementarMes(1);
                $this->setDia(1);
            } else {
                $incDia = $this->getDia() + $numDia;
                $this->setDia($incDia);
            }
        } else {
            if (($this->getDia() + $numDia) > 28) {
                $this->incrementarMes(1);
                $this->setDia(1);
            } else {
                $incDia = $this->getDia() + $numDia;
                $this->setDia($incDia);
            }
        }
    }


    public function incrementaUnDia($n)
    {
        $mesActual = $this->getMes();
        for ($i = 0; $i < $n; $i++) {
            if ($mesActual == 1 || $mesActual == 3 || $mesActual == 5 || $mesActual == 7 || $mesActual == 8 || $mesActual == 10 || $mesActual == 12) {
                $this->sumarDiasA31(1);
            } elseif ($mesActual == 4 || $mesActual == 6 || $mesActual == 9 || $mesActual == 11) {
                $this->sumarDiasA30(1);
            } else {
                $this->sumarDiasAFebrero(1);
            }
        }
    }

    
    public function incrementarMes($m)
    {
        if (($this->getMes() + $m) > 12) {
            $this->incrementarAnio(1);
            $incMes = 1;
            $this->setMes($incMes);
        } else {
            $incMes = $this->getMes() + $m;
            $this->setMes($incMes);
        }
    }

    public function incrementarAnio($anio)
    {
        $incAnio = $this->getAnio() + $anio;
        $this->setAnio($incAnio);
    }


    //metodo toString de la clase
    public function __toString(){
        $cadena ="La fecha es: \n-Forma abreviada: " .$this->getDia(). "/". $this->getMes()."/".$this->getAnio().
                 "\n -Forma extendida: " .$this->getDia(). " de " .$this->formaExtendida(). " del " .$this->getAnio();
        return $cadena;
    }
}
?>
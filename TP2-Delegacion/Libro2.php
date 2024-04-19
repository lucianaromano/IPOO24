<?php
//una clase Libro que tenga los atributos ISBN, titulo, año de edición, editorial, nombre y apellido del autor
class Libro {
    private $ISBN;
    private $titulo;
    private $anio;
    private $editorial;
    private $autor;  //nombre y apellido del autor
    private $cantPaginas;
    private $sinopsis;

    public function __construct($ISBN,$t,$a,$e,$objPersona,$cantPag,$s){
        $this->ISBN=$ISBN;
        $this->titulo=$t;
        $this->anio=$a;
        $this->editorial=$e;
        $this->autor=$objPersona;
        $this->cantPaginas=$cantPag;
        $this->sinopsis=$s;
    }

    public function getISBN(){
        return $this->ISBN;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getAnio(){
        return $this->anio;
    }

    public function getEditorial(){
        return $this->editorial;
    }

    public function getAutor(){
        return $this->autor;
    }

    public function getCantPaginas(){
        return $this->cantPaginas;
    }

    public function getSinopsis(){
        return $this->sinopsis;
    }

    public function setISBN($ISBN){
        $this-> ISBN=$ISBN;
    }

    public function setTitulo($t){
        $this-> titulo=$t;
    }

    public function setAnio($a){
        $this-> anio=$a;
    }
    public function setEditorial($e){
        $this-> editorial=$e;
    }
    public function setAutor($objPersona){
        $this-> autor=$objPersona;
    }

    public function setCantPaginas($cantPag){
        $this-> cantPaginas=$cantPag;
    }
    public function setSinopsis($s){
        $this-> sinopsis=$s;
    }
    public function __toString()   {
        $cadena="Datos del libro: 
                \n ISBN: ".$this->getISBN().
                "\n Titulo: ".$this->getTitulo().
                "\n Año de edicion: ".$this->getAnio().
                "\n Editorial: ".$this->getEditorial().
                "\n Autor: " .$this->getAutor().
                "\n Cantidad de paginas: ".$this->getCantPaginas().
                "\n Sinopsis del libro: ".$this->getSinopsis();
        return $cadena; 
    }

    //perteneceEditorial($peditorial): indica si el libro pertenece a una editorial dada. Recibe como parámetro
    //una editorial y devuelve un valor verdadero/falso.
    public function perteneceEditorial($peditorial){
        $editorial=$this->getEditorial();
        if ($peditorial ==$editorial) {
            $respuesta = true;
        }else {
            $respuesta = false;
        }
        return $respuesta;
    }

    //aniosdesdeEdicion(): método que retorna los años que han pasado desde que el libro fue editado.
    public function aniosDesdeEdicion(){
        $anioActual = 2024;
        $anioEdicion = $this->getAnio();
        $anios= $anioActual - $anioEdicion;
        return $anios; 
     }

}

?>
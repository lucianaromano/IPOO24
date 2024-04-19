<?php
class Lectura {
    private $libro;
    private $pagina;

    public function __construct($objLibro,$pag)
    {
        $this-> libro = $objLibro;
        $this->pagina= $pag;
        //$this->colObjLibros=$colObjLibros;
    }

    public function getLibro() {
        return $this->libro;
    }
    public function getPagina() {
        return $this-> pagina;
    }
    public function setLibro($objLibro){
        $this->libro=$objLibro;
    }
    public function setPagina($pag){
        $this->pagina=$pag;
    }

    //siguientePagina(): método que retorna la página del libro y actualiza la variable que contiene la pagina actual.
    public function siguientePagina(){
        $paginaLibro=$this->getPagina();
        $paginaLibro= $this->setPagina($paginaLibro);
        return $paginaLibro;
    }

    //retrocederPagina(): método que retorna la página anterior a la actual del libro y actualiza su valor.
    public function retrocederPagina(){
        $pagina=$this->getPagina();
        $paginaAnterior= ($pagina - (1));
        $this->setPagina($paginaAnterior);
        return $paginaAnterior;
    }

    //irPagina(x): método que retorna la página actual y setea como página actual al valor recibido por parámetro.
    public function irPagina($pag){
        $paginaActual = $this->getPagina();
        $paginaActual= $this->setPagina($pag);
        return $paginaActual;
    }

    public function __toString(){
        $cadena= "Datos del libro: ". $this->getLibro(). 
        "\n Pagina: ".$this->getPagina();
        return $cadena;
    }

    //libroLeido($titulo): retorna true si el libro cuyo título recibido por parámetro se encuentra dentro del
    //conjunto de libros leídos y false en caso contrario.

    //darSinopsis($titulo): retorna la sinopsis del libro cuyo título se recibe por parámetro.
    public function darSinopsis($titulo){
       //for para recorrer el arreglo y endonde encuentre el titulo recibido $colObjLibros [$i] = $titulo;
        $sinopsis = $this->getSinopsisLibro("Libro");
        return $sinopsis;
    }
    //leidosAnioEdicion($x): que retorne todos aquellos libros que fueron leídos y su año de edición es un
    //año X recibido por parámetro
}   



?>
<?php
include_once 'Libro.php';
//cree al menos tres objetos libros e invoque a cada uno de los métodos implementados en la clase Libro. 
$libro= new Libro (540,"El señor de los anillos", 1954, "Alan Lee", "J.R. Tolkien");
$libro2= new Libro (1161, "El padrino",1969 ,"G. P. Putnam's Sons","Mario Puzo");
$libro3= new Libro (1020, "El principito",1943, "Berenice","Antoine de Saint-Exupéry");
echo $libro;

if($libro->perteneceEditorial("V&R")){
    echo "\n Este libro pertenece a la editorial \n";
}else{
    echo "\n Este libro no pertenece a la editorial \n";
}

$anios=$libro->aniosDesdeEdicion();
echo "\n Los años que han pasado desde la edicion de este libro son: " .$anios;

// iguales($plibro,$parreglo): dada una colección de libros, indica si el libro pasado por parámetro ya se encuentra en dicha colección.
//public function iguales ($pLibro,$parreglo){}

    //defina el método librodeEditoriales($arreglolibros, $peditorial): método que retorna un arreglo asociativo
//con todos los libros publicados por la editorial dada.

?>
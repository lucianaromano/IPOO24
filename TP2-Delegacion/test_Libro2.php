<?php
include_once 'Libro2.php';
include_once 'Persona.php';
//cree al menos tres objetos libros e invoque a cada uno de los métodos implementados en la clase Libro.
$persona= new Persona ("Luciana","Romano","DNI",42604817 );
$persona2= new Persona("Nahuel","Ruiz","DNI", 40443386);
$persona3= new Persona ("Olivia","Ruiz Romano", "DNI", 59118307); 
$libro= new Libro (540,"El señor de los anillos", 1954, "Alan Lee",$persona,"3156","Entretenido");
$libro2= new Libro (1161, "El padrino",1969 ,"G. P. Putnam's Sons",$persona2,"1026","Horror");
$libro3= new Libro (1020, "El principito",1943, "Berenice",$persona3 , "350","Ternura ");
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
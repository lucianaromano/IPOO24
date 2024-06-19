-- Active: 1717619825238@@127.0.0.1@3306
<?php
include_once 'BaseDatos.php';
class Empresa{
    private $idEmpresa;
    private $enombre;
    private $edireccion;
    private $mensajeoperacion;

    public function __construct(){
        $this->idEmpresa = '';
        $this->enombre = '';
        $this->edireccion = '';
        $this->mensajeoperacion = '';
    }

    public function cargar($idEmpresa,$enombre, $edireccion){
        $this->setIdEmpresa(($idEmpresa));
        $this->setEnombre($enombre);
        $this->setEdireccion($edireccion);
    }

    public function getIdEmpresa(){
        return $this->idEmpresa;
    }

    public function setIdEmpresa($idEmpresa){
        $this->idEmpresa = $idEmpresa;
    }

    public function getEnombre(){
        return $this->enombre;
    }

    public function setEnombre($enombre){
        $this->enombre = $enombre;
    }

    public function getEdireccion(){
        return $this->edireccion;
    }

    public function setEdireccion($edireccion){
        $this->edireccion = $edireccion;
    }
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }
    public function __toString(){
        return  "ID Empresa: " . $this->getIdEmpresa() .
                "\nNombre: " . $this->getEnombre() .
                "\nDireccion: " . $this->getEdireccion() . "\n";
    }

    //funciones bd

    public function buscar($id){
        $base = new BaseDatos();
        $consulta = "SELECT * FROM empresa WHERE idempresa= " . $id;
        $rta = false;
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                if($row2 = $base->Registro()){
                    $this->setIdempresa($row2['idempresa']);
                    $this->setEnombre($row2['enombre']);
                    $this->setEdireccion($row2['edireccion']);
                    $rta = true;
                }
            }else{
                $this->setMensajeoperacion($base->getError());
            }
        }else{
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }

    public static function listar($condicion = ""){
        $array = null;
        $base = new BaseDatos();
        $consulta = "Select * from empresa ";
        if($condicion != ''){
            $consulta = $consulta . ' where ' . $condicion;
        }
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $array = array();
                while($row2 = $base->Registro()){
                    $idempresa = $row2['idempresa'];
                    $enombre = $row2['enombre'];
                    $edireccion = $row2['edireccion'];

                    $empresa = new Empresa();
                    $empresa->cargar($idempresa, $enombre, $edireccion);
                    array_push($array, $empresa);
                }
            }else{
                Empresa::setMensajeoperacion($base->getError());
            }
        }else{
            Empresa::setMensajeoperacion($base->getError());
        }
        return $array;
    }

    public function insertar(){
        $base = new BaseDatos();
        $rta = false;
        $consultaInsertar = "INSERT INTO empresa(idempresa,enombre, edireccion) 
                    VALUES('{$this->getIdempresa()},'{$this->getEnombre()}', '{$this->getEdireccion()}')";
        if($base->Iniciar()){
            if($base->Ejecutar($consultaInsertar)){
                $rta = true;
            }else{
                $this->setMensajeoperacion($base->getError());    
            }
        }else{
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }

    public function modificar(){
        $rta = false;
        $base = new BaseDatos();
        $consulta = "UPDATE empresa SET enombre = '{$this->geteNombre()}', edireccion = '{$this->getEdireccion()}'
                     WHERE idempresa = {$this->getIdempresa()}";
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $rta = true;
            }else{
                $this->setMensajeoperacion($base->getError());
            }
        }else{
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }

    public function eliminar(){
        $base = new BaseDatos();
        $rta = false;
        $consulta = "DELETE FROM empresa WHERE idempresa = " . $this->getIdempresa();
        if($base->Iniciar()){
            if($base->Ejecutar($consulta)){
                $rta = true;
            }else{
                $this->setMensajeoperacion($base->getError());
            }
        }else{
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }

}
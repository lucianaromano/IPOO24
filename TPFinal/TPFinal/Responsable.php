<?php

include_once 'Persona.php';
include_once 'BaseDatos.php';
/**registra el número de empleado, número de licencia, nombre y apellido. */
class Responsable extends Persona
{
    private $rnumeroEmpleado;
    private $rnumerolicencia;
    private $mensajeoperacion;

    public function __construct()
    {
        parent::__construct(); //llama al constructor de la clase padre
        $this->rnumeroEmpleado = "";
        $this->rnumerolicencia = "";
    }
    /*
    public function cargar ($idpersona,$ndoc,$nom,$ape,$tel,$rnumeroEmpleado=null,$rnumerolicencia=null){
        parent::cargar($idpersona,$ndoc,$nom,$ape,$tel);
        if($rnumeroEmpleado != null){
            $this->setRnumeroempleado($rnumeroEmpleado);
        }
        if($rnumerolicencia != null){
            $this->setRnumerolicencia($rnumerolicencia);
        }
    }*/

    //con un arreglo asociativo
    public function cargar($datosPersona){
        parent::cargar($datosPersona);
        $this->setRnumeroEmpleado($datosPersona['rnumeroempleado']);
        $this->setRnumerolicencia($datosPersona['rnumerolicencia']);
    }

    public function getRnumeroEmpleado()
    {
        return $this->rnumeroEmpleado;
    }

    public function setRnumeroEmpleado($rnumeroEmpleado)
    {
        $this->rnumeroEmpleado = $rnumeroEmpleado;
    }

    public function getRnumerolicencia()
    {
        return $this->rnumerolicencia;
    }

    public function setRnumerolicencia($rnumerolicencia)
    {
        $this->rnumerolicencia = $rnumerolicencia;
    }

    public function getMensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function __toString()
    {
        return  parent:: __toString() .
            "N° Empleado: " . $this->getRnumeroEmpleado() . "  |  " .
            "N° Licencia: " . $this->getRnumerolicencia() . "  |  " ;
    }

    //funciones 
    
    /**
     * Recupera los datos de un responsable por id
     * @param int $id_funcion
     * @return boolean $resp
     */
    public function buscar($id)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM responsable WHERE rnumeroempleado= " . $id;
        $rta = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    parent::buscar($id);
                    $this->setRnumeroEmpleado($row2['rnumeroempleado']);
                    $this->setRnumerolicencia($row2['rnumerolicencia']);
                    $rta = true;
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }

    /**
     * Lista todos los responsables que cumplen con una condicion dada
     * @param String $condicion
     * @return Array $arregloResponsable
     */
    public function listar($condicion = '')
    {
        $arregloResponsable = null;
        $base = new BaseDatos();
        $consulta = "SELECT * FROM responsable";
        if ($condicion != '') {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        $consulta .= " order by rnumeroempleado ";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arregloResponsable = array();
                while ($row2 = $base->Registro()) {
                    $responsable = new Responsable();
                    $responsable -> Buscar ($row2['idpersona']);
                    array_push($arregloResponsable,$responsable);
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $arregloResponsable;
    }

    /**
     * Inserta una instancia en la tabla responsable
     * @return boolean $resp
     */
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;

        if (parent::insertar()) {
            $consultaInsertar = "INSERT INTO responsable(idpersona, rnumeroempleado, rnumerolicencia)
                                VALUES (" . parent::getIdpersona() . ", '" . $this->getRnumeroEmpleado() . "', " . $this->getRnumerolicencia() . ")";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaInsertar)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        }
        return $resp;    
    }

    /**
     * Modifica una instancia en la tabla responsable
     * @param
     * @return boolean $resp
     */
    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        if (parent::modificar()) {
            $consultaModifica = "UPDATE responsable SET rnumeroempleado = '" . $this->getRnumeroEmpleado() . "', rnumerolicencia = " . $this->getRnumerolicencia() . "WHERE idpersona = " . parent::getIdpersona();
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaModifica)) {
                    $resp = true;
                } else {
                    $this->setMensajeoperacion($base->getError());
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        }
        return $resp;
    }

    /**
     * Elimina una instancia de la tabla musical
     * @param
     * @return boolean $resp
     */
    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM responsable WHERE idpersona=" . parent::getIdPersona();
            if ($base->Ejecutar($consultaBorra)) {
                if (parent::eliminar()) {
                    $resp = true;
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $resp;
    }
}

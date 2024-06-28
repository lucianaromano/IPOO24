<?php

include_once 'BaseDatos.php';

class Persona
{
    private $idpersona;
    private $pnrodoc;
    private $pnombre;
    private $papellido;
    private $ptelefono;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->idpersona = 0;
        $this->pnrodoc= "";
        $this->pnombre = "";
        $this->papellido = "";
        $this->ptelefono = "";
    }

    /*public function cargar($idpersona, $ndoc, $nom, $ape, $tel){
        $this->setIdpersona($idpersona);
        $this->setPnrodoc($ndoc);
        $this->setPnombre($nom);
        $this->setPapellido($ape);
        $this->setPtelefono($tel);
    }
    */
    public function cargar($datosPersona){
        $this->setIdPersona($datosPersona['idpersona']);
        $this->setPnrodoc($datosPersona['pnrodoc']);
        $this->setPnombre($datosPersona['pnombre']);
        $this->setPapellido($datosPersona['papellido']);
        $this->setPtelefono($datosPersona['ptelefono']);
        }

    public function getIdpersona()
    {
        return $this->idpersona;
    }

    public function setIdpersona($idpersona)
    {
        $this->idpersona = $idpersona;
    }

    public function getPnrodoc()
    {
        return $this->pnrodoc;
    }

    public function setPnrodoc($doc)
    {
        $this->pnrodoc = $doc;
    }

    public function getPnombre()
    {
        return $this->pnombre;
    }

    public function setPnombre($pnombre)
    {
        $this->pnombre = $pnombre;
    }

    public function getPapellido()
    {
        return $this->papellido;
    }

    public function setPapellido($papellido)
    {
        $this->papellido = $papellido;
    }

    public function getPtelefono()
    {
        return $this->ptelefono;
    }

    public function setPtelefono($ptelefono)
    {
        $this->ptelefono = $ptelefono;
    }

    public function getMensajeOperacion()
    {
        return $this->mensajeoperacion;
    }
    public function setMensajeOperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    /**
     * Recupera los datos de una persona por su id 
     * @param int $id
     * @return true en caso de encontrar los datos, false en caso contrario
     */
    public function buscar($id)
    {
        $base = new BaseDatos();
        $consulta = "SELECT * FROM persona WHERE idpersona= " . $id;
        $rta = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdpersona($row2['idpersona']);
                    $this->setPnrodoc($row2['pnrodoc']);
                    $this->setPnombre($row2['pnombre']);
                    $this->setPapellido($row2['papellido']);
                    $this->setPtelefono($row2['ptelefono']);
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
     * Lista los datos de todas las personas que cumplen con una condicion
     * @param String $condicion
     * @return Array $arregloPersona
     */
    public function listar($condicion = "")
    {
        $arregloPersona = null;
        $base = new BaseDatos();
        $consultaPersonas = "Select * from persona ";
        if ($condicion != "") {
            $consultaPersonas = $consultaPersonas . ' where ' . $condicion;
        }
        $consultaPersonas .= " order by apellido ";
    
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaPersonas)) {
                $arregloPersona = array();
                while ($row2 = $base->Registro()) {
                    $id = $row2['idpersona'];
                    $nrodoc = $row2['pnrodoc'];
                    $nombre = $row2['pnombre'];
                    $apellido = $row2['papellido'];
                    $tel = $row2['ptelefono'];

                    $persona = new Persona();
                    $persona->cargar($id, $nrodoc, $nombre, $apellido, $tel);
                    array_push($arregloPersona, $persona);
                }
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $arregloPersona;
    }

    /**
     * Inserta una nueva instancia en la tabla persona
     * @param
     * @return boolean $resp
     */
    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO persona( pnombre)
				VALUES ('" . $this->getPnombre() . "')";
        // $consultaInsertar = "INSERT INTO persona(pnrodoc, pnombre, papellido, ptelefono)
		// 		VALUES (" . $this->getPnrodoc() . ",'" . $this->getPnombre() . "','" . $this->getPapellido() . "','" . $this->getPtelefono() . "')";

        if ($base->Iniciar()) {

            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setIdPersona($id);
                $resp = true;
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function modificar()
    {
        $resp = false;
        $base = new BaseDatos();
        $consultaModifica = "UPDATE persona SET papellido='" . $this->getPapellido() . "',pnombre='" . $this->getPnombre() . "'
                           ,ptelefono='" . $this->getPtelefono() . "',pnrodoc=" . $this->getPnrodoc() . " WHERE idpersona = " . $this->getIdPersona();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $resp;
    }

    public function eliminar()
    {
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM persona WHERE pnrodoc=" . $this->getPnrodoc();
            if ($base->Ejecutar($consultaBorra)) {
                $resp = true;
            } else {
                $this->setMensajeoperacion($base->getError());

            }
        } else {
            $this->setMensajeoperacion($base->getError());

        }
        return $resp;
    }

    public function __toString()
    {
        return  "\nID: "  . $this->getIdpersona() .  "  |  " . "Nombre: " . $this->getPnombre() . "  |  ".
                "Apellido:" . $this->getPapellido() . "  |  ".
                "DNI: " . $this->getPnrodoc() . "  |  ".
                "Telefono: " . $this->getPtelefono();

    }




}

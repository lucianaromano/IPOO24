<?php
include_once 'BaseDatos.php';
/**El viaje ahora contiene una referencia a una colección de objetos de la clase Pasajero.
 *  La clase Viaje debe hacer referencia al responsable de realizar el viaje.*/

class Viaje
{
    private $idViaje;
    private $vdestino;
    private $vcantMaxPasajeros;
    private $vcolPasajeros;
    private $rnumeroEmpleado; //obj responsable
    private $vimporte;
    private $idEmpresa; //objeto empresa
    private $mensajeOperacion;



    //metodo constructor de la clase
    public function __construct()
    {
        $this->idViaje = '';
        $this->vdestino = '';
        $this->vcantMaxPasajeros = '';
        $this->vcolPasajeros = [];
        $this->rnumeroEmpleado = null;
        $this->idEmpresa = null;
        $this->vimporte = '';
        $this->mensajeOperacion = '';
    }

    public function getIdViaje()
    {
        return $this->idViaje;
    }

    public function setIdViaje($cod)
    {
        $this->idViaje = $cod;
    }

    public function getVdestino()
    {
        return $this->vdestino;
    }

    public function setVdestino($dest)
    {
        $this->vdestino = $dest;
    }

    public function getVcantMaxPasajeros()
    {
        return $this->vcantMaxPasajeros;
    }

    public function setVcantMaxPasajeros($cantMax)
    {
        $this->vcantMaxPasajeros = $cantMax;
    }

    public function getVcolPasajeros()
    {
        return $this->vcolPasajeros;
    }

    public function setVcolPasajeros($vcolPasajeros)
    {
        $this->vcolPasajeros = $vcolPasajeros;
    }

    public function getRnumeroempleado()
    {
        return $this->rnumeroEmpleado;
    }

    public function setRnumeroempleado($rnumeroEmpleado)
    {
        $this->rnumeroEmpleado = $rnumeroEmpleado;
    }


    public function getMensajeOperacion()
    {
        return $this->mensajeOperacion;
    }

    public function setMensajeOperacion($nuevo)
    {
        $this->mensajeOperacion = $nuevo;
    }

    public function getVimporte()
    {
        return $this->vimporte;
    }
    public function setVimporte($vimporte)
    {
        $this->vimporte = $vimporte;
    }

    public function getIdEmpresaObj()
    {
        return $this->idEmpresa;
    }
    public function setIdEmpresa($idEmpresa)
    {
        $this->idEmpresa = $idEmpresa;
    }

    /**
     * Retorna la coleccion de funciones en forma de cadena de caracteres
     */
    private function funcionesAString()
    {
        //Array Funcion $arreglo
        //String $retorno
        $retorno = "";
        $arreglo = $this->getVcolPasajeros();
        foreach ($arreglo as $i) {
            $retorno .= $i . "\n";
            $retorno .= "----------------------------------------------------------------------\n";
        }
        return $retorno;
    }
    //toString
    public function __toString()
    {
        // return "----------------------------------
        //     ID: " . $this->getIdViaje() .
        //     "\nvDestino: " . $this->getVdestino() .
        //     "\nCantidad maxima de pasajeros: " . $this->getVcantMaxPasajeros() .
        //     "\nPasajeros: \n" . $this->funcionesAString() .
        //     "\nEmpleado Responsable: \n" . $this->getRnumeroEmpleado() .
        //     "\nImporte: $" . $this->getVimporte() .
        //     "\nEmpresa: " . $this->getIdEmpresaObj() . "\n";

        return  "ID viaje: " . $this->getIdViaje() . "\n" .
            "Empresa: " . $this->getIdEmpresaObj() .
            "\nDestino: " . $this->getVdestino() . "  |  " .
            "Cantidad maxima de pasajeros: " . $this->getVcantMaxPasajeros() . "  |  " .
            "Importe: " . $this->getVimporte() . "\nPasajeros: " . $this->funcionesAString() . 
            "\nEmpleado Responsable: " . $this->getRnumeroEmpleado() . " \n ";
    }

    //FUNCIONES BD
    public function cargar($idViaje, $vdestino, $vcantMaxPasajeros, $rnumeroEmpleado, $vimporte, $idEmpresa)
    {
        $this->setIdViaje($idViaje);
        $this->setVdestino($vdestino);
        $this->setVcantMaxPasajeros($vcantMaxPasajeros);
        $this->setRnumeroempleado($rnumeroEmpleado);
        $this->setVimporte($vimporte);
        $this->setIdEmpresa($idEmpresa);
    }

    public function Buscar($id)
    {
        $base = new BaseDatos();
        $rta = false;
        $consulta = "SELECT * FROM Viaje WHERE idviaje= " . $id;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdViaje($row2['idviaje']);
                    $this->setvDestino($row2['vdestino']);
                    $this->setvcantMaxPasajeros($row2['vcantmaxpasajeros']);
                    // $pasajero = new Pasajero();
                    // $pasajero->buscar($row2['pdocumento']);
                    // $this->setvcolPasajeros($pasajero);

                    // $responsable = new Responsable();
                    // $responsable->buscar($row2['rnumeroempleado']);
                    // $this->setRnumeroempleado($responsable);

                    $this->setRnumeroempleado($row2['rnumeroempleado']);
                    $this->setVimporte($row2['vimporte']);
                    $this->setIdEmpresa($row2['idempresa']);
                    $rta = true;
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $rta;
    }

    /**Lista todas los viajes que cumplen con cierta condicion 
     * @param void 
     * @return array 
     */
    public function listar($condicion = "")
    {
        $arrayViaje = null;
        $base = new BaseDatos();
        $consultaViajes = "SELECT * from viaje ";
        if ($condicion != "") {
            $consultaViajes = $consultaViajes . ' where ' . $condicion;
        }
        $consultaViajes .= " order by idviaje ";

        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaViajes)) {
                $arrayViaje = array();
                while ($row2 = $base->Registro()) {
                    $objEmpresa = new Empresa();
                    $objEmpresa->Buscar($row2['idempresa']);
                    $objResponsable = new Responsable();
                    $objResponsable->Buscar($row2['rnumeroempleado']);
                    $idviaje = $row2['idviaje'];
                    $vdestino = $row2['vdestino'];
                    $vcantMaxPasajeros = $row2['vcantmaxpasajeros'];
                    $vimporte = $row2['vimporte'];

                    $viaje = new Viaje();
                    $viaje->cargar($idviaje, $vdestino, $vcantMaxPasajeros, $objResponsable, $vimporte, $objEmpresa);
                    array_push($arrayViaje, $viaje);
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $arrayViaje;
    }

    public function insertar()
    {
        $base = new BaseDatos();
        $rta = false;
        $responsable = $this->getRnumeroempleado();
        $empresa = $this->getIdEmpresaObj();

        $consultaInsertar = "INSERT INTO viaje(vdestino, vcantMaxPasajeros, rnumeroEmpleado, vimporte, idempresa)
                            VALUES ('" . $this->getVdestino() . "','" . $this->getVcantMaxPasajeros() . "','" . $responsable->getRnumeroempleado() . "','" . $this->getVimporte() . "','" . $empresa->getIdEmpresa() . "')";

        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setIdViaje($id);
                $rta = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }

    public function modificar()
    {
        // Obtén los valores necesarios
        $objEmpresa = $this->getIdEmpresaObj();
        // echo "ACA ESTOY";
        // echo $objEmpresa;
        // $idEmpresa = $objEmpresa->getIdEmpresa();

        // echo $idEmpresa;
        $objResponsable = $this->getRnumeroempleado();
        // $numResponsable = $objResponsable->getNumEmpleado();

        $rnumeroempleado = $this->getRnumeroempleado();
        $idViaje = $this->getIdViaje();
        $vdestino = $this->getVdestino();
        $vcantMaxPasajeros = $this->getVcantMaxPasajeros();
        $vimporte = $this->getVimporte();

        // echo "ACA ESTOY";
        // echo $idViaje;

        // // Asegúrate de que $rnumeroempleado sea un objeto de la clase Responsable
        // if ($rnumeroempleado instanceof Responsable) {
        //     $num = $rnumeroempleado->getRnumeroEmpleado();
        // } else {
        //     // Manejar el error si $rnumeroempleado no es un objeto de la clase Responsable
        //     echo "Error: rnumeroempleado no es un objeto de la clase Responsable\n";
        //     return false;
        // }

        // // Imprime el número de empleado para depuración
        // echo "EMPLEADO: $num\n";

        // Construye la consulta SQL
        $rta = false;
        $base = new BaseDatos();
        $consulta = "UPDATE viaje 
                     SET vdestino = '$vdestino', 
                         vcantmaxpasajeros = $vcantMaxPasajeros, 
                         rnumeroempleado = $objResponsable, 
                         idempresa = $objEmpresa,
                         vimporte = $vimporte 
                     WHERE idviaje = $idViaje";

        // Imprime la consulta SQL para depuración
        echo "Consulta SQL: $consulta\n";

        // Ejecuta la consulta SQL
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $rta = true;
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }

    public function eliminar()
    {
        $base = new BaseDatos();
        $rta = false;
        $consultaElimina = "DELETE FROM viaje WHERE idviaje = " . $this->getIdviaje();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaElimina)) {
                $rta = true;
            } else {
                $this->setMensajeoperacion($base->getError());
            }
        } else {
            $this->setMensajeoperacion($base->getError());
        }
        return $rta;
    }
}

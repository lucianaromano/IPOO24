<?php
class Banco{
    
    private $coleccionMostrador;
    
    public function __construct($coleccionMostrador){
        $this -> coleccionMostrador = $coleccionMostrador;
    }
    
    // METODOS DE ACCESO GET
    
    public function getColeccionMostrador (){
        return $this -> coleccionMostrador;
    }
    
    // METODOS DE ACCESO SET
    
    public function setColeccionMostrador (){
        return $this -> coleccionMostrador;
    }
    
    /**
     * Permite generar un arreglo con los mostradores que atienden un determinado tramite.
     * @param string $unTramite
     * @return array
     */
    
    public function mostradoresAtiendenTramite( $unTramite){
        // ARRAY $coleccionMostradoresAtiendenTramite, ARRAY $coleccionMostrador
        
            $coleccionMostradoresAtiendenTramite = array ();
            $coleccionMostrador = $this -> getColeccionMostrador();
            foreach ($coleccionMostrador as $mostrador){
                if ($mostrador-> atiende($unTramite)){
                    array_push($coleccionMostradoresAtiendenTramite, $mostrador);
                }
            }
            return $coleccionMostradoresAtiendenTramite;
    }
    
    /**
     * Indica que numero de mostrador es mas rapido para atender un determinado tramite
     * @param string $unTramite
     * @return int
     */
        
        public function mostradorMasRapido($unTramite){
            //INT $nroMenorClientes, INT $nroMostradorMasRapido, ARRAY $coleccionMostrador, OBJ $cola.
            $nroMostradorMasRapido = null;
            $coleccionMostradorAtiendenTramite = $this -> mostradoresAtiendenTramite($unTramite);
            $nroMenorClientes = 220;
            
            foreach ($coleccionMostradorAtiendenTramite as $mostrador){
                
                    $cola = $mostrador -> getObjCola();
                    $cantClienteActual = $cola -> getCantActualClientes();
                    $cantMaxCliente = $cola -> getCantMaxClientes();
                    
                    if ($cantClienteActual < $nroMenorClientes){
                        if ($cantClienteActual < $cantMaxCliente){
                        $nroMenorClientes = ($cola -> getCantActualClientes());
                        $nroMostradorMasRapido = $mostrador -> getNroMostrador();
                        }
                    }
            }             
            return $nroMostradorMasRapido;
        }
        
        /**
         * Permite ubicar al cliente en un mostrador que atienda el tramite que el cliente desea, tenga espacio y la menor cantidad posible de clientes esperando.
         * @param object $unCliente
         * @return NULL|number
         */
        
        public function atender($unCliente){
            //OBJ $tramiteCliente, $colaActual, $objMostrador
            //STRING $tipoTramite, 
            //ARRAY $colMostAtienden
            //INT $i, $numMostrador, $mostradorAsign
            //BOOLEAN $encontrado
            
            
            $tramiteCliente = $unCliente -> getTramite(); //ref obj tramite
            $tipoTramite = $tramiteCliente -> getTipoTramite();
            $nroMostradorAAsignar = $this -> mostradorMasRapido($tipoTramite);
            
            if ($nroMostradorAAsignar <> null){
                $encontrado = false;
                $i=0;
                $arregloMostradoresAtienden = $this -> mostradoresAtiendenTramite($tipoTramite);
                while ((!$encontrado)&&$i<count($arregloMostradoresAtienden)){
                    $objMostrador = $arregloMostradoresAtienden[$i];
                    $numMostrador = $objMostrador -> getNroMostrador();
                    if ($numMostrador==$nroMostradorAAsignar){
                        $encontrado = true;
                        $colaActual = $objMostrador -> getObjCola();
                        $arregloClienteCola = $colaActual -> getColClientes();
                        array_push($arregloClienteCola, $unCliente);
                        $cantActualCliente = $colaActual -> getCantActualClientes();
                        $colaActual -> setCantActualClientes($cantActualCliente+1);
                    }
                    $i++;
                }
            }else{
                $nroMostradorAAsignar = null;
            }
            
            
            return $nroMostradorAAsignar;
        }
}


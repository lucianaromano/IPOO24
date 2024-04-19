<?php
class Cola{
    private $cantMaxClientes;
    private $cantActualClientes;
    private $colClientes;

    public function __construct ($cantMaxClientes,$cantActualClientes,$colClientes){
        $this->cantMaxClientes=$cantMaxClientes;
        $this->cantActualClientes=$cantActualClientes;
        $this->colClientes=$colClientes;
    }
    //METODOS DE ACCESO GET
    public function getCantMaxClientes(){
        return $this->cantMaxClientes;
    }
    public function getCantActualClientes(){
        return $this->cantActualClientes;
    }

    public function getColClientes(){
        return $this->colClientes;
    }
    //METODOS DE ACCESO SET
    public function setCantMaxClientes($cantMax){
        $this->cantMaxClientes=$cantMax;
    }
    public function setCantActualClientes($cantAct){
        $this->cantActualClientes=$cantAct;
    }
    public function setColClientes($colClientes){
        $this->colClientes=$colClientes;
    }

    //METODO TOSTRING DE LA CLASE
    public function __toString()
    {
        $infoCola="Cantidad maxima de clientes: ".$this->getCantMaxCliente() .
                "\n Cantidad actual de clientes: ".$this->getCantActualClientes().
                "\n Clientes en la cola: ".$this->getColClientes();
                for ($i=0;$i<count($this -> getColClientes());$i++){
                $infoCola = $infoCola . "\n\nCliente n� " .  ($i+1) . " " . $this -> getColClientes()[$i];
        return $infoCola;
        }   
    }
    
}
?>
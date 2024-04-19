<?php
class Disquera {
    private $horaDesde;
    private $horaHasta;   //horario atencion 
    private $estado; //abierto o cerrado
    private $direccion;
    private $duenio;

    public function __construct($inicio,$cierre,$e,$dire,$objPersona){
        $this->horaDesde=$inicio;
        $this->horaHasta=$cierre;
        $this->estado=$e;
        $this->direccion=$dire;
        $this->duenio=$objPersona;
    }

    public function getHoraDesde(){
        return $this->horaDesde;
    }

    public function getHoraHasta(){
        return $this->horaHasta;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function getDireccion(){
        return $this->direccion;
    }

    public function getDuenio(){
        return $this->duenio;
    }

    public function setHoraDesde($inicio){
        $this->horaDesde=$inicio;
    }
    
    public function setHoraHasta($cierre){
        $this->horaHasta=$cierre;
    }
    
    public function setEstado($e){
        $this->estado=$e;
    }
    
    public function setDireccion($dire){
        $this->direccion=$dire;
    }
    
    public function setDuenio($objPersona){
        $this->duenio=$objPersona;
    }

    /**c) dentroHorarioAtencion($hora,$minutos): 
     * que dada una hora y minutos retorna true si la tienda debe encontrarse abierta en ese horario y false en caso contrario.
    * @param int $hora
    * @param  float $minutos
    * @return boolean
    */
    public function dentroHorarioAtencion($hora,$minutos){
        $horaInicio=$this->getHoraDesde();
        $horaCierre=$this->getHoraHasta();
        $horario = $hora + $minutos;
        if (($horario >=$horaInicio) && ($horario< $horaCierre) ){
            $respuesta = true;
        } else {
            $respuesta = false;
        }
        return $respuesta;
    }
    //abrirDisquera($hora,$minutos): que dada una hora y minutos corrobora que se encuentra dentro del
    //horario de atención y cambia el estado de la disquera solo si es un horario válido para su apertura.
    public function abrirDisquera ($hora,$minutos){
        $horaInicio=$this->getHoraDesde();
        $horaCierre=$this->getHoraHasta();
        $horario = $hora + $minutos;
        //$estado = "Abierto";
        if (($horario >= $horaInicio) && ($horario<$horaCierre)){
            $estado = $this->setEstado("Abierto");
        } else {
            $estado = $this->getEstado();
        }
        return $estado;
    }
    
    //cerrarDisquera($hora,$minutos): que dada una hora y minutos corrobora que se encuentra fuera del
    //horario de atención y cambia el estado de la disquera solo si es un horario válido para su cierre.
    public function cerrarDisquera ($hora,$minutos){
        $estado = "Cerrado";
        if ($this->dentroHorarioAtencion($hora,$minutos) == false){
            $estado = $this->setEstado ("Cerrado");
        }else {
            $estado = $this->getEstado();
        } return $estado;
    }
    //metodo to string: paso los atributos de la clase a una cadena de caracteres
    public function __toString()
    {
        return "Horario apertura: " .$this-> getHoraDesde()."\n".
                "Horario cierre: " .$this-> getHoraHasta()."\n".
                "Estado: " .$this-> getEstado()."\n".
                "Direccion: " .$this-> getDireccion()."\n".
                "Dueño Disquera: " .$this-> getDuenio()."\n";

    }







}
?>
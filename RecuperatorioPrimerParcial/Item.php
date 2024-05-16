<<<<<<< HEAD
<?php

/**En la clase ítem: Se registra la cantidad vendida y la referencia al producto. */
class Item {
    private $cantVendida;
    private $objProducto;

    //CONSTRUCTOR 
    public function __construct($cantVendida,$objProducto){
        $this-> cantVendida = $cantVendida;
        $this-> objProducto = $objProducto;
    }

    //OBSERVADORES
    public function getCantVendida(){
        return $this->cantVendida;
    }

    public function getObjProducto(){
        return $this->objProducto;
    }

    //MODIFICADORES
    public function setCantVendida($cant){
        $this->cantVendida = $cant;
    }

    public function setProducto($objProducto){
        $this->objProducto = $objProducto;
    }

    //METODO TOSTRING 
    
    public function __toString(){
        return "Cantidad vendida: " . $this->getCantVendida() . "\n" .
               "----------PRODUCTO----------\n" . $this->getObjProducto();
    }

    }
=======
<?php

/**En la clase ítem: Se registra la cantidad vendida y la referencia al producto. */
class Item {
    private $cantVendida;
    private $objProducto;

    //CONSTRUCTOR 
    public function __construct($cantVendida,$objProducto){
        $this-> cantVendida = $cantVendida;
        $this-> objProducto = $objProducto;
    }

    //OBSERVADORES
    public function getCantVendida(){
        return $this->cantVendida;
    }

    public function getObjProducto(){
        return $this->objProducto;
    }

    //MODIFICADORES
    public function setCantVendida($cant){
        $this->cantVendida = $cant;
    }

    public function setProducto($objProducto){
        $this->objProducto = $objProducto;
    }

    //METODO TOSTRING 
    
    public function __toString(){
        return "Cantidad vendida: " . $this->getCantVendida() . "\n" .
               "----------PRODUCTO----------\n" . $this->getObjProducto();
    }

    }
>>>>>>> 68d1c376344af95067d6498f559d1c7dedc314dc

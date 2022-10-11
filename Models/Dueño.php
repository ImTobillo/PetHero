<?php

namespace Models;

use Models\Persona as Persona;

class Dueño extends Persona{
    #atributos 
    private $mascotas;

    public function __construct($mascotas){
        $this->mascotas = $mascotas;
    }
      
    public function getmascotas(){
        return $this->mascotas;
    }
}

?>
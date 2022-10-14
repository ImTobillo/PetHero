<?php

namespace Models;

use Models\Persona as Persona;

class Dueño extends Persona{
    #atributos
    private $mascotas;

    public function __construct($id, $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $ciudad, $calle, $numCalle){
        parent::__construct($id, $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $ciudad, $calle, $numCalle);
    }
      
    public function getmascotas(){
        return $this->mascotas;
    }

    public function setMascotas($mascotas){
        $this->mascotas = $mascotas;
    }
}

?>
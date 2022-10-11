<?php

namespace Models;

use Models\Persona as Persona;

class Dueño extends Persona{
    #atributos 
    private $mascotas;

    public function __construct($mascotas, $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $contraseña, $ciudad, $calle, $numCalle){
        parent::__construct($nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $contraseña, $ciudad, $calle, $numCalle);
        $this->mascotas = $mascotas;
    }
      
    public function getmascotas(){
        return $this->mascotas;
    }
}

?>
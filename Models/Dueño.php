<?php

namespace Models;

use Models\Persona as Persona;

class Dueño extends Persona{

    public function __construct($id, $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $ciudad, $calle, $numCalle){
        parent::__construct($id, $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $ciudad, $calle, $numCalle);
    }
}

?>
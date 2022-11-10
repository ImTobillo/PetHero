<?php

namespace Models;
use Models\Mascota AS Mascota;

class Gato extends Mascota{

    function __construct($idDueño, $tipoMascota, $nombre, $tamaño, $edad, $raza, $observaciones, $planVacunacion, $imgPerro, $videoPerro)
    {
    parent::__construct($idDueño, $tipoMascota, $nombre, $tamaño, $edad, $raza, $observaciones, $planVacunacion, $imgPerro, $videoPerro);
    }

}

?>
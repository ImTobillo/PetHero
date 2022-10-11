<?php 

namespace Models;

class Guardian extends Persona
{
    private $remuneracion;
    private $tamaño;
    private $diasDisponibles;
    private $horaDisponible;
    
    public function __construct($id, $remuneracion, $tamaño, $diasDisponibles, $horaDisponible, $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $contraseña, $ciudad, $calle, $numCalle){
        parent::__construct($id, $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $contraseña, $ciudad, $calle, $numCalle);
        $this->remuneracion = $remuneracion;
        $this->tamaño = $tamaño;
        $this->diasDisponibles = $diasDisponibles;
        $this->horaDisponible = $horaDisponible;
    }

    public function getRemuneracion()
    {
        return $this->remuneracion;
    }

    public function getTamaño()
    {
        return $this->tamaño;
    }

    public function getDiasDisponibles()
    {
        return $this->diasDisponibles;
    }

    public function getHoraDisponible()
    {
        return $this->horaDisponible;
    }

    public function setRemuneracion($remuneracion)
    {
        $this->remuneracion = $remuneracion;

        return $this;
    }

    public function setTamaño($tamaño)
    {
        $this->tamaño = $tamaño;

        return $this;
    }

    public function setDiasDisponibles($diasDisponibles)
    {
        $this->diasDisponibles = $diasDisponibles;

        return $this;
    }

    public function setHoraDisponible($horaDisponible)
    {
        $this->horaDisponible = $horaDisponible;

        return $this;
    }
}



?>
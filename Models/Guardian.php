<?php 

namespace Models;

class Guardian extends Persona
{
    private $remuneracion;
    private $tamaño;
    private $fechaInicio;
    private $fechaFinal;
    private $horaDisponible;
    
    public function __construct($id, $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $ciudad, $calle, $numCalle){
        parent::__construct($id, $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $ciudad, $calle, $numCalle);
    }

    public function getRemuneracion()
    {
        return $this->remuneracion;
    }

    public function getTamaño()
    {
        return $this->tamaño;
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

    public function setHoraDisponible($horaDisponible)
    {
        $this->horaDisponible = $horaDisponible;

        return $this;
    }

    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }

    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }
}



?>
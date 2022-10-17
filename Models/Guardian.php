<?php 

namespace Models;

class Guardian extends Persona
{
    private $remuneracion;
    private $tamaño;
    private $diasDisponibles;
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

    public function setDiasDisponibles($diasDisponibles) // recibe arreglo de strings
    {
        if (!empty($diasDisponibles))
            $this->diasDisponibles = implode(" - ", $diasDisponibles);
            
        return $this;
    }

    public function setHoraDisponible($horaInicial, $horaFinal)
    {
        $this->horaDisponible = $horaInicial . ' - ' . $horaFinal;

        return $this;
    }
}



?>
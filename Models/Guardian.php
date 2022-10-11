<?php 

namespace Models;

class Guardian extends Persona
{
    private $remuneracion;
    private $tipoPerro;
    private $tamaño;
    private $diasDisponibles;
    private $horaDisponible;
    
    public function getRemuneracion()
    {
        return $this->remuneracion;
    }

    public function setRemuneracion($remuneracion)
    {
        $this->remuneracion = $remuneracion;

        return $this;
    }

    public function getTipoPerro()
    {
        return $this->tipoPerro;
    }

    public function setTipoPerro($tipoPerro)
    {
        $this->tipoPerro = $tipoPerro;

        return $this;
    }

    public function getTamaño()
    {
        return $this->tamaño;
    }
 
    public function setTamaño($tamaño)
    {
        $this->tamaño = $tamaño;

        return $this;
    }

    public function getDiasDisponibles()
    {
        return $this->diasDisponibles;
    }
 
    public function setDiasDisponibles($diasDisponibles)
    {
        $this->diasDisponibles = $diasDisponibles;

        return $this;
    }

    public function getHoraDisponible()
    {
        return $this->horaDisponible;
    }

    public function setHoraDisponible($horaDisponible)
    {
        $this->horaDisponible = $horaDisponible;

        return $this;
    }
}



?>
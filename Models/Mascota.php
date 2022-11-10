<?php

namespace Models;

abstract class Mascota{

    private $id;    
    private $idDueño;
    private $tipoMascota;
    private $nombre;
    private $tamaño;
    private $edad;
    private $raza;
    private $observaciones;
    private $planVacunacion;
    private $imgPerro;
    private $videoPerro;

    function __construct($idDueño, $tipoMascota, $nombre, $tamaño, $edad, $raza, $observaciones/*$planVacunacion, $imgPerro, $videoPerro*/)
    {
        $this->idDueño = $idDueño;
        $this->tipoMascota = $tipoMascota;
        $this->nombre = $nombre;
        $this->tamaño = $tamaño;
        $this->edad = $edad;
        $this->raza = $raza;
        $this->observaciones = $observaciones;
        /*$this->planVacunacion = $planVacunacion;
        $this->imgPerro = $imgPerro;
        $this->videoPerro = $videoPerro;*/
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

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

    public function getEdad()
    {
        return $this->edad;
    }

    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    public function getRaza()
    {
        return $this->raza;
    }

    public function setRaza($raza)
    {
        $this->raza = $raza;

        return $this;
    }

    public function getObservaciones()
    {
        return $this->observaciones;
    }

    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }
 
    public function getPlanVacunacion()
    {
        return $this->planVacunacion;
    }

    public function setPlanVacunacion($planVacunacion)
    {
        $this->planVacunacion = $planVacunacion;

        return $this;
    }

    public function getImgPerro()
    {
        return $this->imgPerro;
    }

    public function setImgPerro($imgPerro)
    {
        $this->imgPerro = $imgPerro;

        return $this;
    }
 
    public function getVideoPerro()
    {
        return $this->videoPerro;
    }

    public function setVideoPerro($videoPerro)
    {
        $this->videoPerro = $videoPerro;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getIdDueño()
    {
        return $this->idDueño;
    }

    public function setIdDueño($idDueño)
    {
        $this->idDueño = $idDueño;

        return $this;
    }

    public function getTipoMascota()
    {
        return $this->tipoMascota;
    }

    public function setTipoMascota($tipoMascota)
    {
        $this->tipoMascota = $tipoMascota;

        return $this;
    }
}

?>
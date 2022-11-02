<?php

namespace Models;

class Reserva{
    private $id_reserva;
    private $id_guardian; #solicitado
    private $id_dueño; #solicitante
    private $fechaInicio;
    private $fechaFinal;
    private $hora_inicio;
    private $hora_final;
    private $estado; #aceptado/rechazado
    private $id_pago;
    private $id_mascota;

    public function __construct($id_guardian, $id_dueño, $fechaInicio, $fechaFinal, $hora_inicio, $hora_final, $id_mascota)
    {
        $this->id_guardian = $id_guardian;
        $this->id_dueño = $id_dueño;
        $this->fechaInicio = $fechaInicio;
        $this->fechaFinal = $fechaFinal;
        $this->hora_inicio = $hora_inicio;
        $this->hora_final = $hora_final;
        $this->id_mascota = $id_mascota;
    }

    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }

    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }


    public function getId_reserva()
    {
        return $this->id_reserva;
    }

 
    public function getId_guardian()
    {
        return $this->id_guardian;
    }



    public function getId_dueño()
    {
        return $this->id_dueño;
    }


    public function getHora_inicio()
    {
        return $this->hora_inicio;
    }


    public function getHora_final()
    {
        return $this->hora_final;
    }


    public function getEstado()
    {
        return $this->estado;
    }


    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }


    public function getId_pago()
    {
        return $this->id_pago;
    }


    public function setId_pago($id_pago)
    {
        $this->id_pago = $id_pago;

        return $this;
    }


    public function getId_mascota()
    {
        return $this->id_mascota;
    }

    public function setId_mascota($id_mascota)
    {
        $this->id_mascota = $id_mascota;

        return $this;
    }


    public function setId_reserva($id_reserva)
    {
        $this->id_reserva = $id_reserva;

        return $this;
    }


    public function getDia()
    {
        return $this->dia;
    }


    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }
}
?>
<?php

namespace Models;

class Reserva{
    private $id_reserva;
    private $id_guardian; #solicitado
    private $id_dueño; #solicitante
    private $fecha_inicio;
    private $fecha_final;
    private $hora_inicio;
    private $hora_final;
    private $estado; #aceptado/rechazado
    //private $id_pago;

    public function __construct($id_reserva, $id_guardian, $id_dueño, $fecha_inicio, $fecha_final, $hora_inicio, $hora_final)
    {
        $this->id_reserva = $id_reserva;
        $this->id_guardian = $id_guardian;
        $this->id_dueño = $id_dueño;
        $this->fecha_inicio =$fecha_inicio;
        $this->fecha_final = $fecha_final;
        $this->hora_inicio = $hora_inicio;
        $this->hora_final = $hora_final;
        $this->estado = false;
    }

    

    /**
     * Get the value of id_reserva
     */ 
    public function getId_reserva()
    {
        return $this->id_reserva;
    }

    /**
     * Get the value of id_guardian
     */ 
    public function getId_guardian()
    {
        return $this->id_guardian;
    }


    /**
     * Get the value of id_dueño
     */ 
    public function getId_dueño()
    {
        return $this->id_dueño;
    }

    /**
     * Get the value of fecha_inicio
     */ 
    public function getFecha_inicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * Get the value of fecha_final
     */ 
    public function getFecha_final()
    {
        return $this->fecha_final;
    }

    /**
     * Get the value of hora_inicio
     */ 
    public function getHora_inicio()
    {
        return $this->hora_inicio;
    }

    /**
     * Get the value of hora_final
     */ 
    public function getHora_final()
    {
        return $this->hora_final;
    }

    /**
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }
}
?>
<?php 


namespace Models;

class Tarjeta{
    private $idTarjeta;
    private $tipo; #credito o debito
    private $nroTarjeta;
    private $id_duenio;
    private $titular; #nombre en la tarjeta
    private $cod_seguridad;
    private $fechaVencimiento;

    public function __construct($tipo, $nroTarjeta, $id_duenio, $titular, $cod_seguridad, $fechaVencimiento){
        $this->tipo = $tipo;
        $this->nroTarjeta = $nroTarjeta;
        $this->id_duenio = $id_duenio;
        $this->titular = $titular;
        $this->cod_seguridad = $cod_seguridad;
        $this->fechaVencimiento = $fechaVencimiento;
    }
    public function getIdTarjeta(){
        return $this->idTarjeta;
    }

    public function setIdTarjeta($idtarjeta){
        $this->idTarjeta = $idtarjeta;
    }
    
    public function getTipo(){
        return $this->tipo;
    }

    public function getNroTarjeta(){
        return $this->nroTarjeta;
    }

    public function getId_duenio(){
        return $this->id_duenio;
    }

    public function getTitular(){
        return $this->titular;
    }

    public function getCod_Seguridad(){
        return $this->cod_seguridad;
    }

    public function getFechaVencimiento(){
        return $this->fechaVencimiento;
    }

}
?>
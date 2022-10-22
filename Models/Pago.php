<?php 

namespace Models;

class Pago
{
    private $idPago;
    private $fecha;
    private $monto;

    public function getIdPago()
    {
        return $this->idPago;
    }

    public function setIdPago($idPago)
    {
        $this->idPago = $idPago;

        return $this;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }
}

?>
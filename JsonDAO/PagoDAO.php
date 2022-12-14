<?php

namespace JsonDAO;

use Models\Pago as Pago;
use DAO\IRepositorio as IRepositorio;

class PagoDAO implements IRepositorio
{   
    private $pagoLista = array();
    private $fileName = ROOT . 'Data/pagos.json';

    public function add($pago)
    {
        $this->RetrieveData();
        $pago->setIdPago($this->GetNextId());
        array_push($this->pagoLista, $pago);
        $this->SaveData();
    }

    public function remove($idPago)
    {
        $this->RetrieveData();

        if (!empty($this->pagoLista)) {
            foreach ($this->pagoLista as $pago) {
                if ($idPago == $pago->getId()) {
                    $index = array_search($pago, $this->pagoLista);
                    array_splice($this->pagoLista, $index, 1);
                    $this->SaveData();
                }
            }
        }
    }

    public function getAll()
    {
        $this->RetrieveData();
        return $this->pagoLista;
    }
    
    public function getById($id)
    {
        $this->RetrieveData();

        $pago = null;

        if (!empty($this->pagoLista)) {
            foreach ($this->pagoLista as $pagoValues) {
                if ($id == $pagoValues->getId()) {
                    $pago = $pagoValues;
                }
            }
        }

        return $pago;
    }

    public function getByIdReserva($idReserva)
    {
        $this->RetrieveData();

        $pago = null;

        if (!empty($this->pagoLista)) {
            foreach ($this->pagoLista as $pagoValues) {
                if ($idReserva == $pagoValues->getByIdReserva()) {
                    $pago = $pagoValues;
                }
            }
        }

        return $pago;
    }

    private function GetNextId()
    {
        $id = 0;

        if (!empty($this->pagoLista))
            $id = end($this->pagoLista)->getId() + 1;

        return $id;
    }
    
    
    // métodos JSON

    private function RetrieveData()
    {
        $this->pagoLista = array();

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $pago = new Pago($content['fecha'], $content['monto'], $content['estado'], $content['idReserva']);
                $pago->setIdPago($content['idPago']);

                array_push($this->pagoLista, $pago);
            }
        }
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->pagoLista as $pago) {
            $valuesArray = array();
            $valuesArray["idPago"] = $pago->getIdPago();
            $valuesArray["fecha"] = $pago->getFecha();
            $valuesArray["estado"] = $pago->getEstado();
            $valuesArray["monto"] = $pago->getMonto();
            $valuesArray["idReserva"] = $pago->getIdReserva();

            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }
}

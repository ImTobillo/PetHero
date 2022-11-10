<?php

namespace DAO;

use Models\Pago as Pago;
use DAO\IRepositorio as IRepositorio;
use DAO\Connection as Connection;
use Exception;
use PDOException;

class PagoDAO implements IRepositorio
{
    private $connection;

    public function add($pago)
    {
        try {
            $this->connection = Connection::GetInstance();

            $query = "INSERT INTO Pago (Fecha, Monto, Estado, IdReserva)
                      VALUES (:Fecha, :Monto, :Estado, :IdReserva)";

            $parameters['Fecha'] = $pago->getFecha();
            $parameters['Monto'] = $pago->getMonto();
            $parameters['Estado'] = $pago->getEstado();
            $parameters['IdReserva'] = $pago->getIdReserva();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll()
    {
        try {
            $array = array();
            $query = "SELECT * FROM Pago";
            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query);

            foreach ($resultado as $fila) {

                $pago = new Pago($fila['Fecha'], $fila['Monto'], $fila['Estado'], $fila['IdReserva']);

                $pago->setIdPago($$fila['IdPago']);

                array_push($array, $pago);
            }

            return $array;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getById($id)
    {
        try {
            $array = array();
            $query = "SELECT * FROM Pago WHERE IdPago = '$id'";
            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query);

            $pago = new Pago($resultado[0]['Fecha'], $resultado[0]['Monto'], $resultado[0]['Estado'], $resultado[0]['IdReserva']);

            $pago->setIdPago($resultado[0]['IdPago']);

            return $pago;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getByIdReserva($idReserva)
    {
        try {
            $this->connection = Connection::GetInstance();
            $query = "SELECT * FROM Pago WHERE IdReserva = '$idReserva'";

            $resultado = $this->connection->Execute($query);

            $pago = new Pago($resultado[0]['Fecha'], $resultado[0]['Monto'], $resultado[0]['Estado'], $resultado[0]['IdReserva']);

            $pago->setIdPago($resultado[0]['IdPago']);

            return $pago;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function setTarjeta($idTarjeta, $idPago)
    {
        try {
            $this->connection = Connection::GetInstance();

            $query = "UPDATE Pago SET IdTarjeta = '$idTarjeta' WHERE IdPago = '$idPago' ";

            $this->connection->Execute($query);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /*
    
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
                $pago = new Pago();
                $pago->setIdPago($content['idPago']);
                $pago->setFecha($content['fecha']);
                $pago->setMonto($content['monto']);

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
            $valuesArray["monto"] = $pago->getMonto();

            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }*/
}

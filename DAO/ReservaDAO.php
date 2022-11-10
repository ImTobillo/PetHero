<?php

namespace DAO;

use Models\Reserva as Reserva;
use DAO\IRepositorio as IRepositorio;
use DAO\Connection as Connection;
use Exception;
use PDOException;

class ReservaDAO implements IRepositorio
{
    private $reservaLista = array();

    private $connection;

    public function add($reserva)
    {
        try {
            $this->connection = Connection::GetInstance();

            $query = "INSERT INTO Reserva (IdDuenio, IdGuardian, IdMascota, FechaInicio, FechaFinal, HoraInicio, Estado, HoraFinal)
                          VALUES (:IdDuenio, :IdGuardian, :IdMascota, :FechaInicio, :FechaFinal, :HoraInicio, :Estado, :HoraFinal)";

            $parameters['IdDuenio'] = $reserva->getId_dueño();
            $parameters['IdGuardian'] = $reserva->getId_guardian();
            $parameters['IdMascota'] = $reserva->getId_mascota();
            $parameters['FechaInicio'] = $reserva->getFechaInicio();
            $parameters['FechaFinal'] = $reserva->getFechaFinal();
            $parameters['HoraInicio'] = $reserva->getHora_inicio();
            $parameters['Estado'] = $reserva->getEstado();
            $parameters['HoraFinal'] = $reserva->getHora_final();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function remove($idReserva)
    {
        try {
            $this->connection = Connection::GetInstance();

            $query = "DELETE FROM Reserva WHERE IdReserva = '$idReserva'";

            $this->connection->Execute($query);
        } catch (Exception $e) {
            throw ($e);
        }
    }

    public function getAll()
    {
        try {
            $array = array();
            $query = "SELECT * FROM Reserva";
            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query);

            foreach ($resultado as $fila) {

                $reserva = new Reserva($fila['IdGuardian'], $fila['IdDuenio'], $fila['FechaInicio'], $fila['FechaFinal'], $fila['HoraInicio'], $fila['HoraFinal'], $fila['IdMascota']);

                $reserva->setId_reserva($fila['IdReserva']);
                $reserva->setEstado($fila['Estado']);

                array_push($array, $reserva);
            }

            return $array;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAllById($idDuenio)
    {
        try {
            $array = array();
            $query = "SELECT * FROM Reserva r WHERE r.IdDuenio = '$idDuenio'";
            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query);

            foreach ($resultado as $fila) {

                $reserva = new Reserva($fila['IdGuardian'], $fila['IdDuenio'], $fila['FechaInicio'], $fila['FechaFinal'], $fila['HoraInicio'], $fila['HoraFinal'], $fila['IdMascota']);

                $reserva->setId_reserva($fila['IdReserva']);
                $reserva->setEstado($fila['Estado']);

                array_push($array, $reserva);
            }

            return $array;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getById($id)
    {
        try {
            //$this->RetrieveData();
            $this->reservaLista = $this->getAll();

            $reserva = null;

            if (!empty($this->reservaLista)) {
                foreach ($this->reservaLista as $reservaValue) {
                    if ($id == $reservaValue->getId_reserva()) {
                        $reserva = $reservaValue;
                    }
                }
            }
            return $reserva;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /*SET*/
    public function setEstadoReserva($id, $estado)
    {
        try {
            //cuando se acepte la reserva se setea el idpago y se crea el pago
            $this->connection = Connection::GetInstance();

            $query = "UPDATE Reserva SET Reserva.Estado = '$estado' WHERE Reserva.IdReserva = '$id' ";

            $this->connection->Execute($query);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /*
    // private $fileName = ROOT . 'Data/reservas.json';
    public function add($reserva)
    {
        $this->RetrieveData();
        $reserva->setId_reserva($this->GetNextId());
        array_push($this->reservaLista, $reserva);
        $this->SaveData();
    }

    public function remove($id)
    {
        $this->RetrieveData();

        if (!empty($this->reservaLista)) {
            foreach ($this->reservaLista as $reserva) {
                if ($id == $reserva->getId()) {
                    $index = array_search($reserva, $this->reservaLista);
                    array_splice($this->reservaLista, $index, 1);
                    $this->SaveData();
                }
            }
        }
    }

    public function getAll()
    {
        $this->RetrieveData();
        return $this->reservaLista;
    }

    public function getById($id)
    {
        $this->RetrieveData();

        $reserva = null;

        if (!empty($this->reservaLista)) {
            foreach ($this->reservaLista as $reservaValues) {
                if ($id == $reservaValues->getId()) {
                    $reserva = $reservaValues;
                }
            }
        }

        return $reserva;
    }

    public function setEstadoReserva($id, $estado)
    {
        $this->RetrieveData();

        foreach ($this->reservaLista as $reservaValues) {
            if ($id == $reservaValues->getId_reserva())
                $reservaValues->setEstado($estado);
        }
        
        $this->SaveData();
    }



    // métodos JSON

    private function RetrieveData()
    {
        $this->reservaLista = array();

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                
                $reserva = new Reserva($content['id_guardian'], $content['id_dueño'], $content['fechaInicio'], $content['fechaFinal'], $content['hora_inicio'], $content['hora_final'], $content['id_mascota']);
                $reserva->setId_reserva($content['id_reserva']);
                $reserva->setEstado($content['estado']);
                $reserva->setId_pago($content['id_pago']);

                array_push($this->reservaLista, $reserva);
            }
        }
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->reservaLista as $reserva) {
            $valuesArray = array();
            $valuesArray["id_reserva"] = $reserva->getId_reserva();
            $valuesArray["id_guardian"] = $reserva->getId_guardian();
            $valuesArray["id_dueño"] = $reserva->getId_dueño();
            $valuesArray["fechaInicio"] = $reserva->getFechaInicio();
            $valuesArray["fechaFinal"] = $reserva->getFechaFinal();
            $valuesArray["hora_inicio"] = $reserva->getHora_inicio();
            $valuesArray["hora_final"] = $reserva->getHora_final();
            $valuesArray["estado"] = $reserva->getEstado();
            $valuesArray["id_pago"] = $reserva->getId_pago();
            $valuesArray["id_mascota"] = $reserva->getId_mascota();

            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }

    private function GetNextId()
    {
        $id = 0;

        if (!empty($this->reservaLista))
            $id = end($this->reservaLista)->getId_reserva() + 1;

        return $id;
    }

    public function updateEstado($id_reserva, $nuevo_estado){
        $reserva = $this->getById($id_reserva);

        if($reserva->getEstado() == null){
            $reserva->setEstado($nuevo_estado);
        }
        
        $this->SaveData();
    }

    public function updatePago($id_reserva, $id_pago){
        $reserva = $this->getById($id_reserva);

        if($reserva->getId_pago() == null){
            $reserva->setId_pago($id_pago);
        }
        
        $this->SaveData();
    }*/
}

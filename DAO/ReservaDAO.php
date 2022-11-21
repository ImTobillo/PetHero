<?php

namespace DAO;

use Models\Reserva as Reserva;
use DAO\IRepositorio as IRepositorio;
use DAO\Connection as Connection;
use Exception;
use Models\Pago;
use PDOException;

class ReservaDAO implements IRepositorio
{
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

            $query = "DELETE FROM Reserva WHERE IdReserva = :IdReserva";

            $parameters['IdReserva'] = $idReserva;

            $this->connection->Execute($query, $parameters);
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
            $query = "SELECT * FROM Reserva WHERE IdDuenio = :IdDuenio";

            $parameters['IdDuenio'] = $idDuenio;

            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query, $parameters);

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
            $this->connection = Connection::GetInstance();

            $query = "SELECT * FROM Reserva WHERE IdReserva = :IdReserva";

            $parameters['IdReserva'] = $id;

            $resultado = $this->connection->Execute($query, $parameters);

            $reserva = new Reserva($resultado[0]['IdGuardian'], 
                                    $resultado[0]['IdDuenio'],
                                    $resultado[0]['FechaInicio'],
                                    $resultado[0]['FechaFinal'],
                                    $resultado[0]['HoraInicio'],
                                    $resultado[0]['HoraFinal'],
                                    $resultado[0]['IdMascota']);

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

            $query = "UPDATE Reserva SET Estado = :Estado WHERE IdReserva = :IdReserva ";

            $parameters['IdReserva'] = $id;
            $parameters['Estado'] = $estado;

            $this->connection->Execute($query, $parameters);
        } catch (Exception $e) {
            throw $e;
        }
    }
}

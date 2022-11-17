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

                $pago->setIdPago($fila['IdPago']);

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
            $query = "SELECT * FROM Pago WHERE IdPago = :IdPago";

            $parameters['IdPago'] = $id;

            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query, $parameters);

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
            $query = "SELECT * FROM Pago WHERE IdReserva = :IdReserva";

            $parameters['IdReserva'] = $idReserva;

            $resultado = $this->connection->Execute($query, $parameters);

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

            $query = "UPDATE Pago SET IdTarjeta = :IdTarjeta WHERE IdPago = :IdPago ";

            $parameters['IdTarjeta'] = $idTarjeta;
            $parameters['IdPago'] = $idPago;

            $this->connection->Execute($query, $parameters);

        } catch (Exception $e) {
            throw $e;
        }
    }
}

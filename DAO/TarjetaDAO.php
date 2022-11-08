<?php 

namespace DAO;

use DAO\Connection as Connection;
use Exception;
use Models\Tarjeta;
use PDOException;

class TarjetaDAO implements IRepositorio
{
    private $connection;

    public function add($tarjeta)
    {
        try {
            $this->connection = Connection::GetInstance();

            $query = "INSERT INTO Tarjeta (tipo, nroTarjeta, id_duenio, titular, codSeguridad, fechaVencimiento)
                      VALUES (:tipo, :nroTarjeta, :id_duenio, :titular, :codSeguridad, :fechaVencimiento)";

            $parameters['tipo'] = $tarjeta->getTipo();
            $parameters['nroTarjeta'] = $tarjeta->getNroTarjeta();
            $parameters['id_duenio'] = $tarjeta->getId_duenio();
            $parameters['titular'] = $tarjeta->getTitular();
            $parameters['codSeguridad'] = $tarjeta->getCod_Seguridad();
            $parameters['fechaVencimiento'] = $tarjeta->getFechaVencimiento();

            $this->connection->ExecuteNonQuery($query, $parameters);

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getById($idTarjeta)
    {
        try {
            $this->connection = Connection::GetInstance();
            $query = "SELECT * FROM Tarjeta WHERE idTarjeta = '$idTarjeta' ";
            $resultado = $this->connection->Execute($query);
            
            $tarjeta = new Tarjeta($resultado[0]['tipo'], $resultado[0]['nroTarjeta'], $resultado[0]['idDuenio'], $resultado[0]['titular'], $resultado[0]['codSeguridad'],
                              $resultado[0]['fechaVencimiento']);
            
            $tarjeta->setIdTarjeta($resultado[0]['idTarjeta']);

            return $tarjeta;

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAllByIdDuenio($idDuenio)
    {
        try {
            $array = array();
            $this->connection = Connection::GetInstance();

            $query = "SELECT * FROM Tarjeta WHERE id_duenio = '$idDuenio' ";

            $resultado = $this->connection->Execute($query);
            
            foreach ($resultado as $value) {

                $tarjeta = new Tarjeta($value['tipo'], $value['nroTarjeta'], $value['id_duenio'], $value['titular'], $value['codSeguridad'],
                              $value['fechaVencimiento']);

                $tarjeta->setIdTarjeta($value['IdTarjeta']);

                array_push($array, $tarjeta);
            }
            
            return $array;

        } catch (Exception $e) {
            throw $e;
        }
    }
    
    public function getAll(){
    }

}
?>
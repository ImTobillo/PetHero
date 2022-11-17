<?php

namespace DAO;

use Models\Dueño as Dueño;
use DAO\IRepositorio as IRepositorio;
use DAO\Connection as Connection;
use Exception;
use PDOException;

class DueñoDAO implements IRepositorio
{
    private $connection;

    public function add($dueño)
    {
        try {
            $this->connection = Connection::GetInstance();

            $query = "INSERT INTO Duenio (IdUser, IdCiudad, Nombre, Apellido, FechaNacimiento, Dni, Telefono, Email, Calle, NumCalle)
                      VALUES (:IdUser, :IdCiudad, :Nombre, :Apellido, :FechaNacimiento, :Dni, :Telefono, :Email, :Calle, :NumCalle)";

            $parameters['IdUser'] = $dueño->getId();
            $parameters['IdCiudad'] = $this->getIdCiudad($dueño->getCiudad());
            $parameters['Nombre'] = $dueño->getNombre();
            $parameters['Apellido'] = $dueño->getApellido();
            $parameters['FechaNacimiento'] = $dueño->getfechaNacimiento();
            $parameters['Dni'] = $dueño->getDni();
            $parameters['Telefono'] = $dueño->getTelefono();
            $parameters['Email'] = $dueño->getEmail();
            $parameters['Calle'] = $dueño->getCalle();
            $parameters['NumCalle'] = $dueño->getNumCalle();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getById($IdUser)
    {
        try {
            $this->connection = Connection::GetInstance();
            $query = "SELECT * FROM Duenio WHERE IdUser = :IdUser ";
            
            $parameters['IdUser'] = $IdUser;

            $resultado = $this->connection->Execute($query, $parameters);

            $user = new Dueño(
                $resultado[0]['IdUser'],
                $resultado[0]['Nombre'],
                $resultado[0]['Apellido'],
                $resultado[0]['FechaNacimiento'],
                $resultado[0]['Dni'],
                $resultado[0]['Telefono'],
                $resultado[0]['Email'],
                $this->getCiudad($resultado[0]['IdCiudad']),
                $resultado[0]['Calle'],
                $resultado[0]['NumCalle']
            );

            return $user;
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function getCiudad($IdCiudad)
    {
        try {
            $this->connection = Connection::GetInstance();
            $query = "SELECT Nombre FROM Ciudad WHERE IdCiudad = :IdCiudad ";

            $parameters['IdCiudad'] = $IdCiudad;

            $resultado = $this->connection->Execute($query, $parameters);

            return $resultado[0][0];
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function getIdCiudad($nombre)
    {
        try {
            $this->connection = Connection::GetInstance();
            $idRetornar = null;
            $query = "SELECT IdCiudad AS id FROM Ciudad WHERE Nombre = :Nombre ";

            $parameters['Nombre'] = $nombre;

            $resultado = $this->connection->Execute($query, $parameters);

            if (empty($resultado)) {
                $query = "INSERT INTO Ciudad (Nombre) VALUES (:Nombre)";
                $parameters['Nombre'] = $nombre;

                $this->connection->ExecuteNonQuery($query, $parameters);

                $query = "SELECT MAX(IdCiudad) AS id FROM Ciudad";

                $idRetornar = $this->connection->Execute($query);
            } else {
                $idRetornar = $resultado;
            }

            return $idRetornar[0][0];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll()
    {
        try {
            $array = array();
            $query = "SELECT * FROM Duenio";
            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query);

            foreach ($resultado as $fila) {

                $dueño = new Dueño($fila['IdUser'], 
                                         $fila['Nombre'], 
                                         $fila['Apellido'], 
                                         $fila['FechaNacimiento'], 
                                         $fila['Dni'], 
                                         $fila['Telefono'], 
                                         $fila['Email'], 
                                         $this->getCiudad($fila['IdCiudad']), 
                                         $fila['Calle'], 
                                         $fila['NumCalle']);

                array_push($array, $dueño);
            }

            return $array;
        } catch (Exception $e) {
            throw $e;
        }
    }
}

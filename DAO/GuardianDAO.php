<?php

namespace DAO;

use Models\Guardian as Guardian;
use DAO\IRepositorio as IRepositorio;
use DAO\Connection as Connection;
use Exception;
use PDOException;

class GuardianDAO implements IRepositorio
{
    private $connection;
    private $guardianList = array();

    public function add($guardian)
    {
        try {
            $this->connection = Connection::GetInstance();

            $query = "INSERT INTO Guardian (IdUser, IdCiudad, IdTamanio, Nombre, Apellido, FechaNacimiento, Dni, Telefono, Email, Calle, NumCalle, Remuneracion, FechaInicio, FechaFinal, HoraDisponible)
                      VALUES (:IdUser, :IdCiudad, :IdTamanio, :Nombre, :Apellido, :FechaNacimiento, :Dni, :Telefono, :Email, :Calle, :NumCalle, :Remuneracion, :FechaInicio, :FechaFinal, :HoraDisponible)";

            $parameters['IdUser'] = $guardian->getId();
            $parameters['IdCiudad'] = $this->devuelveIdCiudad($guardian->getCiudad());
            $parameters['IdTamanio'] = $this->devuelveIdTamanio($guardian->getTamaño());
            $parameters['Nombre'] = $guardian->getNombre();
            $parameters['Apellido'] = $guardian->getApellido();
            $parameters['FechaNacimiento'] = $guardian->getfechaNacimiento();
            $parameters['Dni'] = $guardian->getDni();
            $parameters['Telefono'] = $guardian->getTelefono();
            $parameters['Email'] = $guardian->getEmail();
            $parameters['Calle'] = $guardian->getCalle();
            $parameters['NumCalle'] = $guardian->getNumCalle();
            $parameters['Remuneracion'] = $guardian->getRemuneracion();
            $parameters['FechaInicio'] = $guardian->getFechaInicio();
            $parameters['FechaFinal'] = $guardian->getFechaFinal();
            $parameters['HoraDisponible'] = $guardian->getHoraDisponible();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll()
    {
        try {
            $array = array();
            $query = "SELECT * FROM Guardian";
            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query);

            foreach ($resultado as $fila) {

                $guardian = new Guardian($fila['IdUser'], 
                                         $fila['Nombre'], 
                                         $fila['Apellido'], 
                                         $fila['FechaNacimiento'], 
                                         $fila['Dni'], 
                                         $fila['Telefono'], 
                                         $fila['Email'], 
                                         $this->getCiudad($fila['IdCiudad']), 
                                         $fila['Calle'], 
                                         $fila['NumCalle']);

                $guardian->setTamaño($this->getTamaño($fila['IdTamanio']));
                $guardian->setRemuneracion($fila['Remuneracion']);
                $guardian->setFechaInicio($fila['FechaInicio']);
                $guardian->setFechaFinal($fila['FechaFinal']);
                $guardian->setHoraDisponible($fila['HoraDisponible']);

                array_push($array, $guardian);
            }

            return $array;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getById($IdUser)
    {
        try {
            
            $this->connection = Connection::GetInstance();

            $query = "SELECT * FROM Guardian WHERE IdUser = :IdUser";

            $parameters['IdUser'] = $IdUser;

            $resultado = $this->connection->Execute($query, $parameters);

            $guardian = new Guardian(
                $resultado[0]['IdUser'],
                $resultado[0]['Nombre'],
                $resultado[0]['Apellido'],
                $resultado[0]['FechaNacimiento'],
                $resultado[0]['Dni'],
                $resultado[0]['Telefono'],
                $resultado[0]['Email'],
                $this->getCiudad($resultado[0]['IdCiudad']),
                $resultado[0]['Calle'],
                $resultado[0]['NumCalle']);
            
            $guardian->setTamaño($this->getTamaño($resultado[0]['IdTamanio']));
            $guardian->setRemuneracion($resultado[0]['Remuneracion']);
            $guardian->setFechaInicio($resultado[0]['FechaInicio']);
            $guardian->setFechaFinal($resultado[0]['FechaFinal']);
            $guardian->setHoraDisponible($resultado[0]['HoraDisponible']);

            return $guardian;

        } catch (Exception $e) {
            throw $e;
        }
    }

    /*GET ID*/
    private function devuelveIdCiudad($nombre)
    {
        try {
            $this->connection = Connection::GetInstance();
            $idRetornar = null;
            $query = "SELECT Ciudad.IdCiudad AS id FROM Ciudad WHERE Ciudad.Nombre = :Nombre ";

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

    private function devuelveIdTamanio($tamanio)
    {
        try {
            $this->connection = Connection::GetInstance();
            $idRetornar = null;
            $query = "SELECT IdTamanioMascota FROM TamanioMascota WHERE Tamanio = :Tamanio ";

            $parameters['Tamanio'] = $tamanio;

            $resultado = $this->connection->Execute($query, $parameters);

            if (empty($resultado)) {
                $query = "INSERT INTO TamanioMascota (Tamanio) VALUES (:Tamanio)";
                $parameters['Tamanio'] = $tamanio;

                $this->connection->ExecuteNonQuery($query, $parameters);

                $query = "SELECT MAX(IdTamanioMascota) AS id FROM TamanioMascota";
                $idRetornar = $this->connection->Execute($query);
            } else {
                $idRetornar = $resultado;
            }

            return $idRetornar[0][0];
        } catch (Exception $e) {
            throw $e;
        }
    }

    /*GET BY ID*/
    private function getTamaño($IdTamanio)
    {
        try {
            $this->connection = Connection::GetInstance();
            
            $query = "SELECT Tamanio FROM TamanioMascota WHERE IdTamanioMascota = :IdTamanioMascota ";

            $parameters['IdTamanioMascota'] = $IdTamanio;
            
            $resultado = $this->connection->Execute($query, $parameters);

            return $resultado[0][0];
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function getCiudad($idCiudad)
    {
        try {
            $query = "SELECT Ciudad.Nombre FROM Ciudad WHERE Ciudad.IdCiudad = :IdCiudad ";

            $parameters['IdCiudad'] = $idCiudad;

            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query, $parameters);

            return $resultado[0][0];
        } catch (Exception $e) {
            throw $e;
        }
    }

    /*LOGICA*/
    public function filtrar($fechaInicio, $fechaFinal)
    {

        try {
            $array = array();
            $query = "SELECT * FROM Guardian 
                      WHERE FechaInicio <= :FechaInicio AND FechaFinal >= :FechaInicio 
                            AND FechaFinal >= :FechaFinal AND FechaInicio <= :FechaFinal";

            $parameters['FechaInicio'] = $fechaInicio;
            $parameters['FechaFinal'] = $fechaFinal;

            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query, $parameters);

            foreach ($resultado as $fila) {

                $guardian = new Guardian(
                    $fila['IdUser'],
                    $fila['Nombre'],
                    $fila['Apellido'],
                    $fila['FechaNacimiento'],
                    $fila['Dni'],
                    $fila['Telefono'],
                    $fila['Email'],
                    $this->getCiudad($fila['IdCiudad']),
                    $fila['Calle'],
                    $fila['NumCalle']
                );

                $guardian->setTamaño($this->getTamaño($fila['IdTamanio'])); 
                $guardian->setRemuneracion($fila['Remuneracion']);
                $guardian->setFechaInicio($fila['FechaInicio']);
                $guardian->setFechaFinal($fila['FechaFinal']);
                $guardian->setHoraDisponible($fila['HoraDisponible']);

                array_push($array, $guardian);
            }

            return $array;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function edit($idGuardian, $tamanio, $remuneracion, $fechaInicio, $fechaFinal, $horaDisponible)
    {
        try {

            $this->connection = Connection::GetInstance();

            $idtamanio = $this->devuelveIdTamanio($tamanio);
            $query = "UPDATE Guardian SET Remuneracion = :Remuneracion,
                                          IdTamanio = :IdTamanio, 
                                          FechaInicio = :FechaInicio, 
                                          FechaFinal = :FechaFinal, 
                                          HoraDisponible = :HoraDisponible
                        where IdUser = :IdUser";

            $parameters['Remuneracion'] = $remuneracion;
            $parameters['IdTamanio'] = $this->devuelveIdTamanio($tamanio);
            $parameters['FechaInicio'] = $fechaInicio;
            $parameters['FechaFinal'] = $fechaFinal;
            $parameters['HoraDisponible'] = $horaDisponible;

            $this->connection->Execute($query, $parameters);
        } catch (Exception $e) {
            throw ($e);
        }
    }
}

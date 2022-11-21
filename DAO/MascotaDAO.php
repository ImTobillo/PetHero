<?php

namespace DAO;

use DAO\IRepositorio as IRepositorio;
use Models\Mascota as Mascota;
use Models\Perro as Perro;
use Models\Gato as Gato;
use DAO\Connection as Connection;
use Exception;
use PDOException;

class MascotaDAO implements IRepositorio
{
    private $connection;

    public function add($mascota)
    {
        try {
            $this->connection = Connection::GetInstance();

            $query = "INSERT INTO Mascota (IdDuenio, IdRaza, IdTamanio, IdArchivoImgPerfil, IdArchivoImgPlanVacunacion, IdArchivoVideoPerro, Nombre, Edad, Observaciones)
                      VALUES (:IdDuenio, :IdRaza, :IdTamanio, :IdArchivoImgPerfil, :IdArchivoImgPlanVacunacion, :IdArchivoVideoPerro, :Nombre, :Edad, :Observaciones)";

            $parameters['IdDuenio'] = $mascota->getIdDueño();
            $parameters['IdRaza'] = $this->devuelveIdRaza($mascota->getRaza(), $mascota->getTipoMascota());
            $parameters['IdTamanio'] = $this->devuelveIdTamanio($mascota->getTamaño());
            $parameters['IdArchivoImgPerfil'] = $this->crearArchivo($mascota->getImgPerro());
            $parameters['IdArchivoImgPlanVacunacion'] = $this->crearArchivo($mascota->getPlanVacunacion());
            $parameters['IdArchivoVideoPerro'] = $this->crearArchivo($mascota->getVideoPerro());
            $parameters['Nombre'] = $mascota->getNombre();
            $parameters['Edad'] = $mascota->getEdad();
            $parameters['Observaciones'] = $mascota->getObservaciones();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

    public function getAll()
    {
        try {
            $array = array();
            $query = "SELECT * FROM Mascota";
            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query);

            foreach ($resultado as $fila) {

                $mascota = ($this->getTipoMascota($fila['IdRaza']) == "Perro")
                ? new Perro($fila['IdDuenio'], 
                            $this->getTipoMascota($fila['IdRaza']), 
                            $fila['Nombre'], 
                            $this->getTamañoBd($fila['IdTamanio']), 
                            $fila['Edad'], 
                            $this->getRaza($fila['IdRaza']), 
                            $fila['Observaciones'], 
                            $this->getArch($fila['IdArchivoImgPlanVacunacion']), 
                            $this->getArch($fila['IdArchivoImgPerfil']), 
                            $this->getArch($fila['IdArchivoVideoPerro']))

                : new Gato($fila['IdDuenio'], 
                           $this->getTipoMascota($fila['IdRaza']), 
                           $fila['Nombre'], 
                           $this->getTamañoBd($fila['IdTamanio']), 
                           $fila['Edad'], 
                           $this->getRaza($fila['IdRaza']), 
                           $fila['Observaciones'], 
                           $this->getArch($fila['IdArchivoImgPlanVacunacion']), 
                           $this->getArch($fila['IdArchivoImgPerfil']), 
                           $this->getArch($fila['IdArchivoVideoPerro']));

                $mascota->setId($fila['IdMascota']);

                array_push($array, $mascota);
            }

            return $array;
        } catch (Exception $e) {
            throw $e;
        }
    }

    // Funciones para el Add

    private function devuelveIdRaza($nombreRaza, $tipoMascota)
    {
        try {
            $this->connection = Connection::GetInstance();
            $idRetornar = null;
            $query = "SELECT Raza.IdRaza AS id FROM Raza WHERE Raza.Raza = :Raza ";

            $parameters['Raza'] = $nombreRaza;

            $resultado = $this->connection->Execute($query, $parameters);

            if (empty($resultado)) {
                $query = "INSERT INTO Raza (Raza, Especie) VALUES (:Raza, :Especie)";
                $parameters['Raza'] = $nombreRaza;
                $parameters['Especie'] = $tipoMascota;

                $this->connection->ExecuteNonQuery($query, $parameters);

                $query = "SELECT MAX(IdRaza) AS id FROM Raza";
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
            $query = "SELECT TamanioMascota.IdTamanioMascota AS id FROM TamanioMascota WHERE TamanioMascota.Tamanio = :Tamanio ";

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

    public function crearArchivo($arch)
    {
        try {
            $idRetornar = null;

            $this->connection = Connection::GetInstance();

            if ($arch != null) {
                $query = "INSERT INTO Archivo(Url_) VALUES (:Url_)";
                $parameters['Url_'] = $arch;

                $this->connection->ExecuteNonQuery($query, $parameters);

                $query = "SELECT MAX(IdArchivo) AS id FROM Archivo";
                $idRetornar = $this->connection->Execute($query);

                return $idRetornar[0][0];
            } else {
                return null;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    // Funciones para getAll

    private function getTipoMascota($IdRaza)
    {
        try {
            $query = "SELECT Especie FROM Raza WHERE IdRaza = :IdRaza" ;

            $parameters['IdRaza'] = $IdRaza;

            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query, $parameters);

            return $resultado[0][0];
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function getRaza($IdRaza)
    {
        try {
            $query = "SELECT Raza FROM Raza WHERE IdRaza = :IdRaza";

            $parameters['IdRaza'] = $IdRaza;

            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query, $parameters);

            return $resultado[0][0];
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function getTamañoBd($IdTamanio)
    {
        try {
            $query = "SELECT Tamanio FROM TamanioMascota WHERE IdTamanioMascota = :IdTamanioMascota";

            $parameters['IdTamanioMascota'] = $IdTamanio;

            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query, $parameters);

            return $resultado[0][0];
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function getArch($IdArch)
    {
        try {
            if ($IdArch) {
                $this->connection = Connection::GetInstance();
                $query = "SELECT Url_ FROM Archivo WHERE IdArchivo = :IdArchivo";

                $parameters['IdArchivo'] = $IdArch;

                
                $resultado = $this->connection->Execute($query, $parameters);
                return $resultado[0][0];
            } else {
                return null;
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getById($id)
    {
        try {
            //$this->RetrieveData();
            

            $mascota = null;

            if (!empty($listMascotas)) {
                foreach ($listMascotas as $masc) {
                    if ($id == $masc->getId()) {
                        $mascota = $masc;
                    }
                }
            }
            return $mascota;
        } catch (Exception $e) {
            throw $e;
        }
    }
}

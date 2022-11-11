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
                return $resultado;
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
            $this->connection = Connection::GetInstance();

            $query = "SELECT * FROM Mascota WHERE IdMascota = :IdMascota";

            $parameters['IdMascota'] = $id;

            $resultado = $this->connection->Execute($query, $parameters);

            $mascota = ($this->getTipoMascota($resultado[0]['IdRaza']) == "Perro")
                ? new Perro($resultado[0]['IdDuenio'], 
                            $this->getTipoMascota($resultado[0]['IdRaza']), 
                            $resultado[0]['Nombre'], 
                            $this->getTamañoBd($resultado[0]['IdTamanio']), 
                            $resultado[0]['Edad'], 
                            $this->getRaza($resultado[0]['IdRaza']), 
                            $resultado[0]['Observaciones'], 
                            $this->getArch($resultado[0]['IdArchivoImgPlanVacunacion']), 
                            $this->getArch($resultado[0]['IdArchivoImgPerfil']), 
                            $this->getArch($resultado[0]['IdArchivoVideoPerro']))

                : new Gato($resultado[0]['IdDuenio'], 
                           $this->getTipoMascota($resultado[0]['IdRaza']), 
                           $resultado[0]['Nombre'], 
                           $this->getTamañoBd($resultado[0]['IdTamanio']), 
                           $resultado[0]['Edad'], 
                           $this->getRaza($resultado[0]['IdRaza']), 
                           $resultado[0]['Observaciones'], 
                           $this->getArch($resultado[0]['IdArchivoImgPlanVacunacion']), 
                           $this->getArch($resultado[0]['IdArchivoImgPerfil']), 
                           $this->getArch($resultado[0]['IdArchivoVideoPerro']));

                $mascota->setId($resultado[0]['IdMascota']); 

            return $mascota;
        } catch (Exception $e) {
            throw $e;
        }
    }

    /*

    // Funciones para Json

    private $fileName = ROOT . 'Data/mascotas.json';
    private function GetNextId()
    {
        $id = 0;

        if (!empty($this->listMascotas))
            $id = end($this->listMascotas)->getId() + 1;

        return $id;
    }

    public function add($mascota)
    {
        $this->RetrieveData();
        $mascota->setId($this->GetNextId());
        array_push($this->listMascotas, $mascota);
        $this->SaveData();
    }

    public function SaveData(){

        $arrayToEncode = array();

        foreach ($this->listMascotas as $mascota) {
            $valuesArray = array();
            $valuesArray['id'] = $mascota->getId();
            $valuesArray['idDueño'] = $mascota->getIdDueño();
            $valuesArray['tipoMascota'] = $mascota->getTipoMascota();
            $valuesArray['nombre'] = $mascota->getNombre();
            $valuesArray['tamaño'] = $mascota->getTamaño();
            $valuesArray['edad'] = $mascota->getEdad();
            $valuesArray['raza'] = $mascota->getRaza();
            $valuesArray['observaciones'] = $mascota->getObservaciones();
            $valuesArray['planVacunacion'] = $mascota->getPlanVacunacion(); 
            $valuesArray["imgPerro"] = $mascota->getImgPerro(); 
            $valuesArray["videoPerro"] = $mascota->getVideoPerro(); 

            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }

    public function remove($id)
    {
        //$this->RetrieveData();
        $this->getAll();
        
        if (!empty($this->listMascotas)) {
            foreach ($this->listMascotas as $mascota) {
                if ($id == $mascota->getId()) {
                    $index = array_search($mascota, $this->listMascotas);
                    array_splice($this->listMascotas, $index, 1);
                    $this->SaveData();
                }
            }
        }
    }

    public function RetrieveData(){

        $this->listMascotas = array();

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                
                if($content['tipoMascota'] == "Perro"){
                    $mascota = new Perro();
                }
                else{
                    $mascota = new Gato();
                }

                $mascota->setId($content['id']);
                $mascota->setIdDueño($content['idDueño']);
                $mascota->setTipoMascota($content['tipoMascota']);
                $mascota->setNombre($content['nombre']);
                $mascota->setTamaño($content['tamaño']);
                $mascota->setEdad($content['edad']);
                $mascota->setRaza($content['raza']);
                $mascota->setObservaciones($content['observaciones']);
                $mascota->setPlanVacunacion($content['planVacunacion']);
                $mascota->setImgPerro($content['imgPerro']);
                $mascota->setVideoPerro($content['videoPerro']);

                array_push($this->listMascotas, $mascota);
            }
        }
    }
  
    public function getAll()
    {
        $this->RetrieveData();
        return $this->listMascotas;
    }
*/
}

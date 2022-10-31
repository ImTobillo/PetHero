<?php 

namespace DAO;

use DAO\IRepositorio as IRepositorio;
use Models\Mascota as Mascota;
use Models\Perro as Perro;
use Models\Gato as Gato;
use DAO\Connection as Connection;
use Exception;
use PDOException;

class MascotaDAO implements IRepositorio{

    private $connection;
    private $listMascotas = array();
    
    //private $fileName = ROOT . 'Data/mascotas.json';

    private function devuelveIdRaza($nombreRaza, $tipoMascota){

        $this->connection = Connection::GetInstance();
        $idRetornar = null;

        $query = "SELECT IdRaza AS id FROM Raza WHERE Raza = " . $nombreRaza;
        $resultado = $this->connection->Execute($query);

        if(count($resultado) == 0){
            $query = "INSERT INTO Raza (Raza, Especie) VALUES (:nombreRaza, :tipoMascota)";
            $parameters['Raza'] = $this->Raza;
            $parameters['Especie'] = $this->Raza;
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        else{
            $query = "SELECT MAX(IdRaza) AS id FROM Raza";
        }

        return $idRetornar;
    }   

    public function add($mascota){
        try{
            $this->connection = Connection::GetInstance();

            $query = "SELECT IdRaza AS id FROM Raza WHERE Raza = " . $this->mascota->getRaza();
            $resultado = $this->connection->Execute($query);
            var_dump($resultado);

            $query = "INSERT INTO Mascota (IdDueño, IdRaza, IdTamanio, IdArchivoImgPerfil, IdArchivoImgPlanVacunacion, IdArchivoVideoPerro, Nombre, Edad, Observaciones)
                      VALUES (:IdDueño, :IdRaza, :IdTamanio, :IdArchivoImgPerfil, :IdArchivoImgPlanVacunacion, :IdArchivoVideoPerro, :Nombre, :Edad, :Observaciones)";

            $parameters['IdDueño'] = $mascota->getIdDueño();
            $parameters['IdRaza'] = $mascota->getRaza();
            $parameters['IdTamanio'] = $mascota->getTamaño();
            $parameters['IdArchivoImgPerfil'] = $mascota->getImgPerro();
            $parameters['IdArchivoImgPlanVacunacion'] = $mascota->getPlanVacunacion();
            $parameters['IdArchivoVideoPerro'] = $mascota->getVideoPerro();
            $parameters['Nombre'] = $mascota->getNombre();
            $parameters['Edad'] = $mascota->getEdad();
            $parameters['Observaciones'] = $mascota->getObservaciones();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $e){
            throw $e;
        }
    }

    public function getAll(){
        try
        {
            $array = Array();
            $query = "SELECT * FROM Mascota";
            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query);

            foreach ($resultado as $fila) {

                $mascota = new Perro();

                $mascota->setId($fila['IdMascota']);
                $mascota->setIdDueño($fila['IdDuenio']);
                $mascota->setTipoMascota($this->getTipoMascota($fila['IdRaza']));
                $mascota->setRaza($fila['IdRaza']);
                $mascota->setTamaño($this->getTamañoBd($fila['IdTamanio']));
                $mascota->setImgPerro($this->getArch($fila['IdArchivoImgPerfil']));
                $mascota->setPlanVacunacion($this->getArch($fila['IdArchivoImgPlanVacunacion']));
                $mascota->setVideoPerro($this->getArch($fila['IdArchivoVideoPerro']));
                $mascota->setNombre($fila['Nombre']);
                $mascota->setEdad($fila['Edad']);
                $mascota->setObservaciones($fila['Observaciones']);

                array_push($array, $mascota);
            }

            return $array;
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }

    private function getTipoMascota($IdRaza){
        $query = "SELECT Especie FROM Raza WHERE IdRaza = " . $IdRaza;
        $this->connection = Connection::GetInstance();
        $resultado = $this->connection->Execute($query);
        return $resultado[0][0];
    }

    private function getTamañoBd($IdTamanio){
        $query = "SELECT Tamanio FROM TamanioMascota WHERE IdTamanioMascota = " . $IdTamanio;
        $this->connection = Connection::GetInstance();
        $resultado = $this->connection->Execute($query);
        return $resultado[0][0];
    }

    private function getArch($IdArch){
        $query = "SELECT Url_ FROM Archivo WHERE IdArchivo = " . $IdArch;
        $this->connection = Connection::GetInstance();
        $resultado = $this->connection->Execute($query);
        return $resultado[0][0];
    }

    public function getById($id)
    {
        //$this->RetrieveData();
        $this->getAll();

        $mascota = null;

        if (!empty($this->listMascotas)) {
            foreach ($this->listMascotas as $masc) {
                if ($id == $masc->getId()) {
                    $mascota = $masc;
                }
            }
        }
        return $mascota;
    }

/*
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

?>
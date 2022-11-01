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
    
    //private $fileName = ROOT . 'Data/guardianes.json';
    
    public function add($guardian){
        try{
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
        }
        catch(Exception $e){
            echo $e->getMessage();
            throw $e;
        }
    }

    public function getAll(){
        try
        {
            $array = Array();
            $query = "SELECT * FROM Guardian";
            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query);

            foreach ($resultado as $fila) {

                $guardian = new Guardian($fila['IdUser'], $fila['Nombre'], $fila['Apellido'], $fila['FechaNacimiento'], $fila['Dni'], $fila['Telefono'], $fila['Email'], /* ciudad */     $fila['Calle'], $fila['NumCalle']);

                $guardian->setCiudad($fila['id']); // c
                $guardian->setTamaño($fila['id']); // c
                
                $guardian->setRemuneracion($fila['Remuneracion']);
                $guardian->setFechaInicio($fila['FechaInicio']);
                $guardian->setFechaFinal($fila['FechaFinal']);
                $guardian->setHoraDisponible($fila['HoraDisponible']);

                array_push($array, $mascota);
            }

            return $array;
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }
    
    public function getById($id)
    {
        //$this->RetrieveData();
        $this->guardianList = $this->getAll();

        $guardian = null;

        if (!empty($this->guardianList)) {
            foreach ($this->guardianList as $guardianValue) {
                if ($id == $guardianValue->getId()) {
                    $guardian = $guardianValue;
                }
            }
        }
        return $guardian;
    }
    
    private function devuelveIdCiudad($ciudad){

        $this->connection = Connection::GetInstance();
        $idRetornar = null;
        $query = "SELECT Ciudad.IdCiudad AS id FROM Ciudad WHERE Ciudad.Nombre = '$ciudad' ";
        $resultado = $this->connection->Execute($query);

        if(empty($resultado)){
            $query = "INSERT INTO Ciudad (Nombre) VALUES (:Nombre)";
            $parameters['Nombre'] = $ciudad;
            $this->connection->ExecuteNonQuery($query, $parameters);
            $query = "SELECT MAX(IdCiudad) AS id FROM Ciudad";
            $idRetornar = $this->connection->Execute($query);
        }
        else{
            $idRetornar = $resultado;
        }

        return $idRetornar[0][0];
    }

    private function devuelveIdTamanio($tamanio){

        $this->connection = Connection::GetInstance();
        $idRetornar = null;
        $query = "SELECT TamanioMascota.IdTamanioMascota AS id FROM TamanioMascota WHERE TamanioMascota.Tamanio = '$tamanio' ";
        $resultado = $this->connection->Execute($query);

        if(empty($resultado)){
            $query = "INSERT INTO TamanioMascota (Tamanio) VALUES (:Tamanio)";
            $parameters['Tamanio'] = $tamanio;
            $this->connection->ExecuteNonQuery($query, $parameters);
            $query = "SELECT MAX(IdTamanioMascota) AS id FROM TamanioMascota";
            $idRetornar = $this->connection->Execute($query);
        }
        else{
            $idRetornar = $resultado;
        }

        return $idRetornar[0][0];
    }
    }

    /*
    
    public function getAll()
    {
        $this->RetrieveData();
        return $this->guardianList;
    }
    
    public function remove($id)
    {
        $this->RetrieveData();

        if (!empty($this->guardianList)) {
            foreach ($this->guardianList as $guardian) {
                if ($id == $guardian->getId()) {
                    $index = array_search($guardian, $this->guardianList);
                    array_splice($this->guardianList, $index, 1);
                    $this->SaveData();
                }
            }
        }
    }

    public function add($guardian)
    {
        $this->RetrieveData();
        array_push($this->guardianList, $guardian);
        $this->SaveData();
    }

    // métodos JSON

    private function RetrieveData()
    {
        $this->guardianList = array();

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $guardian = new Guardian($content['id'], $content['nombre'], $content['apellido'], $content['fechaNacimiento'], $content['dni'], $content['telefono'], $content['email'], $content['ciudad'], $content['calle'], $content['numCalle']);
                $guardian->setRemuneracion($content['remuneracion']);
                $guardian->setTamaño($content['tamaño']);
                $guardian->setFechaInicio($content['fechaInicio']);
                $guardian->setFechaFinal($content['fechaFinal']);
                $guardian->setHoraDisponible($content['horaDisponible']);

                array_push($this->guardianList, $guardian);
            }
        }
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->guardianList as $guardian) {
            $valuesArray = array();
            $valuesArray["id"] = $guardian->getId();
            $valuesArray["nombre"] = $guardian->getNombre();
            $valuesArray["apellido"] = $guardian->getApellido();
            $valuesArray["fechaNacimiento"] = $guardian->getFechaNacimiento();
            $valuesArray["dni"] = $guardian->getDni();
            $valuesArray["telefono"] = $guardian->getTelefono();
            $valuesArray["email"] = $guardian->getEmail();
            $valuesArray["ciudad"] = $guardian->getCiudad();
            $valuesArray["calle"] = $guardian->getCalle();
            $valuesArray["numCalle"] = $guardian->getNumCalle();
            $valuesArray["remuneracion"] = $guardian->getRemuneracion();
            $valuesArray["tamaño"] = $guardian->getTamaño();
            $valuesArray["fechaInicio"] = $guardian->getFechaInicio();
            $valuesArray["fechaFinal"] = $guardian->getFechaFinal();
            $valuesArray["horaDisponible"] = $guardian->getHoraDisponible();

            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }
}*/
?>
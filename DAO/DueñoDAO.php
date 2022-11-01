<?php 

namespace DAO;

use Models\Dueño as Dueño;
use DAO\IRepositorio as IRepositorio;
use DAO\Connection as Connection;
use Exception;
use PDOException;

class DueñoDAO implements IRepositorio
{
    private $dueñosLista = array();
    private $fileName = ROOT . 'Data/dueños.json';

    private $connection;

    public function add($dueño){
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

    public function getById($id){
        try {
            $this->connection = Connection::GetInstance();
            $query = "SELECT * FROM Duenio WHERE IdUser = '$id' ";
            $resultado = $this->connection->Execute($query);
            
            $user = new Dueño($resultado[0]['IdUser'], $resultado[0]['Nombre'], $resultado[0]['Apellido'], $resultado[0]['FechaNacimiento'], $resultado[0]['Dni'],
                              $resultado[0]['Telefono'], $resultado[0]['Email'], $this->getCiudad($resultado[0]['IdCiudad']), $resultado[0]['Calle'], $resultado[0]['NumCalle']);

            return $user;

        } catch (Exception $e) {
            throw $e;
        }
    }

    private function getCiudad($id){
        $this->connection = Connection::GetInstance();
        $query = "SELECT Nombre FROM Ciudad WHERE IdCiudad = '$id' ";
        $resultado = $this->connection->Execute($query);

        return $resultado[0][0];
    }

    private function getIdCiudad($ciudad){

        $this->connection = Connection::GetInstance();
        $idRetornar = null;
        $query = "SELECT IdCiudad AS id FROM Ciudad WHERE nombre = '$ciudad' ";
        $resultado = $this->connection->Execute($query);

        if(empty($resultado)){
            $query = "INSERT INTO Ciudad (Nombre) VALUES (:ciudad)";
            $parameters['ciudad'] = $ciudad;

            $this->connection->ExecuteNonQuery($query, $parameters);

            $query = "SELECT MAX(IdCiudad) AS id FROM Ciudad";

            $idRetornar = $this->connection->Execute($query);
        }
        else{
            $idRetornar = $resultado;
        }

        return $idRetornar[0][0];
    }
    
    public function getAll(){
    }

   /* public function add($dueño)
    {
        $this->RetrieveData();
        array_push($this->dueñosLista, $dueño);
        $this->SaveData();
    }

    public function remove($id)
    {
        $this->RetrieveData();

        if (!empty($this->dueñosLista)) {
            foreach ($this->dueñosLista as $dueño) {
                if ($id == $dueño->getId()) {
                    $index = array_search($dueño, $this->dueñosLista);
                    array_splice($this->dueñosLista, $index, 1);
                    $this->SaveData();
                }
            }
        }
    }

    public function getAll()
    {
        $this->RetrieveData();
        return $this->dueñosLista;
    }
    
    public function getById($id)
    {
        $this->RetrieveData();

        $dueño = null;

        if (!empty($this->dueñosLista)) {
            foreach ($this->dueñosLista as $dueñoValue) {
                if ($id == $dueñoValue->getId()) {
                    $dueño = $dueñoValue;
                }
            }
        }

        return $dueño;
    }
    
    
    // métodos JSON

    private function RetrieveData()
    {
        $this->dueñosLista = array();

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $dueño = new Dueño($content["id"], $content["nombre"], $content["apellido"], $content['fechaNacimiento'], $content['dni'], $content['telefono'],  $content['email'], $content['ciudad'], $content['calle'], $content['numCalle']);

                array_push($this->dueñosLista, $dueño);
            }
        }
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->dueñosLista as $dueño) {
            $valuesArray = array();
            $valuesArray["id"] = $dueño->getId();
            $valuesArray["nombre"] = $dueño->getNombre();
            $valuesArray["apellido"] = $dueño->getApellido();
            $valuesArray["fechaNacimiento"] = $dueño->getFechaNacimiento();
            $valuesArray["dni"] = $dueño->getDni();
            $valuesArray["telefono"] = $dueño->getTelefono();
            $valuesArray["email"] = $dueño->getEmail();
            $valuesArray["ciudad"] = $dueño->getCiudad();
            $valuesArray["calle"] = $dueño->getCalle();
            $valuesArray["numCalle"] = $dueño->getNumCalle();
            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }*/
}
?>
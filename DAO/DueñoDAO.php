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
        try{
            $this->connection = Connection::GetInstance();

            $query = "INSERT INTO Duenio (IdUser, IdCiudad, Nombre, Apellido, FechaNacimiento, Dni, Telefono, Email, Calle, NumCalle)
                      VALUES (:IdUser, :IdCiudad, :Nombre, :Apellido, :FechaNacimiento, :Dni, :Telefono, :Email, :Calle, :NumCalle)";

            $parameters['IdUser'] = $dueño->getId();
            $parameters['IdCiudad'] = $this->getIdCiudad($dueño->getCiudad());
            $parameters['Nombre'] = $dueño->getNombre();
            $parameters['Apellido'] = $dueño->getApellido();
            $parameters['FehaNacimiento'] = $dueño->getfechaNacimiento();
            $parameters['Dni'] = $dueño->getDni();
            $parameters['Telefono'] = $dueño->getTelefono();
            $parameters['Email'] = $dueño->getEmail();
            $parameters['Calle'] = $dueño->getCalle();
            $parameters['NumCalle'] = $dueño->getNumCalle();


            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $e){
            throw $e;
        }
    }

    public function getById($id)
    {
        
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

   private function getByUsername($username){

       /* $this->connection = Connection::GetInstance();
        $usernameEncontrado = null;
        $query = "SELECT Raza.IdRaza AS id FROM Raza WHERE Raza.Raza = '$nombreRaza' ";
        $resultado = $this->connection->Execute($query);

        if(empty($resultado)){
            $query = "INSERT INTO Raza (Raza, Especie) VALUES (:nombreRaza, :tipoMascota)";
            $parameters['nombreRaza'] = $nombreRaza;
            $parameters['tipoMascota'] = $tipoMascota;
            $this->connection->ExecuteNonQuery($query, $parameters);
            $query = "SELECT MAX(IdRaza) AS id FROM Raza";
            $idRetornar = $this->connection->Execute($query);
        }
        else{
            $idRetornar = $resultado;
        }

        return $idRetornar[0][0];*/
    }

    public function getAll(){
       /* try
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
        }*/
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
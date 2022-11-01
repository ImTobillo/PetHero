<?php 

namespace DAO;

use Models\User as User;
use DAO\IRepositorio as IRepositorio;
use DAO\Connection as Connection;
use Exception;
use PDOException;

class UserDAO implements IRepositorio
{
    private $usersList = array();
    private $fileName = ROOT . 'Data/users.json';

    private $connection;

    public function add($user){
        try{
            $this->connection = Connection::GetInstance();

            $query = "INSERT INTO User (IdTipo, Username, Contrasenia)
                      VALUES (:IdTipo, :Username, :Contrasenia)";

            $parameters['IdTipo'] = $this->getIdTipo($user->getTipoCuenta());
            $parameters['Username'] = $user->getUsername();
            $parameters['Contrasenia'] = $user->getPassword();

            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch(Exception $e){
            throw $e;
        }
    }

    private function getIdTipo($tipoCuenta){
        $this->connection = Connection::GetInstance();
        $idRetornar = null;
        $query = "SELECT IdTipo AS id FROM TipoUser WHERE Tipo = '$tipoCuenta' ";
        $resultado = $this->connection->Execute($query);

        if(empty($resultado)){
            $query = "INSERT INTO TipoUser (Tipo) VALUES (:tipo)";
            $parameters['tipo'] = $tipoCuenta;

            $this->connection->ExecuteNonQuery($query, $parameters);

            $query = "SELECT MAX(IdTipo) AS id FROM TipoUser";

            $idRetornar = $this->connection->Execute($query);
        }
        else{
            $idRetornar = $resultado;
        }

        return $idRetornar[0][0];
    }

    public function getById($id){

    }

    public function getAll()
    {
        
    }


    /*public function add($user)
    {
        $this->RetrieveData();
        $user->setId($this->GetNextId());
        array_push($this->usersList, $user);
        $this->SaveData();
    }

    public function remove($id)
    {
        $this->RetrieveData();

        if (!empty($this->usersList)) {
            foreach ($this->usersList as $user) {
                if ($id == $user->getId()) {
                    $index = array_search($user, $this->usersList);
                    array_splice($this->usersList, $index, 1);
                    $this->SaveData();
                }
            }
        }
    }

    public function getAll()
    {
        $this->RetrieveData();
        return $this->usersList;
    }
    
    public function getById($id)
    {
        $this->RetrieveData();

        $user = null;

        if (!empty($this->usersList)) {
            foreach ($this->usersList as $userValue) {
                if ($id == $userValue->getId()) {
                    $user = $userValue;
                }
            }
        }

        return $user;
    }
    
    // metodos User

    public function getByUser($username)
    {
        $this->RetrieveData();

        $user = null;

        if (!empty($this->usersList)) {
            foreach ($this->usersList as $userValue) {
                if ($username == $userValue->getUsername()) {
                    $user = $userValue;
                }
            }
        }

        return $user;
    }

    // métodos JSON

    private function RetrieveData()
    {
        $this->usersList = array();

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $user = new User($content['username'], $content['password'], $content['tipoCuenta']);
                $user->setId($content['id']);
                array_push($this->usersList, $user);
            }
        }
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->usersList as $user) {
            $valuesArray = array();
            $valuesArray["id"] = $user->getId();
            $valuesArray["username"] = $user->getUsername();
            $valuesArray["password"] = $user->getPassword();
            $valuesArray["tipoCuenta"] = $user->getTipoCuenta();

            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }

    private function GetNextId()
    {
        $id = 0;

        if (!empty($this->usersList))
            $id = end($this->usersList)->getId() + 1;

        return $id;
    }*/
}




?>
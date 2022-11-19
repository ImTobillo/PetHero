<?php

namespace JsonDAO;

use Models\User as User;
use JsonDAO\IRepositorio as IRepositorio;
use JsonDAO\GuardianDAO as GuardianDAO;
use JsonDAO\DueñoDAO as DueñoDAO;
use Exception;

class UserDAO implements IRepositorio
{
    private $usersList = array();
    private $fileName = ROOT . 'Data/users.json';

    public function add($user)
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

    public function validarEmail($email)
    {
        try {
            $dueñoDAO = new DueñoDAO();
            $guardianDAO = new GuardianDAO();
            $listaDuenios = $dueñoDAO->getAll();
            $listaGuardianes = $guardianDAO->getAll();

            foreach ($listaDuenios as $value) {
                if ($value->getEmail() == $email) {
                    throw new Exception("El email ya lo usa otra persona");
                }
            }

            foreach ($listaGuardianes as $value) {
                if ($value->getEmail() == $email) {
                    throw new Exception("El email ya lo usa otra persona");
                }
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function validarDni($dni)
    {
        try {
            $dueñoDAO = new DueñoDAO();
            $guardianDAO = new GuardianDAO();
            $listaDuenios = $dueñoDAO->getAll();
            $listaGuardianes = $guardianDAO->getAll();

            foreach ($listaDuenios as $value) {
                if ($value->getDni() == $dni) {
                    throw new Exception("El DNI ya lo tiene otra persona");
                }
            }

            foreach ($listaGuardianes as $value) {
                if ($value->getDni() == $dni) {
                    throw new Exception("El DNI ya lo tiene otra persona");
                }
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function validarUsername($user)
    {
        try {
            $this->RetrieveData();

            foreach ($this->usersList as $value) {
                if ($value->getUsername() == $user) {
                    throw new Exception("Nombre de usuario no disponible");
                }
            }

        } catch (Exception $e) {
            throw $e;
        }
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
    }
}

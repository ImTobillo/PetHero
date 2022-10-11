<?php 

namespace DAO;

use DAO\GuardianDAO as GuardianDAO;
use Models\Guardian as Guardian;
use DAO\IRepositorio as IRepositorio;
use Models\Persona;

class GuadianDAO implements IRepositorio
{
    private $guardianList = array();
    private $fileName = ROOT . 'Data/guardianes.json';

    public function add(Guardian $guardian)
    {
        $this->RetrieveData();
        $guardian->setId($this->GetNextId());
        array_push($this->guardianList, $guardian);
        $this->SaveData();
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

    public function getAll()
    {
        $this->RetrieveData();
        return $this->guardianList;
    }
    
    public function getById($id)
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
    
    private function RetrieveData()
    {
        $this->guardianList = array();

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $guardian = new Guardian($content["nombre"], $content["apellido"], $content['fechaNacimiento'], $content['dni'], $content['telefono'],  $content['email'], $content['contraseña'], $content['ciudad'], $content['calle'], $content['numCalle']);
                
                array_push($this->guardianList, $guardian);
            }
        }
    }


    // métodos JSON

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->guardianList as $guardian) {
            $valuesArray = array();
            $valuesArray["id"] = $guardian->getId();
            $valuesArray["code"] = $guardian->getCode();
            $valuesArray["brand"] = $guardian->getBrand();
            $valuesArray["model"] = $guardian->getModel();
            $valuesArray["price"] = $guardian->getPrice();
            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }

    private function GetNextId()
    {
        $id = 0;

        if (!empty($this->guardianList))
            $id = end($this->guardianList)->getId() + 1;

        return $id;
    }
}
?>
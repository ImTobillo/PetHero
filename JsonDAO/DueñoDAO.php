<?php

namespace JsonDAO;

use Models\Dueño as Dueño;
use DAO\IRepositorio as IRepositorio;

class DueñoDAO implements IRepositorio
{ 
   
    private $dueñosLista = array();
    private $fileName = ROOT . 'Data/dueños.json';
   
   public function add($dueño)
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
    }
}

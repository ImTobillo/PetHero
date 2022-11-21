<?php

namespace JsonDAO;

use Models\Guardian as Guardian;
use DAO\IRepositorio as IRepositorio;

class GuardianDAO implements IRepositorio
{
    private $guardianList = array();    
    private $fileName = ROOT . 'Data/guardianes.json';

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

    public function getById($id)
    {
        $this->RetrieveData();

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

    public function filtrar($fechaInicio, $fechaFinal)
    {
        $this->RetrieveData();

        $resultado = array();

        if (!empty($this->guardianList)) {
            foreach ($this->guardianList as $guardianValue) {
                if ($guardianValue->getFechaInicio() <= $fechaInicio && $guardianValue->getFechaFinal() >= $fechaInicio && $guardianValue->getFechaFinal() >= $fechaFinal && $guardianValue->getFechaInicio() <= $fechaFinal) {
                    array_push($resultado, $guardianValue);
                }
            }
        }

        return $resultado;
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
}
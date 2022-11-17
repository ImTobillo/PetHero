<?php

namespace DAO;

use DAO\IRepositorio as IRepositorio;
use Models\Mascota as Mascota;
use Models\Perro as Perro;
use Models\Gato as Gato;

class MascotaDAO implements IRepositorio
{
    private $listMascotas = array();
    private $fileName = ROOT . 'Data/mascotas.json';

    private function GetNextId()
    {
        $id = 0;

        if (!empty($this->listMascotas))
            $id = end($this->listMascotas)->getId() + 1;

        return $id;
    }

    public function getById($id)
    {
        $this->RetrieveData();

        $mascota = null;

        if (!empty($this->mascotaList)) {
            foreach ($this->mascotaList as $mascotaValue) {
                if ($id == $mascotaValue->getId()) {
                    $mascota = $mascotaValue;
                }
            }
        }

        return $mascota;
    }

    public function add($mascota)
    {
        $this->RetrieveData();
        $mascota->setId($this->GetNextId());
        array_push($this->listMascotas, $mascota);
        $this->SaveData();
    }

    public function SaveData()
    {

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

    public function RetrieveData()
    {

        $this->listMascotas = array();

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {

                if ($content['tipoMascota'] == "Perro") {
                    $mascota = new Perro($content['idDueño'], $content['tipoMascota'], $content['nombre'], $content['tamaño'], $content['edad'], $content['raza'], $content['observaciones'], $content['planVacunacion'], $content['imgPerro'], $content['videoPerro']);
                } else {
                    $mascota = new Gato($content['idDueño'], $content['tipoMascota'], $content['nombre'], $content['tamaño'], $content['edad'], $content['raza'], $content['observaciones'], $content['planVacunacion'], $content['imgPerro'], $content['videoPerro']);
                }

                $mascota->setId($content['id']);

                array_push($this->listMascotas, $mascota);
            }
        }
    }

    public function getAll()
    {
        $this->RetrieveData();
        return $this->listMascotas;
    }
}

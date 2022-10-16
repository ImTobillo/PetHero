<?php 

namespace DAO;

use DAO\IRepositorio as IRepositorio;
use Models\Mascota as Mascota;

class MascotaDAO implements IRepositorio{

    private $listMascotas = array();
    private $fileName = ROOT . 'Data/mascotas.json';

    public function add($mascota)
    {
        $this->RetrieveData();
        $mascota->setId($this->GetNextId());
        array_push($this->listMascotas, $mascota);
        $this->SaveData();
    }

    public function remove($id)
    {
        $this->RetrieveData();
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

    public function getById($id)
    {
        $this->RetrieveData();

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

    public function getAll()
    {
        $this->RetrieveData();
        return $this->listMascotas;
    }

    public function RetrieveData(){

        $this->listMascotas = array();

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $mascota = new Mascota();

                $mascota->setId($content['id']);
                $mascota->setIdDueño($content['idDueño']);
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

    public function SaveData(){

        $arrayToEncode = array();

        foreach ($this->listMascotas as $mascota) {
            $valuesArray = array();
            $valuesArray['id'] = $mascota->getId();
            $valuesArray['idDueño'] = $mascota->getIdDueño();
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

    private function GetNextId()
    {
        $id = 0;

        if (!empty($this->listMascotas))
            $id = end($this->listMascotas)->getId() + 1;

        return $id;
    }

}

?>
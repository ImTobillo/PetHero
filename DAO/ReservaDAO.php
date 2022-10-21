<?php 

namespace DAO;

use Models\Reserva as Reserva;
use DAO\IRepositorio as IRepositorio;

class ReservaDAO implements IRepositorio
{
    private $reservaLista = array();
    private $fileName = ROOT . 'Data/reservas.json';

    public function add($reserva)
    {
        $this->RetrieveData();
        array_push($this->reservaLista, $reserva);
        $this->SaveData();
    }

    public function remove($id)
    {
        $this->RetrieveData();

        if (!empty($this->reservaLista)) {
            foreach ($this->reservaLista as $reserva) {
                if ($id == $reserva->getId()) {
                    $index = array_search($reserva, $this->reservaLista);
                    array_splice($this->reservaLista, $index, 1);
                    $this->SaveData();
                }
            }
        }
    }

    public function getAll()
    {
        $this->RetrieveData();
        return $this->reservaLista;
    }
    
    public function getById($id)
    {
        $this->RetrieveData();

        $reserva = null;

        if (!empty($this->reservaLista)) {
            foreach ($this->reservaLista as $reservaValues) {
                if ($id == $reservaValues->getId()) {
                    $reserva = $reservaValues;
                }
            }
        }

        return $reserva;
    }
    
    
    // métodos JSON

    private function RetrieveData()
    {
        $this->reservaLista = array();

        if (file_exists($this->fileName)) {
            $jsonToDecode = file_get_contents($this->fileName);

            $contentArray = ($jsonToDecode) ? json_decode($jsonToDecode, true) : array();

            foreach ($contentArray as $content) {
                $reserva = new Reserva($content['id_reserva'], $content['id_guardian'], $content['id_dueño'], $content['fecha_inicio'], $content['fecha_final'], $content['hora_inicio'], $content['hora_final']);
                $reserva->setEstado($content['estado']);

                array_push($this->reservaLista, $reserva);
            }
        }
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach ($this->reservaLista as $reserva) {
            $valuesArray = array();
            $valuesArray["id_reserva"] = $reserva->getId_reserva();
            $valuesArray["id_guardian"] = $reserva->getId_guardian();
            $valuesArray["id_dueño"] = $reserva->getId_dueño();
            $valuesArray["fecha_inicio"] = $reserva->getFecha_inicio();
            $valuesArray["fecha_final"] = $reserva->getFecha_final();
            $valuesArray["hora_inicio"] = $reserva->getHora_inicio();
            $valuesArray["hora_final"] = $reserva->getHora_final();
            $valuesArray["estado"] = $reserva->getEstado();

            array_push($arrayToEncode, $valuesArray);
        }

        $fileContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);

        file_put_contents($this->fileName, $fileContent);
    }
}
?>
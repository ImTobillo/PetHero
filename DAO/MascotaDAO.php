<?php 

namespace DAO;

use DAO\IRepositorio as IRepositorio;
use Models\Mascota as Mascota;

class MascotaDAO implements IRepositorio{

    private $listMascotas = array();
    private $fileName = ROOT . 'Data/mascotas.json';

    public function add(object $obj)
    {
        
    }

    public function remove($id)
    {
        
    }

    public function getById($id)
    {
        
    }

    public function getAll()
    {
        //$this->RetriveData();
        return $this->listMascotas;
    }



}

?>
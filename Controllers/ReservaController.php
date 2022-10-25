<?php 

namespace Controllers;

use Models\Reserva as Reserva;
use DAO\ReservaDAO as ReservaDAO;

class ReservaController
{
    private $reservaDAO;

    function __construct()
    {
        $this->reservaDAO = new ReservaDAO;
    }

    public function ShowListaReservas()
    {
        $listaReservas = $this->reservaDAO->getAll();
        require_once 'visualizarFechasSolicitadas.php';
    }

    public function aceptarReserva($id)
    {
        
    }


}


?>
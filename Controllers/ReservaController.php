<?php 

namespace Controllers;

use Models\Reserva as Reserva;
use DAO\ReservaDAO as ReservaDAO;
use DAO\MascotaDAO as MascotaDAO;

class ReservaController
{
    private $reservaDAO;
    private $mascotaDAO;

    function __construct()
    {
        $this->reservaDAO = new ReservaDAO;
        $this->mascotaDAO = new MascotaDAO;
    }

    public function ShowListaReservas()
    {
        $listaReservas = $this->reservaDAO->getAll();
        require_once 'visualizarFechasSolicitadas.php';
    }

    public function solicitarReserva($fechaInicio, $fechaFinal, $horaInicial, $horaFinal, $mascota, $id_guardian){
        $reserva = new Reserva($id_guardian, $_SESSION['loggedUser']->getId(), $fechaInicio, $fechaFinal, $horaInicial, $horaFinal, $mascota);

        $this->reservaDAO->add($reserva);

        require_once(VIEWS_PATH . 'MenuDueño.php');
    }

    public function aceptarReserva($id)
    {
        $this->reservaDAO->setEstadoReserva($id, "Aceptado");
    }

    public function rechazarReserva($id)
    {
        $this->reservaDAO->setEstadoReserva($id, "Rechazado");
    }
}


?>
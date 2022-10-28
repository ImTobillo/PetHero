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
        require_once VIEWS_PATH . 'visualizarFechasSolicitadas.php';
    }

    public function solicitarReserva($dia, $horaInicial, $horaFinal, $mascota, $id_guardian){
        $reserva = new Reserva($id_guardian, $_SESSION['loggedUser']->getId(), $dia, $horaInicial, $horaFinal, $mascota);

        $this->reservaDAO->add($reserva);

        require_once(VIEWS_PATH . 'MenuDueño.php');
    }

    public function aceptarReserva($id)
    {
        $this->reservaDAO->setEstadoReserva($id, "Aceptado");
        $this->ShowListaReservas();
    }

    public function rechazarReserva($id)
    {
        $this->reservaDAO->setEstadoReserva($id, "Rechazado");
        $this->ShowListaReservas();
    }

    public function puedeAceptarRaza($reserva) // se valida que no haya otra raza aceptada en la misma fecha
    {
        $bool = true;
        
        $listaReservas = $this->reservaDAO->getAll();

        foreach ($listaReservas as $reservaValue) {
            if (($reservaValue->getEstado() == "Aceptado")  
            && ($reservaValue->dia == $reserva->getDia()) 
            && ($this->mascotaDAO->getById($reservaValue->getId_mascota())->getRaza() != $reserva->getRaza())) 
                $bool = false;
        }

        return $bool;
    }
}


?>
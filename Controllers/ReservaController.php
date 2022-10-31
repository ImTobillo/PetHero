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
        require_once VIEWS_PATH . 'validarSesion.php';
        $listaReservas = $this->reservaDAO->getAll();
        require_once VIEWS_PATH . 'visualizarFechasSolicitadas.php';
    }

    public function solicitarReserva($fechaInicio, $fechaFinal, $horaInicial, $horaFinal, $mascota, $id_guardian){
        $reserva = new Reserva($id_guardian, $_SESSION['loggedUser']->getId(), $fechaInicio, $fechaFinal, $horaInicial, $horaFinal, $mascota);

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

    public function puedeAceptarRaza($reserva) // se valida que no haya otra raza ACEPTADA en la misma fecha
    {
        $bool = true;
        
        $listaReservas = $this->reservaDAO->getAll();

        foreach ($listaReservas as $reservaValue) {
            if (($reservaValue->getId_guardian() == $reserva->getId_guardian()) // si este guardian
            && ($reservaValue->getEstado() == "Aceptado")  // ya acepto una mascota
            && (($reservaValue->getFechaInicio() <= $reserva->getFechaFinal()))  // en las mismas fechas
            && ($this->mascotaDAO->getById($reservaValue->getId_mascota())->getRaza() != $this->mascotaDAO->getById($reserva->getId_mascota())->getRaza())) // con una raza distinta
                    $bool = false; // no puede cuidar una raza distinta
        }

        return $bool; 
    }
}


?>
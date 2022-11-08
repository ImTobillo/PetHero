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
            && (($reserva->getFechaFinal() >= $reservaValue->getFechaInicio() && $reserva->getFechaFinal() <= $reservaValue->getFechaFinal()) || ($reserva->getFechaInicio() <= $reservaValue->getFechaFinal() && $reserva->getFechaInicio() >= $reservaValue->getFechaInicio()))  // en las mismas fechas
            && ($this->mascotaDAO->getById($reservaValue->getId_mascota())->getRaza() != $this->mascotaDAO->getById($reserva->getId_mascota())->getRaza() || $reservaValue->getId_mascota() == $reserva->getId_mascota())) // con una raza distinta o a la misma mascota
                    $bool = false; // no puede cuidar una raza distinta
        }

        return $bool; 
    }

    public function ShowListPagos(){
        require_once VIEWS_PATH . 'validarSesion.php';
        $reservas = $this->reservaDAO->getAll();
        require_once (VIEWS_PATH . 'VerPagosPendientes.php');
    }

    public function borrarReserva($idReserva){
        $this->reservaDAO->remove($idReserva);
        $this->ShowListPagos();
     }
}


?>
<?php

namespace Controllers;

use Models\Guardian as Guardian;
use DAO\GuardianDAO as GuardianDAO;
use DAO\ReservaDAO as ReservaDAO;
use DAO\DueñoDAO as DueñoDAO;
use DAO\PagoDAO as PagoDAO;
use DAO\MascotaDAO as MascotaDAO;

/*use JsonDAO\GuardianDAO as GuardianDAO;
use JsonDAO\ReservaDAO as ReservaDAO;
use JsonDAO\DueñoDAO as DueñoDAO;
use JsonDAO\PagoDAO as PagoDAO;
use JsonDAO\MascotaDAO as MascotaDAO;*/

use Exception;

class GuardianController
{
    private $guardianDAO;
    private $reservasDAO;
    private $pagoDAO;
    private $dueñoDAO;
    private $mascotaDAO;

    function __construct()
    {
        $this->guardianDAO = new GuardianDAO();
        $this->reservasDAO = new ReservaDAO();
        $this->pagoDAO = new PagoDAO();
        $this->dueñoDAO = new DueñoDAO();
        $this->mascotaDAO = new MascotaDAO();
    }

    /*FUNCIONES VISTAS*/
    public function ShowHistorial()
    {
        try {
            require_once VIEWS_PATH . 'validarSesion.php';
            $listaPagos = $this->pagoDAO->getAll();
            $listaReservas = $this->reservasDAO->getAll();
            require_once VIEWS_PATH . 'verHistorialServOfrecidos-guardian.php';
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->ShowMenuGuardian($errorMessage);
        }
    }

    public function ShowListView($errorMessage = null)
    {
        try {
            require_once VIEWS_PATH . 'validarSesion.php';
            $guardianList = $this->guardianDAO->getAll();
            require_once VIEWS_PATH . 'VisualizarGuardianes.php';
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            require_once VIEWS_PATH . 'MenuDueño.php';
        }
    }

    public function ShowMenuGuardian($errorMessage = null)
    {
        require_once VIEWS_PATH . 'validarSesion.php';
        require_once VIEWS_PATH . 'MenuGuardian.php';
    }

    public function ShowEditar()
    {
        require_once(VIEWS_PATH . 'editar-guardian.php');
    }

    public function ShowVerPerfil($errorMessage = null)
    {
        require_once(VIEWS_PATH . 'ver-perfil-guardian.php');
    }

    /*DATOS GUARDIAN*/
    public function agregarGuardian($remuneracion, $tamanio, $fechaInicio, $fechaFinal, $horaInicial, $horaFinal)
    {
        try {
            $guardianNuevo = $_SESSION['loggedUser'];

            $guardianNuevo->setRemuneracion($remuneracion);
            $guardianNuevo->setTamaño($tamanio);
            $guardianNuevo->setFechaInicio($fechaInicio);
            $guardianNuevo->setFechaFinal($fechaFinal);
            $guardianNuevo->setHoraDisponible($horaInicial . ' - ' . $horaFinal);

            $_SESSION['loggedUser'] = $guardianNuevo;

            $this->guardianDAO->add($guardianNuevo);

            $this->ShowMenuGuardian();
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            require_once VIEWS_PATH . 'registro2-guardian.php';
        }
    }

    /*LOGICA*/
    public function filtrarGuardianes($fechaInicio = "", $fechaFinal = "")
    {
        try {

            if (!empty($fechaInicio) && !empty($fechaFinal)) {
                $guardianList = $this->guardianDAO->filtrar($fechaInicio, $fechaFinal);
            } else {
                $guardianList = $this->guardianDAO->getAll();
            }

            require_once(VIEWS_PATH . 'VisualizarGuardianes.php');
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->ShowListView($errorMessage);
        }
    }

    public function Editar($tamanio, $remuneracion, $fechaInicio, $fechaFinal, $horaInicial, $horaFinal, $idGuardian)
    {
        try {
            $horaDisponible = $horaInicial . '-' . $horaFinal;

            $this->guardianDAO->edit($idGuardian, $tamanio, $remuneracion, $fechaInicio, $fechaFinal, $horaDisponible);
            $this->ShowVerPerfil();
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->ShowVerPerfil($errorMessage);
        }
    }
}

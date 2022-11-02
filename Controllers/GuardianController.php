<?php 

namespace Controllers;

use Models\Guardian as Guardian;
use DAO\GuardianDAO as GuardianDAO;
use DAO\ReservaDAO as ReservaDAO;
use DAO\DueñoDAO as DueñoDAO;
use DAO\PagoDAO as PagoDAO;
use DAO\MascotaDAO as MascotaDAO;
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

    public function ShowHistorial()
    {
        require_once VIEWS_PATH . 'validarSesion.php';
        $listaReservas = $this->reservasDAO->getAll();
        require_once VIEWS_PATH . 'verHistorialServOfrecidos-guardian.php';
    }

    public function ShowListView()
    {
        require_once VIEWS_PATH . 'validarSesion.php';
        $guardianList = $this->guardianDAO->getAll();
        require_once VIEWS_PATH . 'VisualizarGuardianes.php';
    }

    public function ShowMenuGuardian(){
        require_once VIEWS_PATH . 'validarSesion.php';
        require_once VIEWS_PATH . 'MenuGuardian.php';
    }

    public function agregarGuardian($remuneracion, $tamanio, $fechaInicio, $fechaFinal, $horaInicial, $horaFinal)
    {
        $guardianNuevo = $_SESSION['loggedUser'];

        $guardianNuevo->setRemuneracion($remuneracion);
        $guardianNuevo->setTamaño($tamanio);
        $guardianNuevo->setFechaInicio($fechaInicio);
        $guardianNuevo->setFechaFinal($fechaFinal);
        $guardianNuevo->setHoraDisponible($horaInicial . ' - ' . $horaFinal);

        $_SESSION['loggedUser'] = $guardianNuevo;

        $this->guardianDAO->add($guardianNuevo);

        $this->ShowMenuGuardian();
    }

    public function filtrarGuardianes($fechaInicio = "", $fechaFinal =""){
        
        if(!empty($fechaInicio) && !empty($fechaFinal)){
            $guardianList = $this->guardianDAO->filtrar($fechaInicio, $fechaFinal);        
        }else{
            $guardianList = $this->guardianDAO->getAll();
        }
        
       
        

        require_once(VIEWS_PATH . 'VisualizarGuardianes.php');
    }
}

?>
<?php 

namespace Controllers;

use Models\Guardian as Guardian;
use DAO\GuardianDAO as GuardianDAO;

class GuardianController
{
    private $guardianDAO;

    function __construct()
    {
        $this->guardianDAO = new GuardianDAO();
    }

    public function ShowListView()
    {
        $guardianList = $this->guardianDAO->getAll();
        require_once VIEWS_PATH . 'VisualizarGuardianes.php';
    }

    public function agregarGuardian($remuneracion, $tamanio, $disponibilidad, $horaInicial, $horaFinal)
    {
        $guardianNuevo = $_SESSION['loggedUser'];

        $guardianNuevo->setRemuneracion($remuneracion);
        $guardianNuevo->setTamaño($tamanio);
        $guardianNuevo->setDiasDisponibles($disponibilidad);
        $guardianNuevo->setHoraDisponible($horaInicial . ' - ' . $horaFinal);

        $_SESSION['loggedUser'] = $guardianNuevo;

        $this->guardianDAO->add($guardianNuevo);

        require_once VIEWS_PATH . 'MenuGuardian.php';
    }
}

?>
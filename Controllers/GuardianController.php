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

    public function agregarGuardian($remuneracion, $tamanio, $disponibilidad, $horaInicial, $horaFinal)
    {
        $guardianNuevo = $_SESSION['loggedUser'];

        $guardianNuevo->setRemuneracion($remuneracion);
        $guardianNuevo->setTamaño($tamanio);
        //$guardianNuevo->disponibilidad(implode());

        $_SESSION['loggedUser'] = $guardianNuevo;
    }
}

?>
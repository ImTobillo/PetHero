<?php 

namespace Controllers;

use Models\Dueño as Dueño;
use DAO\GuardianDAO as GuardianDAO;
use DAO\MascotaDAO as MascotaDAO;

class DuenioController
{
   private $listaGuardianes;
   private $listaMascotas;

   function __construct()
   {
      $listaGuardianes = new GuardianDAO();
      $listaMascotas = new MascotaDAO();
   }

     public function ShowViewReservar($id_guardian){
        require_once VIEWS_PATH . 'validarSesion.php';

      $guardian = $listaGuardianes->getById($id_guardian);
      $mascotasDuenio = $listaMascotas->getAll();

        require_once(VIEWS_PATH . 'reservar-guardian.php');
     }

     
}


?>
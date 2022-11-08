<?php 

namespace Controllers;

use Models\Dueño as Dueño;

class DuenioController
{

     public function ShowViewReservar($id_guardian){
        require_once VIEWS_PATH . 'validarSesion.php';

        require_once(VIEWS_PATH . 'reservar-guardian.php');
     }
      
 
}


?>
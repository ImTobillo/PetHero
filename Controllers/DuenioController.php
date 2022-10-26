<?php 

namespace Controllers;

use Models\Dueño as Dueño;
use DAO\DueñoDAO as DueñoDAO;

class DuenioController
{
     private $dueñosDAO;
     
     function __construct()
     {
        $this->dueñosDAO = new DueñoDAO();
     }

     public function ShowViewReservar(){
         require_once(VIEWS_PATH . 'reservar-guardian.php');
     }
 
}


?>
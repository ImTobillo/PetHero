<?php 

namespace Controllers;

use Models\Dueño as Dueño;
use DAO\DueñoDAO as DueñoDAO;

class DueñoController
{
     private $dueñosDAO;
     
     function __construct()
     {
        $this->dueñosDAO = new DueñoDAO();
     }

     
}


?>
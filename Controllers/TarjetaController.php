<?php 

namespace Controllers;

use Models\Tarjeta as Tarjeta;
use DAO\TarjetaDAO as TarjetaDAO;

class TarjetaController{
    private $tarjetaDAO;

    public function __construct(){
        $this->tarjetaDAO = new TarjetaDAO();
    }

/*FUNCIONES DE VISTAS*/
    public function ShowAddTarjeta(){
        require_once(VIEWS_PATH . 'agregarTarjeta.php');
    }

    public function ShowPagar(){
        require_once(VIEWS_PATH . 'pagar.php');
    }

    
    public function agregarTarjeta($tipoTarjeta, $titular, $nroTarjeta, $codSeguridad, $fechaVencimiento){
        $tarjeta = new Tarjeta($tipoTarjeta, $nroTarjeta, $_SESSION['loggedUser']->getId(), $titular, $codSeguridad, $fechaVencimiento);
        //validar vencimiento
        $this->tarjetaDAO->add($tarjeta);
        $this->ShowPagar();
    }
}

?>
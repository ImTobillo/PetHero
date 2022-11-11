<?php 

namespace Controllers;

use Models\Tarjeta as Tarjeta;
use DAO\TarjetaDAO as TarjetaDAO;
use DAO\PagoDAO as PagoDAO;

class TarjetaController{
    private $tarjetaDAO;
    private $pagoDAO;

    public function __construct(){
        $this->tarjetaDAO = new TarjetaDAO();
        $this->pagoDAO = new PagoDAO();
    }

/*FUNCIONES DE VISTAS*/
    public function ShowAddTarjeta($IdPago){
        require_once(VIEWS_PATH . 'agregarTarjeta.php');
    }

    public function ShowPagar($IdPago){
        $pago = $this->pagoDAO->getById($IdPago);
        require_once(VIEWS_PATH . 'Pagar.php');
    }

    
    public function agregarTarjeta($tipoTarjeta, $titular, $nroTarjeta, $codSeguridad, $fechaVencimiento, $IdPago){
        $tarjeta = new Tarjeta($tipoTarjeta, $nroTarjeta, $_SESSION['loggedUser']->getId(), $titular, $codSeguridad, $fechaVencimiento);
        //validar vencimiento
        $this->tarjetaDAO->add($tarjeta);
        $this->ShowPagar($IdPago);
    }
}

?>
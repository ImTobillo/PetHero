<?php

namespace Controllers;

use Models\Tarjeta as Tarjeta;
use DAO\TarjetaDAO as TarjetaDAO;
use DAO\PagoDAO as PagoDAO;

//use JsonDAO\PagoDAO as PagoDAO;

use Exception;

class TarjetaController
{
    private $tarjetaDAO;
    private $pagoDAO;

    public function __construct()
    {
        $this->tarjetaDAO = new TarjetaDAO();
        $this->pagoDAO = new PagoDAO();
    }

    /*FUNCIONES DE VISTAS*/
    public function ShowAddTarjeta($IdPago, $errorMessage = null)
    {
        require_once(VIEWS_PATH . 'agregarTarjeta.php');
    }

    public function ShowPagar($IdPago)
    {
        try {
            $pago = $this->pagoDAO->getById($IdPago);
            require_once(VIEWS_PATH . 'Pagar.php');
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            require_once VIEWS_PATH . 'MenuDueño.php';
        }
    }


    public function agregarTarjeta($tipoTarjeta, $titular, $nroTarjeta, $codSeguridad, $fechaVencimiento, $IdPago)
    {
        try {
            $tarjeta = new Tarjeta($tipoTarjeta, $nroTarjeta, $_SESSION['loggedUser']->getId(), $titular, $codSeguridad, $fechaVencimiento);
            //validar vencimiento
            $this->tarjetaDAO->add($tarjeta);
            $this->ShowPagar($IdPago);
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->ShowAddTarjeta($IdPago, $errorMessage);
        }
    }
}

<?php

namespace Controllers;

use Models\Pago as Pago;
use DAO\PagoDAO as PagoDAO;
use DAO\ReservaDAO as ReservaDAO;

/*use JsonDAO\PagoDAO as PagoDAO;
use JsonDAO\ReservaDAO as ReservaDAO;*/

use Exception;

class PagoController
{

    private $pagoDAO;

    public function __construct()
    {
        $this->pagoDAO = new PagoDAO();
    }

    public function ShowListPagos($errorMessage = null)
    {
        try {
            require_once VIEWS_PATH . 'validarSesion.php';
            $reservas = $this->reservaDAO->getAllById($_SESSION['loggedUser']->getId());
            require_once(VIEWS_PATH . 'VerPagosPendientes.php');
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            require_once VIEWS_PATH . 'MenuDueño.php';
        }
    }

    public function ShowPagar($idPago)
    {
        try {
            require_once VIEWS_PATH . 'validarSesion.php';
            $pago = $this->pagoDAO->getById($idPago);
            require_once(VIEWS_PATH . 'Pagar.php');
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            $this->ShowListPagos($errorMessage);
        }
    }
}

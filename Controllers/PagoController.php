<?php
namespace Controllers;

use Models\Pago as Pago;
use DAO\PagoDAO as PagoDAO;

class PagoController{
    private $pagoDAO;

    public function __construct()
    {
        $this->pagoDAO = new PagoDAO();
    }

    public function ShowPagar($idPago){
        require_once VIEWS_PATH . 'validarSesion.php';
        $pago = $this->pagoDAO->getById($idPago);
        require_once(VIEWS_PATH . 'Pagar.php');
     }

     public function pagar(){
        //carga tarjeta
     }
}
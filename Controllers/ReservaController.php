<?php 

namespace Controllers;

require_once(ROOT.'PHPMailer/PHPMailer.php');
require_once(ROOT.'PHPMailer/SMTP.php');
require_once(ROOT.'PHPMailer/Exception.php');

use Models\Reserva as Reserva;
use Models\Pago as Pago;
use DAO\ReservaDAO as ReservaDAO;
use DAO\MascotaDAO as MascotaDAO;
use DAO\PagoDAO as PagoDAO;

use DAO\DueñoDAO AS DueñoDAO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use DateTime;

class ReservaController
{
    private $reservaDAO;
    private $dueñoDAO;
    private $mascotaDAO;
    private $pagoDAO;

    function __construct()
    {
        $this->dueñoDAO = new DueñoDAO();
        $this->reservaDAO = new ReservaDAO;
        $this->mascotaDAO = new MascotaDAO;
        $this->pagoDAO = new PagoDAO();
    }

    /*FUNCIONES VISTAS*/
    public function ShowListaReservas()
    {
        require_once VIEWS_PATH . 'validarSesion.php';
        $listaReservas = $this->reservaDAO->getAll();
        require_once VIEWS_PATH . 'visualizarFechasSolicitadas.php';
    }

    public function ShowListPagos()
    {
        require_once VIEWS_PATH . 'validarSesion.php';
        $reservas = $this->reservaDAO->getAllById($_SESSION['loggedUser']->getId());
        require_once (VIEWS_PATH . 'VerPagosPendientes.php');
    }

    /*SETEAR ESTADOS DE RESERVA*/
    public function aceptarReserva($id, $idDueño)
    {
        $this->reservaDAO->setEstadoReserva($id, "Aceptado"); 
        //generar cupon de pago

        $pago = new Pago();
        $pago->setFecha(date('Y-m-d'));
        $pago->setEstado('No pagado');
        $pago->setMonto($this->calcularMonto($id));
        $pago->setIdReserva($id);
        
        $this->pagoDAO->add($pago);
        
        $this->enviaEmail($idDueño);   // Envia email

        $this->ShowListaReservas();
    }

    public function rechazarReserva($id)
    {
        $this->reservaDAO->setEstadoReserva($id, "Rechazado");
        $this->ShowListaReservas();
    }

    public function confirmarReserva($tarjeta, $idPago)
    {

        $pago = $this->pagoDAO->getById($idPago);

        //seteo estado
        $this->reservaDAO->setEstadoReserva($pago->getIdReserva(), "Confirmado");

        //asigno la tarjeta al pago
        $this->pagoDAO->setTarjeta($tarjeta, $idPago);
        $this->ShowListPagos();
    }

    /*******/
    public function solicitarReserva($fechaInicio, $fechaFinal, $horaInicial, $horaFinal, $mascota, $id_guardian)
    {
        $reserva = new Reserva($id_guardian, $_SESSION['loggedUser']->getId(), $fechaInicio, $fechaFinal, $horaInicial, $horaFinal, $mascota);

        $this->reservaDAO->add($reserva);

        require_once(VIEWS_PATH . 'MenuDueño.php');
    }


    public function calcularMonto($idReserva)
    {

        $reserva = $this->reservaDAO->getById($idReserva);

        $monto =  ((int)(((new DateTime($reserva->getHora_inicio()))->diff(new DateTime($reserva->getHora_final())))->format('%H')) // cantidad de horas

                                  * ((int)(($reserva->getFechaInicio() != $reserva->getFechaFinal()) 
                                  ? ((new DateTime($reserva->getFechaInicio()))->diff((new DateTime($reserva->getFechaFinal()))))->format('%D') 
                                  : 1)+1) // = cantidad de días

                                  * $_SESSION["loggedUser"]->getRemuneracion() /* monto por hora */);
        return $monto;                                  

    }

    public function borrarReserva($idReserva)
    {
        $this->reservaDAO->remove($idReserva);
        $this->ShowListPagos();
    }

    /*VALIDACIONES*/

    public function puedeAceptarRaza($reserva) // se valida que no haya otra raza ACEPTADA en la misma fecha
    {
        $bool = true;
        
        $listaReservas = $this->reservaDAO->getAll();

        foreach ($listaReservas as $reservaValue) {
            if (($reservaValue->getId_guardian() == $reserva->getId_guardian()) // si este guardian
            && ($reservaValue->getEstado() == "Aceptado")  // ya acepto una mascota
            && (($reserva->getFechaFinal() >= $reservaValue->getFechaInicio() && $reserva->getFechaFinal() <= $reservaValue->getFechaFinal()) || ($reserva->getFechaInicio() <= $reservaValue->getFechaFinal() && $reserva->getFechaInicio() >= $reservaValue->getFechaInicio()))  // en las mismas fechas
            && ($this->mascotaDAO->getById($reservaValue->getId_mascota())->getRaza() != $this->mascotaDAO->getById($reserva->getId_mascota())->getRaza() || $reservaValue->getId_mascota() == $reserva->getId_mascota())) // con una raza distinta o a la misma mascota
                    $bool = false; // no puede cuidar una raza distinta
        }

        return $bool; 
    }

    public function enviaEmail($id){
        $dueño = $this->dueñoDAO->getById($id);

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';  //Esto varia         //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'petheroutn@gmail.com';                 //SMTP username
            $mail->Password   = 'jmgmbaurzxaxtkak';                            //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('petheroutn@gmail.com', 'El mejor grupo');
            $mail->addAddress($dueño->getEmail());     //Add a recipient
            // $mail->addAddress('lucreciadenisebazan@gmail.com');  //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Cupon de pago'; // Asunto
            $mail->Body    = "Se confirmo la reserva que solicitaste " . $dueño->getNombre() . " gracias por elegirnos.";
        
            $mail->send();
            echo 'Enviado correctamente';
        } catch (Exception $e) {
            echo "Hubo un error: {$mail->ErrorInfo}";
        }        
    }
    
}


?>
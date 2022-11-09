<?php

namespace Controllers;

require_once(ROOT.'PHPMailer/PHPMailer.php');
require_once(ROOT.'PHPMailer/SMTP.php');
require_once(ROOT.'PHPMailer/Exception.php');

use DAO\DueñoDAO AS DueñoDAO;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailController{

    static public function enviaEmail($id){
        
        $dueñoDAO = new DueñoDAO();
        $dueño = $dueñoDAO->getById($id);

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
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
            $mail->Subject = 'Recibo de pago'; // Asunto
            $mail->Body    = "Se confirmo tu pago " . $dueño->getNombre() . " gracias por elegirnos.";
        
            $mail->send();
            echo 'Enviado correctamente';
        } catch (Exception $e) {
            echo "Hubo un error: {$mail->ErrorInfo}";
        }        
    }

} 

?>
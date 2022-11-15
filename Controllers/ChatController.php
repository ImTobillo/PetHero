<?php 

namespace Controllers;

use DAO\UserDAO as UserDAO;
use DAO\ChatDAO as ChatDAO;
use DAO\GuardianDAO as GuardianDAO;
use DAO\DueñoDAO as DueñoDAO;
use DAO\MensajeDAO as MensajeDAO;
use Exception;

class ChatController
{
    private $chatDAO;
    private $userDAO;
    private $dueñoDAO;
    private $guardianDAO;

    function __construct()
    {
        $this->chatDAO = new ChatDAO;
        $this->guardianDAO = new GuardianDAO();
        $this->dueñoDAO = new DueñoDAO();
        $this->userDAO = new UserDAO();
    }

    public function verChat($id)
    {

    }

    public function enviarMensaje($idChat, $texto)
    {

    }

}

?>
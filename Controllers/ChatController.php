<?php

namespace Controllers;

use DAO\ChatDAO as ChatDAO;
use DAO\MensajeDAO as MensajeDAO;
use DAO\GuardianDAO as GuardianDAO;
use DAO\DueñoDAO as DuenioDAO;
use DAO\UserDAO as UserDAO;

/*use JsonDAO\GuardianDAO as GuardianDAO;
use JsonDAO\DueñoDAO as DuenioDAO;
use JsonDAO\UserDAO as UserDAO;*/

use Models\Mensaje;

class ChatController{

    private $mensajeDAO;
    private $chatDAO;
    private $guardianDAO;
    private $duenioDAO;
    private $userDAO;

    public function __construct()
    {
        $this->mensajeDAO = new MensajeDAO();
        $this->chatDAO = new ChatDAO();
        $this->duenioDAO = new DuenioDAO();
        $this->guardianDAO = new GuardianDAO();
        $this->userDAO = new UserDAO();
    }

    public function newChat($idGuardian){

        $idChat = $this->chatDAO->getByIdUserFromYUserTo($_SESSION['loggedUser']->getId(), $idGuardian);

        $this->ShowMensajes($idChat);

    }

    public function ShowChats(){

        if(get_class($_SESSION['loggedUser']) == "Models\Guardian"){
            $listaChats = $this->chatDAO->getAllByIdGuardian($_SESSION['loggedUser']->getId());
        }else{
            $listaChats = $this->chatDAO->getAllByIdDuenio($_SESSION['loggedUser']->getId());
        }
        
        require_once(VIEWS_PATH . 'Chats.php');
    }

    public function ShowMensajes($idChat){
        $chat = $this->chatDAO->getById($idChat);

        if(get_class($_SESSION['loggedUser']) == "Models\Guardian"){
            $To = $this->duenioDAO->getById($chat->getIdDuenio());
        }else{
            $To = $this->guardianDAO->getById($chat->getIdGuardian());
        } 

        $listaMensajes = $this->mensajeDAO->getAllByIdChat($idChat);
        require_once(VIEWS_PATH . 'Mensajes.php');
    }

    public function enviarMensaje($mensaje, $idTo){

        if (get_class($_SESSION['loggedUser']) == "Models\Dueño"){
            $idChat = $this->chatDAO->getByIdUserFromYUserTo($_SESSION['loggedUser']->getId(), $idTo);
        }else{
            $idChat = $this->chatDAO->getByIdUserFromYUserTo($idTo, $_SESSION['loggedUser']->getId());
        }

        if(get_class($_SESSION['loggedUser']) == "Models\Guardian"){
            $To = $this->duenioDAO->getById($idTo);
        }else{
            $To = $this->guardianDAO->getById($idTo);
        }
                
        $mensaje = new Mensaje($idChat, $_SESSION['loggedUser']->getId(), $idTo, $mensaje, date('Y-m-d'));
        
        $this->mensajeDAO->add($mensaje);

        $listaMensajes = $this->mensajeDAO->getAllByIdChat($idChat);
        require_once(VIEWS_PATH . 'Mensajes.php');
    }
}
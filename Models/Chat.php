<?php 

namespace Models;

class Chat
{
    private $idChat;
    private $idDuenio;
    private $idGuardian;

    function __construct($idDuenio, $idGuardian)
    {
        $this->idDuenio = $idDuenio;
        $this->idGuardian = $idGuardian;
    }
    
    public function getIdChat()
    {
        return $this->idChat;
    }

    public function setIdChat($idChat)
    {
        $this->idChat = $idChat;

        return $this;
    }

    public function getIdDuenio(){
        return $this->idDuenio;
    }

    public function getIdGuardian(){
        return $this->idGuardian;
    }
}

?>
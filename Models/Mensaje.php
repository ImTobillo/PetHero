<?php 

namespace Models;

class Mensaje
{
    private $idMensaje;
    private $idChat;
    private $idUserFrom;
    private $idUserTo;
    private $mensaje;
    private $fecha;

    function __construct($idChat, $idUserFrom, $idUserTo, $mensaje, $fecha)
    {
        $this->idChat = $idChat;
        $this->idUserFrom = $idUserFrom;
        $this->idUserTo = $idUserTo;
        $this->mensaje = $mensaje;
        $this->fecha = $fecha;
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

    public function getIdUserFrom()
    {
        return $this->idUserFrom;
    }

    public function setIdUserFrom($idUserFrom)
    {
        $this->idUserFrom = $idUserFrom;

        return $this;
    }

    public function getIdUserTo()
    {
        return $this->idUserTo;
    }

    public function setIdUserTo($idUserTo)
    {
        $this->idUserTo = $idUserTo;

        return $this;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getIdMensaje()
    {
        return $this->idMensaje;
    }

    public function setIdMensaje($idMensaje)
    {
        $this->idMensaje = $idMensaje;

        return $this;
    }
}

?>
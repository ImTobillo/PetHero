<?php 

namespace DAO;

use DAO\ChatDAO as ChatDAO;
use DAO\IRepositorio as IRepositorio;

class MensajeDAO implements IRepositorio
{
    private $connection;

    public function add($chat)
    {
        try {
            $this->connection = Connection::GetInstance();

            $query = "INSERT INTO Chat (IdUserFrom, IdUserTo, Mensaje, Fecha)
                      VALUES (:IdUserFrom, :IdUserTo, :Mensaje, :Fecha)";

            $parameters['IdUserFrom'] = $chat->getIdUserFrom();
            $parameters['IdUserTo'] = $chat->getIdUserTo();
            $parameters['Mensaje'] = $chat->getMensaje();
            $parameters['Fecha'] = $chat->getFecha();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getById($IdChat)
    {
        try {
            $this->connection = Connection::GetInstance();
            $query = "SELECT * FROM Chat WHERE IdChat = :IdChat ";
            
            $parameters['IdChat'] = $IdChat;

            $resultado = $this->connection->Execute($query, $parameters);

            $chat = new Chat(
                $resultado[0]['IdUserFrom'],
                $resultado[0]['IdUserTo'],
                $resultado[0]['Mensaje'],
                $resultado[0]['Fecha']
            );

            $chat->setIdChat($resultado[0]['IdChat']);

            return $chat;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll()
    {
        
    }

    public function getAllByIdUser($idUser)
    {
        try {
            $array = array();
            $query = "SELECT * FROM Chat WHERE IdUserFrom = :IdUserFrom";

            $parameters['IdUserFrom'] = $idUser;

            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query, $parameters);

            foreach ($resultado as $fila) {

                $chat = new Chat(
                    $resultado[0]['IdUserFrom'],
                    $resultado[0]['IdUserTo'],
                    $resultado[0]['Mensaje'],
                    $resultado[0]['Fecha']
                );

                $chat->setIdChat($resultado[0]['IdChat']);

                array_push($array, $chat);
            }

            return $array;
        } catch (Exception $e) {
            throw $e;
        }
    }
}

?>
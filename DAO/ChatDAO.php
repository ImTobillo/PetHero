<?php 

namespace DAO;

use DAO\IRepositorio as IRepositorio;
use Models\Chat as Chat;
use Exception;

class ChatDAO implements IRepositorio
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

    public function getByIdUserFromYUserTo($idUserFrom, $idUserTo)
    {
        try {
            $this->connection = Connection::GetInstance();
            $query = "SELECT * FROM Chat WHERE IdUserFrom = :IdUserFrom and IdUserTo = :IdUserTo";
            
            $parameters['IdUserFrom'] = $idUserFrom;
            $parameters['IdUserTo'] = $idUserTo;
            
            $resultado = $this->connection->Execute($query, $parameters);

            if (empty($resultado)) {
                $query = "INSERT INTO Chat (IdUserFrom, IdUserTo) VALUES (:IdUserFrom, IdUserTo, )";
                $parameters['Nombre'] = $nombre;

                $this->connection->ExecuteNonQuery($query, $parameters);

                $query = "SELECT MAX(IdCiudad) AS id FROM Ciudad";

                $idRetornar = $this->connection->Execute($query);
            } else {
                $chat = new Chat(
                    $resultado[0]['IdUserFrom'],
                    $resultado[0]['IdUserTo'],
                    $resultado[0]['Mensaje'],
                    $resultado[0]['Fecha']  
                );

                $chat->setIdChat($resultado[0]['IdChat']);
            }

            

            

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
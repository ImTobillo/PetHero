<?php 

namespace DAO;

use DAO\IRepositorio as IRepositorio;
use Models\Chat as Chat;
use DAO\Connection as Connection;
use Exception;
use PDOException;

class ChatDAO implements IRepositorio
{
    private $connection;

    public function add($chat)
    {
        try {
            $this->connection = Connection::GetInstance();

            $query = "INSERT INTO Chat (IdUserFrom, IdUserTo)
                      VALUES (:IdUserFrom, :IdUserTo)";

            $parameters['IdUserFrom'] = $chat->getIdUserFrom();
            $parameters['IdUserTo'] = $chat->getIdUserTo();

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
                $resultado[0]['IdUserTo']
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
            $idChat = null;
            $this->connection = Connection::GetInstance();
            $query = "SELECT * FROM Chat WHERE IdUserFrom = :IdUserFrom and IdUserTo = :IdUserTo";
            
            $parameters['IdUserFrom'] = $idUserFrom;
            $parameters['IdUserTo'] = $idUserTo;
            $resultado = $this->connection->Execute($query, $parameters);

            if (empty($resultado)) {
                $query = "INSERT INTO Chat (IdUserFrom, IdUserTo) VALUES (:IdUserFrom, IdUserTo)";
                $parameters['IdUserFrom'] = $idUserFrom;
                $parameters['idUserTo'] = $idUserTo;
                echo 'error';
                $this->connection->ExecuteNonQuery($query, $parameters);
                
                $query= "SELECT MAX(IdChat) FROM Chat";
                
                $idChat = $this->connection->Execute($query);

            } else {
                $idChat=$resultado[0]['IdChat'];
            }
            return $idChat;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll()
    {
        try{
            $array = array();
            $query = "SELECT * FROM chat";

            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query);

            foreach($resultado as $fila){

                $chat = new Chat(
                    $fila['IdUserFrom'],
                    $fila['IdUserTo']
                );

                $chat->setIdChat($fila['IdChat']);

                array_push($array, $chat);
            }
            return $array;
        }catch (Exception $e) {
            throw $e;
        }
    }

    public function getAllByIdDuenio($idUser)
    {
        try {
            $array = array();
            $query = "SELECT * FROM Chat WHERE IdUserFrom = :IdUserFrom";

            $parameters['IdUserFrom'] = $idUser;

            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query, $parameters);

            foreach ($resultado as $fila) {

                $chat = new Chat(
                    $fila['IdUserFrom'],
                    $fila['IdUserTo']
                );

                $chat->setIdChat($fila['IdChat']);

                array_push($array, $chat);
            }
            return $array;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAllByIdGuardian($idUser)
    {
        try {
            $array = array();
            $query = "SELECT * FROM Chat WHERE IdUserTo = :IdUserTo";

            $parameters['IdUserTo'] = $idUser;

            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query, $parameters);

            foreach ($resultado as $fila) {

                $chat = new Chat(
                    $resultado[0]['IdUserFrom'],
                    $resultado[0]['IdUserTo']
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
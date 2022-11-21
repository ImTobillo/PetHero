<?php 

namespace DAO;

use DAO\ChatDAO as ChatDAO;
use Models\Mensaje as Mensaje;
use DAO\IRepositorio as IRepositorio;
use DAO\Connection as Connection;
use Exception;
use PDOException;

class MensajeDAO implements IRepositorio
{
    private $connection;

    public function add($mensaje)
    {
        try {
            $this->connection = Connection::GetInstance();

            $query = "INSERT INTO Mensaje (IdChat, IdUserFrom, IdUserTo, Mensaje, Fecha)
                      VALUES (:IdChat, :IdUserFrom, :IdUserTo, :Mensaje, :Fecha)";

            $parameters['IdChat'] = $mensaje->getIdChat(); 
            $parameters['IdUserFrom'] = $mensaje->getIdUserFrom();
            $parameters['IdUserTo'] = $mensaje->getIdUserTo();
            $parameters['Mensaje'] = $mensaje->getMensaje();
            $parameters['Fecha'] = $mensaje->getFecha();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getById($IdMensaje)
    {
        try {
            $this->connection = Connection::GetInstance();
            $query = "SELECT * FROM Mensaje WHERE IdMensaje = :IdMensaje ";
            
            $parameters['IdMensaje'] = $IdMensaje;

            $resultado = $this->connection->Execute($query, $parameters);

            $mensaje = new Mensaje(
                $resultado[0]['IdChat'],
                $resultado[0]['IdUserFrom'],
                $resultado[0]['IdUserTo'],
                $resultado[0]['Mensaje'],
                $resultado[0]['Fecha']
            );

            return $mensaje;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAllByIdChat($idChat)
    {
        try{
            $array = array();
            $query = "SELECT * FROM Mensaje WHERE IdChat = :IdChat ORDER BY Fecha DESC";

            $parameters['IdChat'] = $idChat;

            $this->connection = Connection::GetInstance();
            $resultado= $this->connection->Execute($query, $parameters);

            foreach($resultado as $fila){

                $mensaje = new Mensaje(
                    $fila['IdChat'],
                    $fila['IdUserFrom'],
                    $fila['IdUserTo'],
                    $fila['Mensaje'],
                    $fila['Fecha']
                );

                array_push($array, $mensaje);
            }

            return $array;
        }catch(Exception $e){
            throw($e);
        }
    }

    public function getAllByIdUser($idUser)
    {
        try {
            $array = array();
            $query = "SELECT * FROM Mensaje WHERE IdUserFrom = :IdUserFrom";

            $parameters['IdUserFrom'] = $idUser;

            $this->connection = Connection::GetInstance();
            $resultado = $this->connection->Execute($query, $parameters);

            foreach ($resultado as $fila) {

                $chat = new Mensaje(
                    $resultado[0]['IdChat'],
                    $resultado[0]['IdUserFrom'],
                    $resultado[0]['IdUserTo'],
                    $resultado[0]['Mensaje'],
                    $resultado[0]['Fecha']
                );

                array_push($array, $chat);
            }

            return $array;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll(){

    }
}

?>
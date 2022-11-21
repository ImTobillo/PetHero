<?php

namespace DAO;

use Models\User as User;
use DAO\IRepositorio as IRepositorio;
use DAO\Connection as Connection;
use Exception;
use PDOException;

class UserDAO implements IRepositorio
{
    private $connection;

    public function add($user)
    {
        try {
            $this->connection = Connection::GetInstance();

            $query = "INSERT INTO User (IdTipo, Username, Contrasenia)
                      VALUES (:IdTipo, :Username, :Contrasenia)";

            $parameters['IdTipo'] = $this->getIdTipo($user->getTipoCuenta());
            $parameters['Username'] = $user->getUsername();
            $parameters['Contrasenia'] = $user->getPassword();

            $this->connection->ExecuteNonQuery($query, $parameters);
            
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getByUser($username)
    {

        try {
            $this->connection = Connection::GetInstance();
            $query = "SELECT * FROM User WHERE Username = :Username ";

            $parameters['Username'] = $username;

            $resultado = $this->connection->Execute($query, $parameters);

            if (empty($resultado)) {
                throw new Exception("El usuario no existe");
            } else {
                $user = new User($resultado[0]['Username'], $resultado[0]['Contrasenia'], $this->getTipo($resultado[0]['IdTipo']));
                $user->setId($resultado[0]['IdUser']);
            }

            return $user;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getById($id)
    {
        try {
            $this->connection = Connection::GetInstance();
            $query = "SELECT * FROM User WHERE IdUser = :id ";

            $parameters['id'] = $id;

            $resultado = $this->connection->Execute($query, $parameters);

            $user = new User($resultado[0]['Username'], $resultado[0]['Contrasenia'], $this->getTipo($resultado[0]['IdTipo']));
            $user->setId($resultado[0]['IdUser']);

            return $user;
        } catch (Exception $e) {
            throw $e;
        }
    }

    private function getTipo($id)
    {
        try {
            $this->connection = Connection::GetInstance();
            $query = "SELECT Tipo AS nombreTipo FROM TipoUser WHERE IdTipo = :id ";

            $parameters['id'] = $id;

            $resultado = $this->connection->Execute($query, $parameters);

            return $resultado[0][0];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getAll()
    {
    }

    private function getIdTipo($tipoCuenta)
    {
        try {
            $this->connection = Connection::GetInstance();
            $idRetornar = null;
            $query = "SELECT IdTipo AS id FROM TipoUser WHERE Tipo = :Tipo ";

            $parameters['Tipo'] = $tipoCuenta;

            $resultado = $this->connection->Execute($query, $parameters);
            
            if (empty($resultado)) {
                $query = "INSERT INTO TipoUser (Tipo) VALUES (:Tipo)";
                $parameters['Tipo'] = $tipoCuenta;

                $this->connection->ExecuteNonQuery($query, $parameters);

                $query = "SELECT MAX(IdTipo) AS id FROM TipoUser";

                $idRetornar = $this->connection->Execute($query);
                
            } else {
                $idRetornar = $resultado;
            }

            
            return $idRetornar[0][0];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function validarEmail($email)
    {
        try {
            $this->connection = Connection::GetInstance();
            $query = "SELECT guardian.Email FROM guardian WHERE guardian.Email = :email
                    UNION
                  SELECT duenio.Email FROM duenio WHERE duenio.Email = :email";

            $parameters['email'] = $email;

            $resultado = $this->connection->Execute($query, $parameters);


            if (!empty($resultado)) {
                throw new Exception("El email ya lo usa otra persona");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function validarDni($dni)
    {
        try {
            $this->connection = Connection::GetInstance();
            $query = "SELECT guardian.Dni FROM guardian WHERE guardian.Dni = :dni
                    UNION
                  SELECT duenio.Dni FROM duenio WHERE duenio.Dni = :dni";

            $parameters['dni'] = $dni;

            $resultado = $this->connection->Execute($query, $parameters);

            if (!empty($resultado)) {
                throw new Exception("El DNI ya lo tiene otra persona");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function validarUsername($username)
    {
        try {
            $this->connection = Connection::GetInstance();
            $query = "SELECT user.Username FROM user WHERE user.Username = :username";

            $parameters['username'] = $username;

            $resultado = $this->connection->Execute($query, $parameters);

            if (!empty($resultado)) {
                throw new Exception("Nombre de usuario no disponible");
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}

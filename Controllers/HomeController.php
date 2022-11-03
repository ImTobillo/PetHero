<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use DAO\GuardianDAO as GuardianDAO;
use DAO\DueñoDAO as DueñoDAO;
use Models\Dueño as Dueño;
use Models\Guardian as Guardian;
use Models\User as User;
use Exception;
use PDOException;


class HomeController
{
    private $userDAO;
    private $guardianesDAO;
    private $dueñosDAO;

    function __construct()
    {
        $this->userDAO = new UserDAO();
        $this->guardianesDAO = new GuardianDAO();
        $this->dueñosDAO = new DueñoDAO();
    }

    public function Index($message = "")
    {
        if (isset($_SESSION['loggedUser'])) {
            if (get_class($_SESSION['loggedUser']) == "Models\Dueño")
                require_once(VIEWS_PATH . "MenuDueño.php");
            else
                require_once(VIEWS_PATH . "MenuGuardian.php");
        } else {
            require_once(VIEWS_PATH . "inicio.php");
        }
    }

    public function verPerfil()
    {
        require_once VIEWS_PATH . 'validarSesion.php';
        if (get_class($_SESSION['loggedUser']) == "Models\Dueño") {
            require_once(VIEWS_PATH . 'ver-perfil-dueño.php');
        } else {
            require_once(VIEWS_PATH . 'ver-perfil-guardian.php');
        }
    }

    public function Login($username, $password)
    {
        try {
            $user = $this->userDAO->getByUser($username);

            if (($user != null) && $user->getPassword() == $password) {

                $userLogueado = null;

                if ($user->getTipoCuenta() == 'Guardian') {
                    $userLogueado = $this->guardianesDAO->getById($user->getId());
                } else {
                    $userLogueado = $this->dueñosDAO->getById($user->getId());
                }

                $_SESSION['loggedUser'] = $userLogueado;
            }
            else
                $_SESSION['errorMessage'] = "<script> if(confirm('Contraseña incorrecta')); </script>";

        } catch (Exception $e) {
            $_SESSION['errorMessage'] = $e->getMessage();       
        }
        finally
        {
            $this->Index();
        }
    }

    public function registrarCuenta($tipoCuenta)
    {
        require_once(VIEWS_PATH . 'registro.php');
    }

    public function cerrarSesion()
    {
        $_SESSION = []; // resetea el session
        $this->Index();
    }

    #agregar funcion de registro que guarde los datos de persona
    public function registro($nombre, $apellido, $dni, $email, $contraseña, $telefono, $fechaNacimiento, $ciudad, $calle, $numCalle, $nombreUser, $tipoCuenta)
    {
        try {
            $newUser = new User($nombreUser, $contraseña, $tipoCuenta);
            $this->userDAO->validarEmail($email);
            $this->userDAO->validarDni($dni);
            $this->userDAO->validarUsername($nombreUser);

            $this->userDAO->add($newUser);

            if ($tipoCuenta == "Dueño") { //se quiere registrar un dueño

                $user = $this->userDAO->getByUser($newUser->getUsername());

                $dueño = new Dueño($user->getId(), $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $ciudad, $calle, $numCalle);

                $this->dueñosDAO->add($dueño);

                $_SESSION['loggedUser'] = $dueño;

                require_once(VIEWS_PATH . "crear-mascota.php");
            } else {
                $user = $this->userDAO->getByUser($newUser->getUsername());

                $guardian = new Guardian($user->getId(), $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $ciudad, $calle, $numCalle);

                $_SESSION['loggedUser'] = $guardian;

                require_once(VIEWS_PATH . "registro2-guardian.php");
            }
        } catch (Exception $e) {
            $_SESSION['errorMessage'] = $e->getMessage();
            require_once(VIEWS_PATH . "registro.php");
        }
    }


    /*$user = $this->userDAO->getByUser($nombreUser);
        
        if($user != null){ // ya hay un usuario con ese nombre

            echo "<script> if(confirm('Nombre de usuario no disponible')); </script>";
            require_once(VIEWS_PATH . "registro.php");

        }else{ //el nombre de usuario esta disponible

            $newUser = new User($nombreUser, $contraseña, $tipoCuenta);
            $this->userDAO->add($newUser);

            if ($tipoCuenta == "dueño") { //se quiere registrar un dueño

                $dueños = $this->dueñosDAO->getAll();
                $bool = false;

                foreach ($dueños as $value) {
                    if ($value->getEmail() == $email) { //Valida que el email no exista en otro usuario
                        //advertencia email invalido
                        $bool = true;
                        echo "<script> if(confirm('Email no disponible')); </script>";
                        require_once(VIEWS_PATH . "registro.php");
                    }
                }

                if ($bool == false) { //dueño registrado con éxito

                    $dueño = new Dueño($newUser->getId(), $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $ciudad, $calle, $numCalle);

                    $_SESSION['loggedUser'] = $dueño;
                    
                    $this->dueñosDAO->add($dueño);
                    
                    require_once(VIEWS_PATH . "crear-mascota.php");
                }
            } else { // se quiere registrar un guardian

                $guardianes = $this->guardianesDAO->getAll();
                $bool = false;

                foreach ($guardianes as $value) { 

                    if ($value->getEmail() == $email) { //Valida que el email no exista en otro usuario
                        //advertencia email invalido
                        $bool = true;
                        echo "<script> if(confirm('Email no disponible')); </script>";
                        require_once(VIEWS_PATH . "registro.php");
                    }
                }
                if ($bool == false) { //guardian registrado con exito

                    $guardian = new Guardian($newUser->getId(), $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $ciudad, $calle, $numCalle);

                    $_SESSION['loggedUser'] = $guardian;
    
                    require_once(VIEWS_PATH . "registro2-guardian.php");
                }
            }
        }*/
}

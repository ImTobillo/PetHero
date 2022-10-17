<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use DAO\GuardianDAO as GuardianDAO;
use DAO\DueñoDAO as DueñoDAO;
use Models\Dueño as Dueño;
use Models\Guardian as Guardian;
use Models\User as User;


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
        if (isset($_SESSION['loggedUser']))
        {
            if (get_class($_SESSION['loggedUser']) == "Models\Dueño")
                require_once(VIEWS_PATH . "MenuDueño.php");
            else
                require_once(VIEWS_PATH . "MenuGuardian.php");

        }
        else
        {
            require_once(VIEWS_PATH . "inicio.php");
        }
    }

    public function mostrarMenu($tipoCuenta)
    {
        require_once VIEWS_PATH . 'validarSesion.php';

        if ($tipoCuenta == "guardian")
            require_once VIEWS_PATH . 'MenuGuardian.php';
        else
            require_once VIEWS_PATH . 'MenuDueño.php';
    }

    public function Login($username, $password)
    {
        $user = $this->userDAO->getByUser($username);

        if (($user != null) && ($user->getPassword() == $password)) {
            $userLogueado = null;

            if ($user->getTipoCuenta() == 'guardian')
                $userLogueado = $this->guardianesDAO->getById($user->getId());
            else
                $userLogueado = $this->dueñosDAO->getById($user->getId());

            $_SESSION['loggedUser'] = $userLogueado;
            $this->mostrarMenu($user->getTipoCuenta());
        } else {
            $this->Index();
            echo "<script> if(confirm('Usuario y/o Contraseña incorrectos')); </script>";
        }
    }

    public function registrarCuenta($tipoCuenta)
    {
        $tipoCuenta;
        require_once(VIEWS_PATH . 'registro.php');
    }

    public function cerrarSesion()
    {
        session_destroy();
        header('Location: '. ROOT);
    }

    #agregar funcion de registro que guarde los datos de persona
    public function registro($nombre, $apellido, $dni, $email, $contraseña, $telefono, $fechaNacimiento, $ciudad, $calle, $numCalle, $nombreUser, $tipoCuenta)
    {
        $user = $this->userDAO->getByUser($nombreUser);
        if($user != null){
            echo "<script> if(confirm('Nombre de usuario no disponible')); </script>";
            require_once(VIEWS_PATH . "registro.php");
        }else{
            $newUser = new User($nombreUser, $contraseña, $tipoCuenta);
            $this->userDAO->add($newUser);
            if ($tipoCuenta == "dueño") {
                $dueños = $this->dueñosDAO->getAll();
                $bool = false;
                foreach ($dueños as $value) {
                    if ($value->getEmail() == $email) {
                        //advertencia email invalido
                        $bool = true;
                        echo "<script> if(confirm('Email no disponible')); </script>";
                        require_once(VIEWS_PATH . "registro.php");
                    }
                }
                if ($bool == false) {
                    $dueño = new Dueño($newUser->getId(), $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $ciudad, $calle, $numCalle);

                    $_SESSION['loggedUser'] = $dueño;
                    
                    $this->dueñosDAO->add($dueño);
                    
                    require_once(VIEWS_PATH . "crear-mascota.php");
                }
            } else {
                $guardianes = $this->guardianesDAO->getAll();
                $bool = false;
                foreach ($guardianes as $value) {
                    if ($value->getEmail() == $email) {
                        //advertencia email invalido
                        $bool = true;
                        echo "<script> if(confirm('Email no disponible')); </script>";
                        require_once(VIEWS_PATH . "registro.php");
                    }
                }
                if ($bool == false) {
                    $guardian = new Guardian($newUser->getId(), $nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $ciudad, $calle, $numCalle);

                    $this->guardianesDAO->add($guardian);
    
                    require_once(VIEWS_PATH . "registro2-guardian.php");
                }
            }
        }   
    }
}

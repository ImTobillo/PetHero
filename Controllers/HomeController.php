<?php

namespace Controllers;

use DAO\UserDAO as UserDAO;
use DAO\GuardianDAO as GuardianDAO;
use DAO\DueñoDAO as DueñoDAO;
use Models\Dueño as Dueño;
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
        require_once(VIEWS_PATH . "inicio.php");
    }

    public function mostrarMenu($tipoCuenta)
    {
        require_once VIEWS_PATH . 'validarSesion.php';

        if ($tipoCuenta == "guardian")
            require_once VIEWS_PATH . 'MenuGuardian.php';
        else
            require_once VIEWS_PATH . 'MenuDue%C3%B1o.php';
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

            $_SESSION['userLogged'] = $userLogueado;
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
        $this->Index();
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
                    $dueño = new Dueño($nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $ciudad, $calle, $numCalle);
    
                    $this->dueñosDAO->add($dueño);
    
                    require_once(VIEWS_PATH . "crear-mascota.php");
                }
            } else {
            }
        }   
    }
}

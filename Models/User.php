<?php 

namespace Models;

class User
{
    private $id;
    private $username;
    private $password;
    private $tipoCuenta;

    function __construct($username, $password, $tipoCuenta)
    { #saco id, que lo hagaautoincremental el dao
        $this->username = $username;
        $this->password = $password;
        $this->tipoCuenta = $tipoCuenta;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }
 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getTipoCuenta()
    {
        return $this->tipoCuenta;
    }

    public function setTipoCuenta($tipoCuenta)
    {
        $this->tipoCuenta = $tipoCuenta;

        return $this;
    }
}



?>
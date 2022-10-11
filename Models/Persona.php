<?php

namespace Models;

abstract class Persona{
    #atributos
    private $id;
    private $nombre;
    private $apellido;
    private $fechaNacimiento;
    private $dni;
    private $telefono;
    private $email;
    private $contraseña;
    private $ciudad;
    private $calle;
    private $numCalle;

    public function __construct($nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $contraseña, $ciudad, $calle, $numCalle){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fechaNac = $fechaNacimiento;
        $this->dni = $dni;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->contraseña = $contraseña;
        $this->ciudad = $ciudad;
        $this->calle = $calle;
        $this->numCalle = $numCalle;
    }

    #get
    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getfechaNacimiento(){
        return $this->fechaNac;
    }
    public function getDni(){
        return $this->dni;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getContraseña(){
        return $this->contraseña;
    } 
    public function getCiudad(){
        return $this->ciudad;
    } 
    public function getCalle(){
        return $this->calle;
    }
    public function getNumCalle(){
        return $this->numCalle;
    } 

    #set
    public function setId($id){
        $this->id = $id;
    }
}
?>
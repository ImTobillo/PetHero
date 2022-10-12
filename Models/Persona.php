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
    private $ciudad;
    private $calle;
    private $numCalle;

    public function __construct($nombre, $apellido, $fechaNacimiento, $dni, $telefono, $email, $ciudad, $calle, $numCalle){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->dni = $dni;
        $this->telefono = $telefono;
        $this->email = $email;
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
        return $this->fechaNacimiento;
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

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    public function setFechaNacimiento($fechaNacimiento){
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function setDni($dni){
        $this->dni = $dni;
    }

    public function setTelefono($telefono){
        $this->telefono = $telefono;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function setCiudad($ciudad){
        $this->ciudad = $ciudad;
    }

    public function setCalle($calle){
        $this->calle = $calle;
    }

    public function setNumCalle($numCalle){
        $this->numCalle = $numCalle;
    }
}
?>
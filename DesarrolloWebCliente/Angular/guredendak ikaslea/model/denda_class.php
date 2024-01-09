<?php
//namespace model;
class denda_class
{
    protected $id;
    protected $Nombre;
    protected $Poblacion;
    protected $Telefono;
      
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->Nombre;
    }
function getPoblacion() {
        return $this->Poblacion;
    }
function getTelefono() {
        return $this->Telefono;
    }
 

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

function setPoblacion($Poblacion) {
        $this->Poblacion = $Poblacion;
    }

function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }
 
   
}


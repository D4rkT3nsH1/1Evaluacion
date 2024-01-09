<?php
//namespace model;
class erabiltzaile_class
{
    protected $id_erab;
    protected $Nombre;
    protected $Apellido;
    protected $DNI;

    function getId()
    {
        return $this->id_erab;
    }

    function getNombre()
    {
        return $this->Nombre;
    }
    function getApellido()
    {
        return $this->Apellido;
    }
    function getDNI()
    {
        return $this->DNI;
    }

    function setId($id)
    {
        $this->id_erab = $id;
    }

    function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    function setApellido($Apellido)
    {
        $this->Apellido = $Apellido;
    }

    function setDNI($DNI)
    {
        $this->DNI = $DNI;
    }
}

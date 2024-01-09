<?php
//namespace model;
class produktu_class
{
    protected $Id_produktuak;
    protected $Nombre;
    protected $Tipo;
    protected $Precio;
    protected $Cantidad;
    protected $Foto;


    function getId_produktuak()
    {
        return $this->Id_produktuak;
    }

    function getNombre()
    {
        return $this->Nombre;
    }
    function getTipo()
    {
        return $this->Tipo;
    }
    function getPrecio()
    {
        return $this->Precio;
    }
    function getCantidad()
    {
        return $this->Cantidad;
    }

    function getFoto()
    {
        return $this->Foto;
    }

    function setId_produktuak($Id_produktuak)
    {
        $this->Id_produktuak = $Id_produktuak;
    }

    function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    function setTipo($Tipo)
    {
        $this->Tipo = $Tipo;
    }
    function setPrecio($Precio)
    {
        $this->Precio = $Precio;
    }

    function setCantidad($Cantidad)
    {
        $this->Cantidad = $Cantidad;
    }

    function setFoto($Foto)
    {
        $this->Foto =  $Foto;
    }
}

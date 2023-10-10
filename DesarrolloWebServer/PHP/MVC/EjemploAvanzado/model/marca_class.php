<?php

class marca_class{

    public $id_marca;
    public $nombre;

    /**
     * Get the value of id_usuarios
     */ 
    public function getId_marca()
    {
        return $this->id_marca;
    }

    /**
     * Set the value of id_usuarios
     *
     * @return  self
     */ 
    public function setId_marca($id_marca)
    {
        $this->id_marca = $id_marca;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}


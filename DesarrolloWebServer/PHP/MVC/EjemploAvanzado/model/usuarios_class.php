<?php

class usuarios_class
{
    public $id_usuarios;
    public $nombre;
    public $correo;
    public $pasahitza;
    public $tipo;
    
    /**
     * Get the value of id_usuarios
     */ 
    public function getId_usuarios()
    {
        return $this->id_usuarios;
    }

    /**
     * Set the value of id_usuarios
     *
     * @return  self
     */ 
    public function setId_usuarios($id_usuarios)
    {
        $this->id_usuarios = $id_usuarios;

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

    /**
     * Get the value of correo
     */ 
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set the value of correo
     *
     * @return  self
     */ 
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get the value of pasahitza
     */ 
    public function getPasahitza()
    {
        return $this->pasahitza;
    }

    /**
     * Set the value of pasahitza
     *
     * @return  self
     */ 
    public function setPasahitza($pasahitza)
    {
        $this->pasahitza = $pasahitza;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }
}


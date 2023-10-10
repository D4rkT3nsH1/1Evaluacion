<?php

class componentes_class{

    public $id_componentes;
    public $id_marca;
    public $tipo;
    public $stock;
    public $precio;
    public $img_componentes;

    /**
     * Get the value of id_componentes
     */ 
    public function getId_componentes()
    {
        return $this->id_componentes;
    }

    /**
     * Set the value of id_componentes
     *
     * @return  self
     */ 
    public function setId_componentes($id_componentes)
    {
        $this->id_componentes = $id_componentes;

        return $this;
    }

    /**
     * Get the value of id_marca
     */ 
    public function getId_marca()
    {
        return $this->id_marca;
    }

    /**
     * Set the value of id_marca
     *
     * @return  self
     */ 
    public function setId_marca($id_marca)
    {
        $this->id_marca = $id_marca;

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

    /**
     * Get the value of stock
     */ 
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     *
     * @return  self
     */ 
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }


    /**
     * Get the value of precio
     */ 
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     *
     * @return  self
     */ 
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of img_componentes
     */ 
    public function getImg_componentes()
    {
        return $this->img_componentes;
    }

    /**
     * Set the value of img_componentes
     *
     * @return  self
     */ 
    public function setImg_componentes($img_componentes)
    {
        $this->img_componentes = $img_componentes;

        return $this;
    }
}
<?php
include_once ("connect_data.php");  // klase honetan gordetzen dira datu basearen datuak. erabiltzailea...
include_once ("componentes_class.php");
include_once ("marca_model.php");

class componentes_model extends componentes_class
{
    public $link;  // datu basera lotura - enlace a la bbdd
    public $objMarca;  //editorialaren datuak gordeko dira hemen objetu bezala
         
   
 
 public function OpenConnect()
    {
    $konDat=new connect_data();
    try
    {
         $this->link=new mysqli($konDat->host,$konDat->userbbdd,$konDat->passbbdd,$konDat->ddbbname);
         // mysqli klaseko link objetua sortzen da dagokion konexio datuekin
         // se crea un nuevo objeto llamado link de la clase mysqli con los datos de conexión. 
    }
    catch(Exception $e)
    {
    echo $e->getMessage();
    }
        $this->link->set_charset("utf8"); // honek behartu egiten du aplikazio eta 
        //                  //databasearen artean UTF -8 erabiltzera datuak trukatzeko
    }                   
 
 public function CloseConnect()
 {
     //mysqli_close ($this->link);
     $this->link->close();
 }
 
 public function setList()
 {
        $this->OpenConnect();   
        $sql = "CALL spAllComponentes()";  
        
        $result = $this->link->query($sql); 
        
        $list=array();
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            
            $newComponente=new componentes_model(); // self() 
            $newComponente->id_componentes=$row['id_componentes'];
            $newComponente->img_componentes=$row['img_componentes'];
            $newComponente->tipo=$row['tipo'];
            $newComponente->stock=$row['stock'];
            $newComponente->precio=$row['precio'];
            $newComponente->id_marca=$row['id_marca'];
            
          
            $newMarca=new marca_model(); 
            $newMarca->id_marca=$row['id_marca'];
            
            $newMarca->findIdMarca();
            
            $newComponente->objMarca=$newMarca;
            
            array_push($list, $newComponente);  
        }
       mysqli_free_result($result);
       $this->CloseConnect();
       return($list);
 }

 public function delete()
    {
        $this->OpenConnect();
        
        $id_componentes=$this->id_componentes;
        
        $sql = "CALL spDelete($id_componentes)";
        
        //  $sql = "delete from libros where libros.id=$id";
        
        $this->link->query($sql);
        
        if ($this->link->affected_rows == 1)
        {
            return "La persona se ha borrado con exito.Num borrados: ".$this->link->affected_rows;
        } else {
            return "Falla el borrado el componente: (" . $this->link->errno . ") " . $this->link->error;
        }
        $this->CloseConnect();
    }

    public function showupdate()
    {
        $this->OpenConnect();
        
        $id_componentes=$this->id_componentes;
        
        $sql="SELECT * FROM componentes where id_componentes = $id_componentes";
        
        $result = $this->link->query($sql); // result-en ddbb-ari eskatutako informazio dena gordetzen da
        // se guarda en result toda la informacion solicitada a la bbdd
        $list = array();
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            
            $new=new componentes_class();
            
            
            $new->setId_componentes($row['id_componentes']);
            $new->setId_marca($row['id_marca']);
            $new->setImg_componentes($row['img_componentes']);
            $new->setTipo($row['tipo']);
            $new->setStock($row['stock']);
            $new->setPrecio($row['precio']);
            
            
            
            array_push($list, $new);
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }

    public function update(){
        
        $this->OpenConnect();  // konexio zabaldu  - abrir conexión
        
        $id_componentes= $this->id_componentes;
        $id_marca= $this->id_marca;
        $img_componentes= $this->img_componentes;
        $tipo= $this->tipo;
        $stock= $this->stock;
        $precio= $this->precio;
        
        $sql = "CALL spUpdate($id_componentes,$id_marca,'$img_componentes','$tipo', $stock, $precio)";
        
        $this->link->query($sql);
        
        if ($this->link->affected_rows == 1)
        {
            $msg= $sql." El componente se ha insertado con exito. Num de inserts: ".$this->link->affected_rows;
        } else {
            $msg=$sql." Fallo al insertar un componente nuevo: (" . $this->link->errno . ") " . $this->link->error;
        }
        $this->CloseConnect();
        return $msg;
        
        
    }

    public function insert()
    {
        
        $this->OpenConnect();  // konexio zabaldu  - abrir conexión
        
        $img_componentes= $this->img_componentes;
        $tipo= $this->tipo;
        $stock= $this->stock;
        $precio= $this->precio;
        $id_marca= $this->id_marca;
        
        $sql = "CALL spInsertar($id_marca, '$img_componentes', '$tipo', $stock, $precio)";
        
        $this->link->query($sql);
        
        if ($this->link->affected_rows == 1)
        {
            $msg= $sql." El componenet se ha insertado con exito. Num de inserts: ".$this->link->affected_rows;
        } else {
            $msg=$sql." Fallo al insertar un componenet nuevo: (" . $this->link->errno . ") " . $this->link->error;
        }
        $this->CloseConnect();
        return $msg;
    }
 
}
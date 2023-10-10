<?php
include_once ("connect_data.php");  // klase honetan gordetzen dira datu basearen datuak. erabiltzailea...
include_once ("marca_class.php");
include_once ("componentes_model.php");

class marca_model extends marca_class
{
    private $link;  // datu basera lotura - enlace a la bbdd
    
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
        //databasearen artean UTF -8 erabiltzera datuak trukatzeko
    }
    
    public function CloseConnect()
    {
        mysqli_close ($this->link);
    }
    
    public function setList()
    {
        $this->OpenConnect();  // konexio zabaldu  - abrir conexión
        
        $sql="SELECT * FROM marca";
        $result = $this->link->query($sql); // result-en ddbb-ari eskatutako informazio dena gordetzen da
        // se guarda en result toda la informacion solicitada a la bbdd
        $list = array();
        
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            
            $new=new marca_class();
            
            $new->setId_marca($row['id_marca']);
            $new->setNombre($row['nombre']);
            
            array_push($list, $new);
        }
        mysqli_free_result($result);
        $this->CloseConnect();
        return $list;
    }

    public function findIdMarca()
    {
        $id_marca=$this->id_marca;
        
        $this->OpenConnect();  
        $sql = "CALL spFindIdMarca($id_marca)";
               
        $result=$this->link->query($sql);    
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                       
        $this->id_marca=$row['id_marca'];
        $this->nombre=$row['nombre'];
         
       mysqli_free_result($result); 
       $this->CloseConnect();
    }   
    
    
   
}
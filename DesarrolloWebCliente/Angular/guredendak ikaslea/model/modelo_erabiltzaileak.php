<?php
include_once('../controlador/conector.php');
include_once('erabiltzaile_class.php');
class modelo_erabiltzaile extends erabiltzaile_class
{
    private $link;
    private $list;
    private $JSONList = array();

    public function getList()
    {
        return $this->list;
    }
    public function getJSONList()
    {
        return $this->JSONList;
    }
    public function OpenConnect()
    {
        $konDat = new Conectar();
        try {
            $this->link = new mysqli($konDat->localhost, $konDat->usuario, $konDat->contrasena, $konDat->bbdd);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $this->link->set_charset("utf8");
    }

    public function CloseConnect()
    {
        $this->link->close();
    }


    public function setList()
    {
        /* obtiene todos los alumnos  */
        $this->OpenConnect();
        $sql = "CALL sp_mostrar_erabiltzaileak()";
        $this->list = array();
        $result = $this->link->query($sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $new = new self();
            $new->setId($row['id']);
            $new->setNombre($row['nombre']);
            $new->setApellido($row['apellido']);
            $new->setDNI($row['dni']);


            array_push($this->list, $new);  // array of objects
            array_push($this->JSONList, $row); //array of rows
        }
        mysqli_free_result($result);

        $this->CloseConnect();
    }

    //public function insert()
    // {     
    //      $this->OpenConnect();  // konexio zabaldu  - abrir conexión     
    //      $nombre="'". $this->getNombre()."'";
    //       $apellido1= "'". $this->getApellido1()."'";
    //        $apellido2="'". $this->getApellido2()."'";
    //      
    //     $ciclo= "'". $this->getCiclo()."'";
    //      $curso= $this->getCurso();
    // 
    //      $sql = "CALL sp_insertar_ikasle($nombre,$apellido1,$apellido2,$curso,$ciclo )";
    //      echo $sql;
    //       $consulta =$this->link->query($sql);   
    //     
    //     while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
    //            $this->id[] = $row;
    //        }
    //        $consulta->free_result();
    //        $this->link->close();
    //        return $this->id;
    // $this->CloseConnect();
    // }
    //
    //
    // public function delete()
    // {
    //      $this->OpenConnect();
    //echo $this->getId();
    //      $sql="CALL sp_borrar_ikasle(".$this->getId().")";
    //       
    // echo $sql;
    //$this->link->query($sql);
    //      $this->CloseConnect();
    // }
    //public function update() {
    //      $this->OpenConnect();
    //      $id= $this->getId();
    //      $nombre="'". $this->getNombre()."'";
    //     $apellido1="'". $this->getApellido1()."'";
    //     $apellido2="'". $this->getApellido2()."'";
    //     $ciclo="'". $this->getCiclo()."'";
    //   
    //      $curso= $this->getCurso();
    //      
    //      $sql="CALL sp_modificar_ikasle($id,$nombre,$apellido1,$apellido2,$curso,$ciclo)";
    //      $this->link->query($sql);
    //      $this->CloseConnect();
    //      //var_dump($sql);
    // }
    //
    //public function find_name() {
    //      $this->OpenConnect();
    //      //$id= $this->getId();
    //      $nombre="'". $this->getNombre()."'";
    //       $sql="CALL sp_buscar_ikasle($nombre)";
    //        while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
    //            $this->id[] = $row;
    //        }
    //      $this->link->query($sql);
    //      $this->CloseConnect();
    //      //var_dump($sql);
    // }



    /*  public function get_ikasleak() {
        $sql = "CALL sp_mostrar_ikasleak()";
        $consulta = $this->link->query($sql);
        while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
            $this->usuario[] = $row;
        }
        $consulta->free_result();
        $this->link->close();
        return $this->usuario;
    }

    public function insertar_ikasle($nombre, $edad, $curso) {
        $consulta = $this->link->query("CALL sp_insertar_ikasle('$nombre', '$edad', '$curso')");
         while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
            $this->id[] = $row;
        }
        $consulta->free_result();
        $this->link->close();
        return $this->id;
    }

    public function borrar_ikasle($ikasle_id) {
        $consulta = $this->link->query("CALL sp_borrar_ikasle('$ikasle_id')");
    }

    public function modificar_ikasle($id, $nombre, $edad, $curso) {
        $consulta = $this->link->query("CALL sp_modificar_ikasle('$id', '$nombre', '$edad', '$curso')");
    }*/

    /*   public function id_azken_ikaslea() {
        $sql = "CALL sp_azkenId_ikasleak()";
        $consulta = $this->link->query($sql);
        while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
            $this->id[] = $row;
        }
        $consulta->free_result();
        $this->link->close();
        return $this->id;
    }

    public function insertar_matricula($idAzkena, $modulo) {
        $consulta = $this->link->query("CALL sp_insertar_matricula('$idAzkena', '$modulo')");
    }*/
}

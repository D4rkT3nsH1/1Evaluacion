<?php

include_once('../controlador/conector.php');
include_once('produktu_class.php');
class modelo_produktuak extends produktu_class
{
     private $link;
     private $list;
     private $JSONList = array();

     public function getProduktuak()
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


     public function setProduktuak()
     {
          /* obtiene todos los alumnos  */
          $this->OpenConnect();
          $sql = "CALL sp_mostrar_produktuak()";
          $this->list = array();
          $result = $this->link->query($sql);
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
               $new = new self();
               $new->setId_produktuak($row['id_produktuak']);
               $new->setNombre($row['nombre']);
               $new->setTipo($row['tipo']);
               $new->setPrecio($row['precio']);
               $new->setCantidad($row['cantidad']);
               $new->setFoto($row['foto']);
               // echo($new->getNombre($row['nombre']));
               //   echo($new->getFoto($row['foto']));
               array_push($this->list, $new);  // array of objects
               array_push($this->JSONList, $row); //array of rows
          }
          mysqli_free_result($result);

          $this->CloseConnect();
     }
     public function updateCantidad()
     {
          $this->OpenConnect();

          $id = $this->getId_produktuak();
          $cantidad = $this->getCantidad();
          var_dump($cantidad);
          //$cantidad="'". $this->getCantidad()."'";

          $sql = "CALL sp_modificar_CantidadProd($id,$cantidad)";
          $this->link->query($sql);
          $this->CloseConnect();
          var_dump($sql);
     }

     public function insert()
     {
          $this->OpenConnect();  // konexio zabaldu  - abrir conexión     
          $nombre = "'" . $this->getNombre() . "'";
          $tipo = "'" . $this->getTipo() . "'";
          $precio = "'" . $this->getPrecio() . "'";
          $cantidad = "'" . $this->getCantidad() . "'";
          $foto = "'" . $this->getFoto() . "'";
          $foto = "'mifoto'";
          $sql = "CALL sp_insertar_produktuak($nombre,$tipo,$precio,$cantidad,$foto)";
          echo $sql;
          $consulta = $this->link->query($sql);

          var_dump($consulta);

          //     while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
          //            $this->id_produktuak[] = $row;
          //        }
          //    $consulta->free_result();
          //     $this->link->close();
          //        return $this->id_produktuak;
          $this->CloseConnect();
     }

     public function delete()
     {
          $this->OpenConnect();
          echo $this->getId_produktuak();
          $sql = "CALL sp_borrar_produktua(" . $this->getId_produktuak() . ")";

          echo $sql;
          $this->link->query($sql);
          $this->CloseConnect();
     }

     public function update()
     {
          $this->OpenConnect();

          $id = $this->getId_produktuak();
          $nombre = "'" . $this->getNombre() . "'";
          var_dump($nombre);
          $tipo = "'" . $this->getTipo() . "'";
          $precio = $this->getPrecio();
          $cantidad = $this->getCantidad();
          $foto = "'" . $this->getFoto() . "'";
          $sql = "CALL sp_modificar_produktuak($id,$nombre,$tipo,$precio,$cantidad,$foto)";
          $this->link->query($sql);
          $this->CloseConnect();
          var_dump($sql);
     }
}




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
//

////
//  /*  public function get_ikasleak() {
//        $sql = "CALL sp_mostrar_ikasleak()";
//        $consulta = $this->link->query($sql);
//        while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
//            $this->usuario[] = $row;
//        }
//        $consulta->free_result();
//        $this->link->close();
//        return $this->usuario;
//    }
//
//    public function insertar_ikasle($nombre, $edad, $curso) {
//        $consulta = $this->link->query("CALL sp_insertar_ikasle('$nombre', '$edad', '$curso')");
//         while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
//            $this->id[] = $row;
//        }
//        $consulta->free_result();
//        $this->link->close();
//        return $this->id;
//    }
//
//    public function borrar_ikasle($ikasle_id) {
//        $consulta = $this->link->query("CALL sp_borrar_ikasle('$ikasle_id')");
//    }
//
//    public function modificar_ikasle($id, $nombre, $edad, $curso) {
//        $consulta = $this->link->query("CALL sp_modificar_ikasle('$id', '$nombre', '$edad', '$curso')");
//    }*/
//
// /*   public function id_azken_ikaslea() {
//        $sql = "CALL sp_azkenId_ikasleak()";
//        $consulta = $this->link->query($sql);
//        while ($row = mysqli_fetch_array($consulta, MYSQLI_ASSOC)) {
//            $this->id[] = $row;
//        }
//        $consulta->free_result();
//        $this->link->close();
//        return $this->id;
//    }
//
//    public function insertar_matricula($idAzkena, $modulo) {
//        $consulta = $this->link->query("CALL sp_insertar_matricula('$idAzkena', '$modulo')");
//    }*/
//
//}

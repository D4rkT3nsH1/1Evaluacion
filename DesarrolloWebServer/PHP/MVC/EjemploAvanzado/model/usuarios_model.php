<?php
include_once("connect_data.php"); // klase honetan gordetzen dira datu basearen datuak. erabiltzailea...
include_once("usuarios_class.php");

class usuarios_model extends usuarios_class
{
    private $link; // datu basera lotura - enlace a la bbdd

    public function OpenConnect()
    {
        $konDat = new connect_data();
        try {
            $this->link = new mysqli($konDat->host, $konDat->userbbdd, $konDat->passbbdd, $konDat->ddbbname);
            // mysqli klaseko link objetua sortzen da dagokion konexio datuekin
            // se crea un nuevo objeto llamado link de la clase mysqli con los datos de conexión.
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $this->link->set_charset("utf8"); // honek behartu egiten du aplikazio eta
        //databasearen artean UTF -8 erabiltzera datuak trukatzeko
    }

    public function CloseConnect()
    {
        mysqli_close($this->link);
    }

    public function setList()
    {
        $this->OpenConnect(); // konexio zabaldu  - abrir conexión
        $nombre = $this->nombre;
        $pasahitza = $this->pasahitza;

        $sql = "CALL spFindUsuario('$nombre','$pasahitza')";
        $result = $this->link->query($sql);
        $list = array();

        if ($this->link->affected_rows == 1) {
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

                $new = new usuarios_class();

                $new->setId_usuarios($row['id_usuarios']);
                $new->setNombre($row['nombre']);
                $new->setCorreo($row['correo']);
                $new->setPasahitza($row['pasahitza']);
                $new->setTipo($row['tipo']);

                array_push($list, $new);
            }
            mysqli_free_result($result);
        } else {
            return "no va jeje";
        }

        $this->CloseConnect();
        return $list;
    }


    public function insert()
    {

        $this->OpenConnect(); // konexio zabaldu  - abrir conexión

        $nombre = $this->nombre;
        $correo = $this->correo;
        $pasahitza = $this->pasahitza;

        $sql = "CALL spInsertarUsuario('$nombre', '$correo', '$pasahitza')";

        $this->link->query($sql);

        if ($this->link->affected_rows == 1) {
            $msg = $sql . " La persona se ha insertado con exito. Num de inserts: " . $this->link->affected_rows;
        } else {
            $msg = $sql . " Fallo al insertar una persona nuevo: (" . $this->link->errno . ") " . $this->link->error;
        }
        $this->CloseConnect();
        return $msg;
    }

}
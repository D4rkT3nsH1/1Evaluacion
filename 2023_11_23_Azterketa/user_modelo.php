<?php
require_once 'connector.php';

class User_Modelo
{
    private $conn;

    public function OpenConnect()
    {
        $connData = new connect_data();
        try {
            $this->conn = new mysqli($connData->host, $connData->userbbdd, $connData->passbbdd, $connData->ddbbname);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $this->conn->set_charset("utf8");
    }

    public function CloseConnect()
    {
        $this->conn = null;
    }

    public function UserValido($user, $pass)
    {
        $this->OpenConnect();

        $sql = "SELECT * FROM erabiltzaileak_usuarios WHERE erab_usuario = '$user' AND pasahitza_contraseña = '$pass'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            if ($this->conn !== null) {
                $this->CloseConnect();
            }
            return true;
        } else {
            return false;
        }
    }

    public function NewUser($name, $cumple, $username, $password)
    {
        $this->OpenConnect();

        $sql = "INSERT INTO erabiltzaileak_usuarios(erab_usuario, pasahitza_contraseña, izena_nombre, jaiotze_data_fecha_nacimiento, olentzero_MariDomingi, puntuazioa_puntuacion) VALUES('$username', '$password', '$name', '$cumple', 0, 0);";
        $this->conn->query($sql);
        if ($this->conn->affected_rows == 1) {
            if ($this->conn !== null) {
                $this->CloseConnect();
            }
            return true;
        } else {
            return false;
        }
    }

    public function changePass($user, $pass)
    {
        $this->OpenConnect();

        $sql = "UPDATE erabiltzaileak_usuarios SET pasahitza_contraseña = '$pass' WHERE erab_usuario = '$user'";
        $result = $this->conn->query($sql);

        if ($result) {
            if ($this->conn !== null) {
                $this->CloseConnect();
            }
            return true;
        } else {
            return false;
        }
    }

    public function getAllUsers()
    {
        $this->OpenConnect();

        $sql = "SELECT * FROM erabiltzaileak_usuarios WHERE Olentzero_MariDomingi != 1;";
        $result = $this->conn->query($sql);
        $users = array();
        foreach ($result as $row) {
            $id = $row['id_erab_usuario'];
            $user = $row['erab_usuario'];
            $users[$id] = $user;
        }

        if ($this->conn !== null) {
            $this->CloseConnect();
        }

        return $users;
    }

    public function insertGutunaFromUser($user, $opariaString)
    {
        $this->OpenConnect();

        $fechaActual = date("Y");

        $sql = "INSERT INTO gutunak_cartas(erab_usuario, urtea, eskatutakoak_pedidos) VALUES('$user', '$fechaActual', '$opariaString');";
        $this->conn->query($sql);
        if ($this->conn->affected_rows == 1) {
            if ($this->conn !== null) {
                $this->CloseConnect();
            }
            return true;
        } else {
            return false;
        }
    }

    public function getUserGutunak($user)
    {
        $this->OpenConnect();

        $sql = "SELECT * FROM gutunak_cartas WHERE erab_usuario = '$user'";
        $result = $this->conn->query($sql);

        $opariZerrenda = array();

        if ($result->num_rows > 0) {
            if ($this->conn !== null) {
                $this->CloseConnect();
            }

            foreach ($result as $row) {
                $oparia = $row['izena_nombre'];
                $puntuazioa = $row['puntuazioa_puntuacion'];
                $opariZerrenda[$oparia] = $puntuazioa;
            }

            return $opariZerrenda;
        } else {
            return false;
        }
    }

    public function getAccionesFromUserAdina($stringAdina)
    {
        $this->OpenConnect();

        $sql = "SELECT * FROM ekintzak_acciones WHERE adina_edad LIKE '%$stringAdina%'";
        $result = $this->conn->query($sql);

        $ekintzaZerrenda = array();

        if ($result->num_rows > 0) {
            if ($this->conn !== null) {
                $this->CloseConnect();
            }

            foreach ($result as $row) {
                $ekintza = $row['izena_nombre'];
                $puntuazioa = $row['puntuak_puntuacion'];
                $ekintzaZerrenda[$ekintza] = $puntuazioa;
            }

            return $ekintzaZerrenda;
        } else {
            return false;
        }
    }

    public function insertEkintzak($user, $stringEkintzak)
    {
        $this->OpenConnect();

        $sql = "INSERT INTO egindakoak_accionesrealizadas(erab_usuario, egindakoa_realizado, data_fecha) VALUES('$user', '$stringEkintzak', now());";
        $this->conn->query($sql);
        if ($this->conn->affected_rows == 1) {
            if ($this->conn !== null) {
                $this->CloseConnect();
            }
            return true;
        } else {
            return false;
        }
    }

    public function getOpariakByAdina($userAdina)
    {
        $this->OpenConnect();

        $sql = "SELECT * FROM opariak_regalos WHERE adina_edad LIKE '%$userAdina%'";
        $result = $this->conn->query($sql);

        $opariZerrenda = array();

        if ($result->num_rows > 0) {
            if ($this->conn !== null) {
                $this->CloseConnect();
            }

            foreach ($result as $row) {
                $oparia = $row['izena_nombre'];
                $puntuazioa = $row['puntuazioa_puntuacion'];
                $opariZerrenda[$oparia] = $puntuazioa;
            }

            return $opariZerrenda;
        } else {
            return false;
        }
    }

    public function getUserDate($user)
    {
        $this->OpenConnect();

        $sql = "SELECT * FROM erabiltzaileak_usuarios WHERE erab_usuario = '$user'";
        $result = $this->conn->query($sql);
        $cumple = "";
        if ($result->num_rows > 0) {

            foreach ($result as $row) {
                $cumple = $row['jaiotze_data_fecha_nacimiento'];
            }
            if ($this->conn !== null) {
                $this->CloseConnect();
            }
            return $cumple;
        } else {
            return false;
        }
    }

    public function adinaKalkulatu_calcularEdad($jaiotzData_fechaNacimiento)
    {
        // Fecha actual
        $fechaActual = date("d-m-Y");
        // Convertir las fechas a timestamps
        $timestampNacimiento = strtotime($jaiotzData_fechaNacimiento);
        $timestampActual = strtotime($fechaActual);
        // Calcular la diferencia en segundos
        $diferenciaSegundos = $timestampActual - $timestampNacimiento;
        // Calcular la diferencia en años
        $adina_edad = floor($diferenciaSegundos / (365 * 24 * 60 * 60));
        return $adina_edad;
    }

    public function userEdadToString($adina)
    {
        switch ($adina) {
            case $adina <= 7:
                return "Umeak";
                break;

            case $adina >= 8 && $adina <= 14:
                return "Nerabeak";
                break;

            case $adina >= 15:
                return "Gazte";
                break;
        }
    }
}

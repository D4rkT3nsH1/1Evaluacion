<?php

class Jokalari_Modeloa
{

    private $mysqli;

    public function konektatu()
    {
        try {

            $this->mysqli = new mysqli('localhost', 'root', '', 'jokoa');
            if ($this->mysqli->connect_errno) {
                throw new Exception('Konektatzean Akatsa:/ Error en conexión: ' . $this->mysqli->connect_error);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function balioztatzea($user, $pass)
    {
        $sql = "SELECT * FROM jokalariak WHERE erabiltzailea = '$user' AND pasahitza = '$pass'";
        $result = $this->mysqli->query($sql);

        if ($result === false) {
            return -1;
        }

        if ($result->num_rows == 1) {
            $sql2 = "SELECT * FROM jokalariak WHERE erabiltzailea = '$user' AND pasahitza = '$pass' AND isAdmin = 1";
            $result2 = $this->mysqli->query($sql2);

            if ($result2 === false) {
                return -1;
            }

            if ($result2->num_rows == 1) {
                return 1; //Admin
            } else {
                return 2; //Usuario Normal
            }
        } else {
            return 3;
        }
    }

    public function eguneratu_puntuazioa($user, $punt)
    {
        $sql = "UPDATE jokalariak SET puntuazio_max = puntuazio_max + " . $punt . "  WHERE erabiltzailea = '" . $user . "'";
        $this->mysqli->query($sql);
    }

    public function zerrenda_ordenatuta()
    {
        try {
            $sql = "SELECT erabiltzailea, puntuazio_max FROM jokalariak WHERE isAdmin != 1 ORDER BY puntuazio_max DESC;";
            $emaitza = $this->mysqli->query($sql);
            foreach ($emaitza as $lerroa) {
                $zerrenda[$lerroa['erabiltzailea']] = $lerroa['puntuazio_max'];
            }
            return $zerrenda;

        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function galderak_eskatu()
    {
        $sql = "SELECT * FROM galderakTaula";
        $emaitza = $this->mysqli->query($sql);

        $galderaZerrenda = array();

        foreach ($emaitza as $lerroa) {
            $galdera = $lerroa['galdera'];
            $erantzunak = $lerroa['erantzunPosibleak'];
            $galderaZerrenda[$galdera] = explode('/', $erantzunak);
        }

        return $galderaZerrenda;
    }

    public function erantzunak_eskatu()
    {
        $sql = "SELECT * FROM galderakTaula";
        $emaitza = $this->mysqli->query($sql);

        $erantzunZerrenda = array();

        foreach ($emaitza as $lerroa) {
            $galdera = $lerroa['galdera'];
            $erantzunak = $lerroa['erantzunOna'];
            $erantzunenBalioa = $lerroa['galderarenBalioa'];
            $erantzunZerrenda[$galdera] = array($erantzunak, $erantzunenBalioa);
        }
        return $erantzunZerrenda;
    }

    public function erantzunakBalidatu($emaitzenArraya, $user)
    {
        $puntuak = 0;
        $kont = 0;
        foreach ($emaitzenArraya as $galdera => $erantzuna) {
            if ($_POST['galdera' . $kont++] == $erantzuna[0]) {
                echo ($galdera . " galderaren erantzuna " . $erantzuna[0] . " da. Beraz zuzena da [" . $erantzuna[1] . " Puntu]. <br><br>");
                $puntuak += $erantzuna[1];

                $galderaID = $this->eskatuGalderaID($galdera);
                $sql = "INSERT INTO partidaTaula (erabiltzailea, partidaOrdua, galderaId, galderaZuzena) VALUES ('$user', now(), $galderaID, 1);";
                $this->mysqli->query($sql);

            } else {
                $galderaID = $this->eskatuGalderaID($galdera);
                $sql = "INSERT INTO partidaTaula (erabiltzailea, partidaOrdua, galderaId, galderaZuzena) VALUES ('$user', now(), $galderaID, 0);";
                $this->mysqli->query($sql);
            }
        }
        return $puntuak;
    }

    public function eskatuGalderaID($galdera)
    {
        $sql = "SELECT galderaId FROM galderakTaula WHERE galdera = '$galdera'";
        $emaitza = $this->mysqli->query($sql);
        if ($emaitza) {
            $row = $emaitza->fetch_assoc();
            if ($row) {
                return $row['galderaId'];
            }
        }
    }

    public function AddGaldera($galdera, $erantzuna, $erantzunOna, $puntuazioa)
    {
        try {
            $sql = "INSERT INTO galderaktaula (galdera, erantzunPosibleak, erantzunOna, galderarenBalioa) VALUES ('$galdera', '$erantzuna', '$erantzunOna', $puntuazioa);";
            $this->mysqli->query($sql);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function comprobarUsuario($user, $pass)
    {
        $sql = "SELECT * FROM jokalariak WHERE erabiltzailea = '$user'";
        $result = $this->mysqli->query($sql);

        if ($result->num_rows == 1) {
            return false;
        } else {
            return true;
        }
    }
    public function AddUser($user, $pass, $isAdmin)
    {
        $noExiste = $this->comprobarUsuario($user, $pass);
        if ($noExiste) {
            try {
                $sql = "INSERT INTO jokalariak (erabiltzailea, pasahitza, isAdmin) VALUES ('$user', '$pass', $isAdmin)";
                $this->mysqli->query($sql);
                return true;
            } catch (Exception $ex) {
                throw $ex;
            }
        } else {
            return false;
        }

    }
}
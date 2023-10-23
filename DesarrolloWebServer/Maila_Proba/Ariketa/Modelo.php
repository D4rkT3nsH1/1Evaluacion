<?php

class Jokalari_Modeloa
{

    private $mysqli;

    //Konektatzeko funtzio/ Función para realizar la conexión.
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

    //Logina egiaztatzeko funtzioa./ Función para comprobar el login.
    public function balioztatzea($user, $pass)
    {
        $sql = "SELECT * FROM jokalariak WHERE erabiltzailea = '" . $user . "' and pasahitza = '" . $pass . "'";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    // Puntuazioa eguneratuko da DBan. Se actualizará la puntuación en DB
    public function eguneratu_puntuazioa($user, $punt)
    {
        $sql = "UPDATE jokalariak SET puntuazio_max = puntuazio_max + " . $punt . "  WHERE erabiltzailea = '" . $user . "'";
        $this->mysqli->query($sql);
    }

    // Puntuazioaren arabera ordenatutako erabiltzaile zerrenda asoziatiboa itzuliko du.
    // Devolverá la lista asociativa de usuarios ordenada por puntuación.
    public function zerrenda_ordenatuta()
    {
        try {
            $sql = "SELECT erabiltzailea, puntuazio_max FROM jokalariak ORDER BY puntuazio_max DESC;";
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
            $erantzunZerrenda[$galdera] = $erantzunak;
        }
        return $erantzunZerrenda;
    }

    public function erantzunakBalidatu($emaitzenArraya)
    {
        $puntuak = 0;
        $kont = 0;
        foreach ($emaitzenArraya as $galdera => $erantzuna) {
            if ($_POST['galdera' . $kont++] == $erantzuna) {
                echo ($galdera . " galderaren erantzuna " . $erantzuna . " da. Beraz zuzena da. <br><br>");
                $puntuak += 3;
            }
        }
        return $puntuak;
    }
}
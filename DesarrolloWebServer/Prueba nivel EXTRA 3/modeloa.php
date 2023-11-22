<?php

class Jokalari_Modeloa
{

    private $mysqli;

    // Konektatzeko funtzio/ Función para realizar la conexión.
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

    // Logina egiaztatzeko funtzioa./ Función para comprobar el login.
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

    public function balioztatzeaErabiltzaileIzena($user)
    {
        $sql = "SELECT * FROM jokalariak WHERE erabiltzailea = '" . $user . "'";
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
        $sql = "SELECT puntuazio_max FROM jokalariak WHERE erabiltzailea = '" . $user . "'";
        $emai = $this->mysqli->query($sql);
        $emaitza = $emai->fetch_array();
        $puntuazioa = $emaitza[0];
        $puntuazioa = $puntuazioa + $punt;

        $sql = "UPDATE jokalariak SET puntuazio_max = " . $puntuazioa . "  WHERE erabiltzailea = '" . $user . "'";
        $this->mysqli->query($sql);
    }

    // Puntuazioa eguneratuko da DBan. Se actualizará la puntuación en DB
    public function erabiltzaile_berria($user, $pass)
    {
        try {
            $sql = "INSERT INTO jokalariak(erabiltzailea,pasahitza,puntuazio_max) VALUES('" . $user . "','" . $pass . "', 0);";
            $res = $this->mysqli->query($sql);
        } catch (Exception $ex) {
            throw $ex;
        }
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

    public function galderaZailakIdatzi()
    {
        try {
            $sql = "SELECT galderak, erantzunposibleak FROM galderaerantzunak WHERE zaila = 1;";
            $emaitza = $this->mysqli->query($sql);
            $galderak = array();
            foreach ($emaitza as $lerroa) {
                $galderak[$lerroa['galderak']] = explode("/", $lerroa['erantzunposibleak']);
            }
            return $galderak;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function galderaErrazakIdatzi()
    {
        try {
            $sql = "SELECT galderak, erantzunposibleak FROM galderaerantzunak WHERE zaila = 0;";
            $emaitza = $this->mysqli->query($sql);
            $galderak = array();
            foreach ($emaitza as $lerroa) {
                $galderak[$lerroa['galderak']] = explode("/", $lerroa['erantzunposibleak']);
            }
            return $galderak;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function erantzunZailZuzenak()
    {
        try {
            $sql = "SELECT galderak, erantzunzuzenak, galderarenpuntuazioa FROM galderaerantzunak WHERE zaila = 1;";
            $emaitza = $this->mysqli->query($sql);
            $galderak = array();
            foreach ($emaitza as $lerroa) {
                $galderak[$lerroa['galderak']] = array(
                    $lerroa['erantzunzuzenak'],
                    $lerroa['galderarenpuntuazioa']
                );
            }
            return $galderak;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function erantzunErrazZuzenak()
    {
        try {
            $sql = "SELECT galderak, erantzunzuzenak, galderarenpuntuazioa FROM galderaerantzunak WHERE zaila = 0;";
            $emaitza = $this->mysqli->query($sql);
            $galderak = array();
            foreach ($emaitza as $lerroa) {
                $galderak[$lerroa['galderak']] = array(
                    $lerroa['erantzunzuzenak'],
                    $lerroa['galderarenpuntuazioa']
                );
            }
            return $galderak;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function adminBalioztatzea($user)
    {
        $sql = "SELECT * FROM jokalariak WHERE erabiltzailea = '" . $user . "' and administraria = 1";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function galdera_berria($galdera, $erantzunposibleak, $erantzunzuzena, $galderarenpuntuazioa, $zaila)
    {
        try {
            $sql = "INSERT INTO galderaerantzunak(id, galderak, erantzunposibleak, erantzunzuzenak, galderarenpuntuazioa, zaila)
                     VALUES(NULL, '" . $galdera . "','" . $erantzunposibleak . "','" . $erantzunzuzena . "','" . $galderarenpuntuazioa . "','" . $zaila . "');";
            $res = $this->mysqli->query($sql);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function partidaDatuak($erabiltzailea, $idgaldera, $erantzunzuzena)
    {
        try {
            $sql = "INSERT INTO partida(erabiltzailea, idgaldera, data, erantzunzuzena)
                     VALUES('". $erabiltzailea . "','" . $idgaldera . "', current_timestamp(), '" . $erantzunzuzena ."');";
            $res = $this->mysqli->query($sql);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function galderarenIdAtera($erantzuna)
    {
        try {
            $sql = "SELECT id FROM galderaerantzunak WHERE erantzunzuzenak = '" . $erantzuna . "';";
            $emaitza = $this->mysqli->query($sql);
            $galderak = "";
            foreach ($emaitza as $lerroa) {
                $galderak = $lerroa['id'];
            }
            if ($this->mysqli->affected_rows == 1) {
                return $galderak;
            } 
        } catch (Exception $ex) {
            throw $ex;
        }
        
    }
    
    public function zenbatZuzen($galderaId)
    {
        try {
            $sql = "SELECT COUNT(erantzunzuzena) FROM partida WHERE erantzunzuzena = 1 AND idgaldera = " . $galderaId .";";
            $emaitza = $this->mysqli->query($sql);
            $galderak = "";
            foreach ($emaitza as $lerroa) {
                $galderak = $lerroa['COUNT(erantzunzuzena)'];
            }
            if ($this->mysqli->affected_rows == 1) {
                return $galderak;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        
    }
    
    public function zenbatGaizki($galderaId)
    {
        try {
            $sql = "SELECT COUNT(erantzunzuzena) FROM partida WHERE erantzunzuzena = 0 AND idgaldera = " . $galderaId .";";
            $emaitza = $this->mysqli->query($sql);
            $galderak = "";
            foreach ($emaitza as $lerroa) {
                $galderak = $lerroa['COUNT(erantzunzuzena)'];
            }
            if ($this->mysqli->affected_rows == 1) {
                return $galderak;
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        
    }
    
    public function galderaBalioztatzea($galderaId)
    {
        $sql = "SELECT * FROM galderaerantzunak WHERE id = " . $galderaId . ";";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function galderaIdatzi($galderaId)
    {
        try {
            $sql = "SELECT galderak FROM galderaerantzunak  WHERE id = " . $galderaId . ";";
            $emaitza = $this->mysqli->query($sql);
            $galderak = array();
            foreach ($emaitza as $lerroa) {
                $galderak = $lerroa['galderak'];
            }
            return $galderak;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function partidaZerrendatuGalderarekiko($galderaId, $erab)
    {
        try {
            $sql = "SELECT `erabiltzailea`, `idgaldera`, `data`, `erantzunZuzena` FROM `partida` WHERE idgaldera = " . $galderaId ." AND erabiltzailea = '" . $erab . "';";
            $emaitza = $this->mysqli->query($sql);
            $galderak = array();
            foreach ($emaitza as $lerroa) {
                $galderak[$lerroa['idgaldera']] = array(
                    $lerroa['erabiltzailea'],
                    $lerroa['erantzunZuzena'],
                    $lerroa['data']
                );
            }
            return $galderak;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function partidaZerrendatuEgunarekiko($data,$erab)
    {
        try {
            $sql = "SELECT `erabiltzailea`, `idgaldera`, `data`, `erantzunZuzena` FROM `partida` WHERE data LIKE '%" . $data ."%' AND erabiltzailea = '" . $erab . "';";
            $emaitza = $this->mysqli->query($sql);
            $galderak = array();
            foreach ($emaitza as $lerroa) {
                $galderak[$lerroa['data']] = array(
                    $lerroa['erabiltzailea'],
                    $lerroa['idgaldera'],
                    $lerroa['erantzunZuzena']
                );
            }
            return $galderak;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function galderaPartidaBalioztatzea($galderaId,$erab)
    {
        $sql = "SELECT * FROM partida WHERE idgaldera = " . $galderaId . " AND erabiltzailea = '" . $erab . "';";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows >= 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function egunaPartidaBalioztatzea($data,$erab)
    {
        $sql = "SELECT * FROM partida WHERE data LIKE '" . $data ."%' AND erabiltzailea = '" . $erab . "';";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows >= 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
    
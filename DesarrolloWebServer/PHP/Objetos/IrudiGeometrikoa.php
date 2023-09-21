<?php
class IrudiGeometrikoa {
    private $izena;
    private $kolorea;

    public function __construct($izena, $kolorea) {
        $this->izena = $izena;
        $this->kolorea = $kolorea;
    }

    public function getIzena() {
        return $this->izena;
    }

    public function setIzena($izena) {
        $this->izena = $izena;
    }

    public function getKolorea() {
        return $this->kolorea;
    }

    public function setKolorea($kolorea) {
        $this->kolorea = $kolorea;
    }

    public function idatzi() {
        echo "Izena: " , $this->izena , "<br>";
        echo "Kolorea: " , $this->kolorea , "<br>";
    }
}

?>
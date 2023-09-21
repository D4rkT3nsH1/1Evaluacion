<?php
require_once('IrudiGeometrikoa.php');

class Triangelua extends IrudiGeometrikoa {
    private $oinarria;
    private $altuera;

    public function __construct($izena, $kolorea, $oinarria, $altuera) {
        parent::__construct($izena, $kolorea);

        $this->oinarria = $oinarria;
        $this->altuera = $altuera;
    }

    public function idatziTriangelu() {
        parent::idatzi();

        echo "Oinarria: " , $this->oinarria , "<br>";
        echo "Altura: " , $this->altuera , "<br>";
    }

    public function areaKalkulatu() {
        $area = 0.5 * $this->oinarria * $this->altuera;
        return $area;
    }
}
?>
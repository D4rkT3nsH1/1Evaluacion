<?php
require_once('Triangelua.php');

$triangelua = new Triangelua("", "berdea", 3, 5);

$triangelua->setIzena("B"); 
$triangelua->idatziTriangelu();

$area = $triangelua->areaKalkulatu();
echo "Triangeluaren Area: " , $area , "<br>";

?>
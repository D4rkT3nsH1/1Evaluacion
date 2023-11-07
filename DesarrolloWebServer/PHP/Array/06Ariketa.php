<?php

$array = array("Iker" => 1, "Arkaitz" => 2, "Gontzal" => 3, "Jon" => 4);

foreach ($array as $nombre) {
    echo "$nombre <br>";
}

foreach ($array as $nombre => $valor) {
    echo "$nombre => $valor <br>";
}

ksort($array);
foreach ($array as $nombre => $valor) {
    echo "$nombre => $valor <br>";
} 

echo "<br>";

natsort($array);
foreach ($array as $nombre => $valor) {
    echo "$nombre => $valor <br>";
}  

?>
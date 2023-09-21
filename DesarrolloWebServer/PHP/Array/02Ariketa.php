<?php
$AstekoEgunak["Lunes"] = 6;
$AstekoEgunak["Martes"] = 8;
$AstekoEgunak["Miercoles"] = 12;
$AstekoEgunak["Jueves"] = 54;
$AstekoEgunak["Viernes"] = 65;
$AstekoEgunak["Sabado"] = 3;
$AstekoEgunak["Domingo"] = 98;

$media = array_sum($AstekoEgunak)/count($AstekoEgunak);

foreach ($AstekoEgunak as $eguna => $value) {
    echo "$eguna -> $value <br>";
}

echo "Total: ", array_sum($AstekoEgunak), "<br>";
echo "Media: ", $media;
?>
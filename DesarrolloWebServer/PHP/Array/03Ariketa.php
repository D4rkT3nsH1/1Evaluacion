<?php
$meses = array(
    "urtarrila" => 0,
    "otsaila" => 0,
    "martxoa" => 0,
    "apirila" => 0,
    "maiatza" => 0,
    "ekaina" => 0,
    "uztaila" => 0,
    "abuztua" => 0,
    "iraila" => 0,
    "urria" => 0,
    "azaroa" => 0,
    "abendua" => 0
);
$cortos = array("apirila","ekaina","iraila","azaroa");   
$largos = array("urtarrila","martxoa","maiatza","uztaila","abuztua","urria","abendua");

foreach ($meses as $mes => $dias)
{
    
    if (in_array($mes,$cortos ))
    {
        $dias = 30;
        
    } else if (in_array($mes,$largos)) { 
        $dias = 31;
        
    } else {
        
        $dias = cal_days_in_month(CAL_GREGORIAN, 2, date("Y"));
    }
    $meses[$mes]=$dias;
}

echo "<table>";
foreach ($meses as $mes => $dias)
{
    echo "<tr><td>$mes</td><td>$dias</td></tr>";
}
echo "</table>";
?>
<?php

require_once("../model/modelo_denda.php");
$cont = new modelo_denda();
$datos = $cont->get_dendak();

$dendak = json_encode($datos);
print $dendak;

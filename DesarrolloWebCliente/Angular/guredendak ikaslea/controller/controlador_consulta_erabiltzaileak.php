<?php

require_once("../model/modelo_erabiltzaileak.php");
$cont = new modelo_erabiltzaileak();
$datos = $cont->get_erabiltzaileak();

$erabiltzaileak = json_encode($datos);
print $erabiltzaileak;

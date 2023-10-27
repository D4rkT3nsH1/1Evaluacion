<?php

include_once 'Vista.php';
include_once 'Modelo.php';

session_start();
$_SESSION["balioztatua"] = false;
$_SESSION["isAdmin"] = false;

$Vista = new LogVista;
$Vista->HasierakoFormularioa();

?>
<?php

include_once 'Vista.php';
include_once 'Modelo.php';

//Logina egoki egin den zehazteko/ Guarda el estado del login.
session_start();
$_SESSION["balioztatua"] = FALSE;


//Hasierako Formularioa kargatu/ Cargar el primer formulario
$Vista = new LogVista;
$Vista->HasierakoFormularioa();

?>
<?php

include_once 'bista.php';
include_once 'modeloa.php';

//Logina egoki egin den zehazteko/ Guarda el estado del login.
session_start();
$_SESSION["balioztatua"]= FALSE;
$_SESSION["galderaZailak"] = FALSE;
$_SESSION["galderaErrazak"] = FALSE;
$_SESSION["erabBilatu"] = "";


//Hasierako Formularioa kargatu/ Cargar el primer formulario
$LogBis= new Login_Bista;
$LogBis-> HasierakoFormularioa();


?>
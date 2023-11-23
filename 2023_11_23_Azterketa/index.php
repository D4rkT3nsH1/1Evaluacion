<?php

include_once "bista.php";

//Logina egoki egin den zehazteko/ Guarda el estado del login.
session_start();
$_SESSION['valido'] = false;

//Hasierako Formularioa kargatu/ Cargar el pri mer formulario
$LogBis = new Login_Bista;
$LogBis->Login();

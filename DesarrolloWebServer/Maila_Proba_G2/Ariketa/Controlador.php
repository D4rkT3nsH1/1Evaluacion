<?php

session_start();

include_once "Vista.php";
include_once "Modelo.php";

$LoginVista = new LogVista;
$Modelo = new Jokalari_Modeloa;

$Modelo->konektatu();

if (isset($_POST["botoia"]) && !$_SESSION["balioztatua"]) {
    if ($Modelo->balioztatzea($_POST["erab"], $_POST["ph"]) == 1) {
        $_SESSION["balioztatua"] = TRUE;
        $_SESSION["isAdmin"] = TRUE;
        $_SESSION["Erab"] = $_POST["erab"];
    } else if ($Modelo->balioztatzea($_POST["erab"], $_POST["ph"]) == 2) {
        $_SESSION["balioztatua"] = TRUE;
        $_SESSION["Erab"] = $_POST["erab"];
    } else {
        ?>
            <h3 style="color: red;">Saiatu berriro, erabiltzailea edo pasahitza ez dituzu ondo sartu. </h3>
            <?php
            $LoginVista->HasierakoFormularioa();
    }
}

if ($_SESSION["balioztatua"] && isset($_POST["botoia"])) {
    if (isset($_POST["opcion"]) && $_SESSION["isAdmin"]) {
        switch ($_POST["opcion"]) {
            case "zerrenda":
                $LoginVista->Aukera_Eman_Admin();
                $LoginVista->zerrendatu($Modelo->zerrenda_ordenatuta());
                break;

            case "addUser":
                $LoginVista->addUser();
                break;

            case "addGaldera":
                $LoginVista->addGaldera();
                break;

            case "jokatu":
                $LoginVista->galdera_erantzunak_marraztu($Modelo->galderak_eskatu());
                break;


        }
    } else if (isset($_POST["opcion"])) {
        switch ($_POST["opcion"]) {
            case "zerrenda":
                $LoginVista->Aukera_Eman();
                $LoginVista->zerrendatu($Modelo->zerrenda_ordenatuta());
                break;
            case "jokatu":
                $LoginVista->galdera_erantzunak_marraztu($Modelo->galderak_eskatu());
                break;
        }
    } else {
        ?>
            <h3 style="color: red;">Ez duzu zehaztu zer den egin nahi duzuna/ No has elegido qué quieres hacer. </h3>
            <?php
            $LoginVista->Aukera_Eman();
    }
}

if ($_SESSION["isAdmin"] && isset($_POST["botoia_galdera"])) {
    if ($_POST["pregunta"] != "" && $_POST["respuestas"] != "" && $_POST["respuestaBuena"] != "" && $_POST["puntuacion"] != "") {
        $galdera = $_POST["pregunta"];
        $respuestas = $_POST["respuestas"];
        $respuestaBuena = $_POST["respuestaBuena"];
        $puntuazioa = $_POST["puntuacion"];

        $Modelo->AddGaldera($galdera, $respuestas, $respuestaBuena, $puntuazioa);
        $LoginVista->Aukera_Eman_Admin();
    } else {
        ?>
        <h3 style="color: red;">Has dejado algún campo vacio o ha habido un error</h3>
        <?php
        $LoginVista->Aukera_Eman_Admin();
    }
}

if ($_SESSION["isAdmin"] && isset($_POST["botoia_user"])) {
    if ($_POST["user"] != "" && $_POST["pass"] != "" && $_POST["isAdmin"] != "") {
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        $isAdmin = $_POST["isAdmin"];

        $Modelo->AddUser($user, $pass, $isAdmin);
        $LoginVista->Aukera_Eman_Admin();
    } else {
        ?>
        <h3 style="color: red;">Has dejado algún campo vacio o ha habido un error</h3>
        <?php
        $LoginVista->Aukera_Eman_Admin();
    }
}


if ($_SESSION["balioztatua"] && isset($_POST["jokatu_botoia"])) {

    $puntuak = $Modelo->erantzunakBalidatu($Modelo->erantzunak_eskatu(), $_SESSION["Erab"]);

    echo $puntuak . " puntu lortu dituzu. <br><br>";
    $Modelo->eguneratu_puntuazioa($_SESSION["Erab"], $puntuak);

    $LoginVista->Aukera_Eman();
}
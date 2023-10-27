<?php

session_start();

include_once "Vista.php";
include_once "Modelo.php";

$LoginVista = new LogVista;
$Modelo = new Modelo;

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

if (!$_SESSION["isAdmin"] && isset($_POST["volver"])) {
    $LoginVista->Aukera_Eman();
} else if ($_SESSION["isAdmin"] && isset($_POST["volver"])) {
    $_SESSION["desdeZerrenda"] = false;
    $_SESSION["desdePreguntas"] = false;
    $LoginVista->Aukera_Eman_Admin();
}

if ($_SESSION["balioztatua"] && isset($_POST["botoia"])) {
    if (isset($_POST["opcion"]) && $_SESSION["isAdmin"]) {
        switch ($_POST["opcion"]) {
            case "zerrenda":
                $LoginVista->Aukera_Eman_Admin();
                $LoginVista->UserData();
                $LoginVista->zerrendatu($Modelo->zerrenda_ordenatuta());
                $LoginVista->botonVoler();
                break;

            case "preguntas":
                $_SESSION["desdePreguntas"] = TRUE;
                $LoginVista->zerrendatuGalderak($Modelo->getGalderakID());
                $LoginVista->UserDataByGalderaId();
                $LoginVista->botonVoler();
                break;

            case "addUser":
                $LoginVista->addUser();
                $LoginVista->botonVoler();
                break;

            case "addGaldera":
                $LoginVista->addGaldera();
                $LoginVista->botonVoler();
                break;

            case "jokatu":
                $LoginVista->galdera_erantzunak_marraztu($Modelo->galderak_eskatu());
                $LoginVista->botonVoler();
                break;


        }
    } else if (isset($_POST["opcion"])) {
        switch ($_POST["opcion"]) {
            case "zerrenda":
                $LoginVista->Aukera_Eman();
                $LoginVista->zerrendatu($Modelo->zerrenda_ordenatuta());
                $LoginVista->botonVoler();
                break;
            case "jokatu":
                $LoginVista->galdera_erantzunak_marraztu($Modelo->galderak_eskatu());
                $LoginVista->botonVoler();
                break;
        }
    } else {
        ?>
            <h3 style="color: red;">Ez duzu zehaztu zer den egin nahi duzuna/ No has elegido qué quieres hacer. </h3>
            <?php
            $LoginVista->Aukera_Eman();
    }
}

if ($_SESSION["isAdmin"] && isset($_POST["user_data"])) {
    $_SESSION["desdeZerrenda"] = TRUE;
    if ($_POST["userData"] != "") {
        $user = $_POST["userData"];
        $_SESSION["userTemp"] = $user;
        $userExiste = $Modelo->getUserData($user);
        if ($userExiste) {
            $LoginVista->zerrendatuGalderak($Modelo->getGalderakID());
            $LoginVista->UserDataByGalderaId();
            $LoginVista->zerrendatuGalderaData($userExiste);
            $LoginVista->botonVoler();
        } else {
            ?>
            <h3 style="color: red;">El usuario no existe</h3>
            <?php
            $LoginVista->Aukera_Eman_Admin();
        }
    }
}

if ($_SESSION["isAdmin"] && $_SESSION["desdePreguntas"] && isset($_POST["galdera_id_btn"])) {
    $_SESSION["desdePreguntas"] = false;
    if ($_POST["galderaID"] != "") {
        $galderaId = $_POST["galderaID"];
        if ($Modelo->comprobarPreguntaId($galderaId)) {
            $LoginVista->zerrendatuGalderaData($Modelo->getPreguntasById($galderaId));
            $LoginVista->botonVoler();
        } else {
            ?>
            <h3 style="color: red;">La id de esa pregunta no existe</h3>
            <?php
            $LoginVista->Aukera_Eman_Admin();
        }
    }
}

if ($_SESSION["isAdmin"] && $_SESSION["desdeZerrenda"] && isset($_POST["galdera_id_btn"])) {
    $_SESSION["desdeZerrenda"] = false;
    if ($_POST["galderaID"] != "") {
        $user = $_SESSION["userTemp"];
        $_SESSION["userTemp"] = null;
        $galderaId = $_POST["galderaID"];
        $userPorIdGaldera = $Modelo->getUserDataAndGid($user, $galderaId);
        if ($userPorIdGaldera) {
            $LoginVista->zerrendatuGalderaData($userPorIdGaldera);
            $LoginVista->botonVoler();
        } else {
            ?>
            <h3 style="color: red;">La id de esa pregunta no existe</h3>
            <?php
            $LoginVista->Aukera_Eman_Admin();
        }
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
        $userNuevo = $Modelo->AddUser($user, $pass, $isAdmin);
        if ($userNuevo) {
            ?>
            <h3 style="color: green;">Usuario añadido con éxito.</h3>
            <?php
            $LoginVista->Aukera_Eman_Admin();
        } else {
            ?>
            <h3 style="color: red;">El usuario ya existe</h3>
            <?php
            $LoginVista->addUser();
        }
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
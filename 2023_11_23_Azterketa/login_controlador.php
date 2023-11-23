<?php

include_once "user_modelo.php";
include_once "bista.php";

session_start();

$LoginVista = new Login_Bista;
$Modelo = new User_Modelo;

if (isset($_POST["b_sartu_entrar"])) {
    if ($Modelo->UserValido($_POST['erab_usuario'], $_POST['ph'])) {
        $_SESSION["Erab_usuario"] = $_POST['erab_usuario'];
        if ($_POST['erab_usuario'] == "Olen") {
            $Users = $Modelo->getAllUsers();
            $LoginVista->AukeraEmanOlen_DarOpcionesOlen($Users);
        } else {
            $LoginVista->AukeraEmanErab_DarOpcionesUsuario();
        }
    } else {
?>
        <h3 style="color: red;">Saiatu berriro, erabiltzailea edo pasahitza ez dituzu ondo sartu. </h3>
    <?php
        $LoginVista->Login();
    }
}

if (isset($_POST['b_aldatu_cambiar'])) {
    if ($Modelo->UserValido($_POST['erab_usuario'], $_POST['ph'])) {
        $LoginVista->ikusiPasahitzaAldatzeko_verCambioContras();
    } else {
    ?>
        <h3 style="color: red;">Saiatu berriro, erabiltzailea edo pasahitza ez dituzu ondo sartu. </h3>
    <?php
        $LoginVista->Login();
    }
}

if (isset($_POST['onartuAldaketa_aceptarCambio'])) {
    if ($Modelo->changePass($_SESSION["Erab_usuario"], $_POST['ph'])) {
    ?>
        <h3 style="color: green;">Contraseña actualizada</h3>
        <?php
        $LoginVista->Login();
    }
}

if (isset($_POST['b_berria_nuevo'])) {
    $LoginVista->Alta_AukeraEman_Opcion();
}

    if (isset($_POST['ok_alta'])) {
    if (!$Modelo->UserValido($_POST['erab_usuario'], $_POST['ph'])) {
        if ($Modelo->NewUser($_POST['izena_nombre'], $_POST['data_fecha'], $_POST['erab_usuario'], $_POST['ph'])) {
        ?>
            <h3 style="color: green;">Usuario Registrado</h3>
        <?php
            $LoginVista->Login();
        }
    } else {
        ?>
        <h3 style="color: red;">El usuario ya existe</h3>
<?php
        $LoginVista->Login();
    }
}

<?php

include_once "user_modelo.php";
include_once "bista.php";

session_start();

$LoginVista = new Login_Bista;
$Modelo = new User_Modelo;

if (isset($_POST["b_erabAukeratu_elegirUsuario"])) {
    if (isset($_POST["erab_usuario"])) {
        $_SESSION["userEkintzak"] = $_POST["erab_usuario"];
        $userDate = $Modelo->getUserDate($_POST["erab_usuario"]);
        $userAdina = $Modelo->adinaKalkulatu_calcularEdad($userDate);
        $stringAdina = $Modelo->userEdadToString($userAdina);
        $Acciones = $Modelo->getAccionesFromUserAdina($stringAdina);
        $LoginVista->EkintzakBistaratu_VisualizarAcciones($Acciones);
    }
}



if (isset($_POST["b_gutuna_carta"])) {
    if (isset($_POST["opcion"])) {
        switch ($_POST["opcion"]) {
            case "idatzi_escribir":
                $userDate = $Modelo->getUserDate($_SESSION["Erab_usuario"]);
                $userAdina = $Modelo->adinaKalkulatu_calcularEdad($userDate);
                $stringAdina = $Modelo->userEdadToString($userAdina);
                $LoginVista->erakutsiOpariak_mostrarRegalos($Modelo->getOpariakByAdina($stringAdina));
                break;

            case "aldatu_cambiar":
                if ($Modelo->getUserGutunak($_SESSION["Erab_usuario"])) {
                    echo "TODO";
                } else {
?>
                    <h3 style="color: red;">Ez daukazu gutunik</h3>
            <?php
                    $LoginVista->AukeraEmanErab_DarOpcionesUsuario();
                }
                break;
        }
    }
}

if (isset($_POST["b_eskariak_peticiones"])) {
    if (isset($_POST['opariak']) && is_array($_POST['opariak'])) {
        $opariakSeleccionadas = $_POST['opariak'];
        $opariakString = implode('/', $opariakSeleccionadas);
        if ($Modelo->insertGutunaFromUser($_SESSION["Erab_usuario"], $opariakString)) {
            ?>
            <h3 style="color: green;">Gutuna idatzita</h3>
        <?php
            $LoginVista->AukeraEmanErab_DarOpcionesUsuario();
        } else {
        ?>
            <h3 style="color: red;">Error al escribir la gutuna</h3>
        <?php
            $LoginVista->AukeraEmanErab_DarOpcionesUsuario();
        }
    } else {
        ?>
        <h3 style="color: red;">Ez duzu oparirik aukeratu</h3>
        <?php
        $LoginVista->AukeraEmanErab_DarOpcionesUsuario();
    }
}

if (isset($_POST["b_ekintzak_acciones"])) {
    if (isset($_POST['ekintzak']) && is_array($_POST['ekintzak'])) {
        $ekintzakSeleccionadas = $_POST['ekintzak'];
        $ekintzakString = implode('/', $ekintzakSeleccionadas);
        if ($Modelo->insertEkintzak($_SESSION["userEkintzak"], $ekintzakString)) {
        ?>
            <h3 style="color: green;">Ekintzak idatzita</h3>
        <?php
            $LoginVista->Login();
        } else {
        ?>
            <h3 style="color: red;">Error</h3>
        <?php
            $LoginVista->Login();
        }
    } else {
        ?>
        <h3 style="color: red;">Ez duzu ekintzarik aukeratu</h3>
<?php
        $LoginVista->Login();
    }
}

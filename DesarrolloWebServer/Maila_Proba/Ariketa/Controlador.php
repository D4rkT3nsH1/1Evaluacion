<?php

session_start();

include_once 'Vista.php';
include_once 'Modelo.php';

$LoginVista = new LogVista;
$Modelo = new Jokalari_Modeloa;

$Modelo->konektatu();

/*
//Galdera eta erantzun posibleen array asoziatiboa.
//Array asociativo de la preguntas y posbles respuestas.
$galderakArraya = [
    "Zein da urrearen elemetu kimikoa?" => array("Fr", "Au", "Ur"),
    "Urdina eta gorriaren nahasketatatik zer ateratzen da?" => array("Berdea", "Morea"),
    "Zenbat da 4x4?" => array("7", "16", "14", "15")
];


//Galdera eta erantzunaren array asoziatiboa.
//Array asociativo de la pregunta con su respuesta.
$emaitzen_arraya = [
    "Zein da urrearen elemetu kimikoa?" => "Au",
    "Urdina eta gorriaren nahasketatatik zer ateratzen da?" => "Morea",
    "Zenbat da 4x4?" => "16"
];
*/

//Logina egiaztatzen du, egokia ez bada mezua erakutsi eta formularioa berriro kargatuta.
//Comprueba el login, si no es adecuado muestra un mensaje y el formulario.
if (isset($_POST['botoia']) && !$_SESSION["balioztatua"]) {
    if ($Modelo->balioztatzea($_POST['erab'], $_POST['ph'])) {
        $_SESSION["balioztatua"] = TRUE;
        $_SESSION["Erab"] = $_POST['erab'];
    } else {
        ?>
        <h3 style="color: red;">Saiatu berriro, erabiltzailea edo pasahitza ez dituzu ondo sartu. </h3>
        <?php
        $LoginVista->HasierakoFormularioa();
    }
}


/*Logina egiaztatuta dagola eta fomularioko botoia emanda, aukeraren arabera puntuazioak erakutsi
edo jokoari hasiera emango zaio. Aukerarik ez bada egin errore mezua agertuko da eta aukeren 
formularioa erakutsiko da. /

Una vez el login esté hecho y se pulse el boton del formulario según la opción escogida muestra 
la puntuación o muestra el juego. Si no se ha elegido ninguna opción muestra una un error y el 
fomulario para poder elegir la opción.*/

if ($_SESSION["balioztatua"] && isset($_POST['botoia'])) {
    if (isset($_POST['opcion'])) {
        switch ($_POST['opcion']) {
            case "zerrenda":
                echo "Sesioa: " . $_SESSION["Erab"];
                $LoginVista->Aukera_Eman();
                $LoginVista->zerrendatu($Modelo->zerrenda_ordenatuta());
                break;
            case "jokatu":
                echo "Sesioa: " . $_SESSION["Erab"];
                $galderakArraya = $Modelo->galderak_eskatu();
                $LoginVista->galdera_erantzunak_marraztu($galderakArraya);
                break;
        }
    } else {
        ?>
        <h3 style="color: red;">Ez duzu zehaztu zer den egin nahi duzuna/ No has elegido qué quieres hacer. </h3>
        <?php
        $LoginVista->Aukera_Eman();
    }
}


/*Logina zuzenda izanda eta jokatzeko botoiari emanda, jokoko erantzunak egiaztatu eta 
puntuazioa kalkulatzen da ostean DBan eguneraketa egiteko./

Si el login es correcto y se ha elegido la opción de jugar se analizan la respuestas, se asigna 
la puntuación y se actualiza dicha puntuación el la DB.
*/
if ($_SESSION["balioztatua"] && isset($_POST['jokatu_botoia'])) {

    $emaitzenArraya = $Modelo->erantzunak_eskatu();
    $puntuak = $Modelo->erantzunakBalidatu($emaitzenArraya);

    echo $puntuak . " puntu lortu dituzu. <br><br>";
    $Modelo->eguneratu_puntuazioa($_SESSION["Erab"], $puntuak);
    $LoginVista->Aukera_Eman();
}







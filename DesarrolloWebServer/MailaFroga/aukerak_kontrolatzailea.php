<?php

include_once("bista.php");

// Datu basearekin konektatu
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$database = "jokoa";

$konexioa = new mysqli($hostname, $username, $password, $database);

// Konekzioa egiaztatu
if ($konexioa->connect_error) {
    die("Errorea konektatzerakoan: " . $konexioa->connect_error);
}

$galderen_arraya = [
    "Zein da urrearen elemento kimikoa?" => ["Fr", "Au", "Ur"],
    "Urdina eta gorria nahasten da artean, zer ateratzen da?" => ["Berdea", "Morea"],
    "Zenbat da 4x4?" => ["7", "16", "14", "15"]
];

$erantzunen_arraya = [
    "Zein da urrearen elemento kimikoa?" => "Au",
    "Urdina eta gorria nahasten da artean, zer ateratzen da?" => "Morea",
    "Zenbat da 4x4?" => "16"
];

// Logina egiaztatu
session_start();

if (empty($_SESSION)) {
    if (isset($_POST['botoia'])) {
        $erabiltzailea = $_POST['erab'];
        $pasahitza = $_POST['ph'];

        $erabiltzailea = $konexioa->real_escape_string($erabiltzailea);

        $sql = "SELECT * FROM jokalariak WHERE erabiltzailea='$erabiltzailea' AND pasahitza=$pasahitza";
        $emaitza = $konexioa->query($sql);

        if ($emaitza->num_rows == 1) {
            $_SESSION['erabiltzailea'] = $erabiltzailea;
        } else {
            echo "Errorea: Logina okerra. Saiatu berriro.";
        }
    }
}


if (isset($_SESSION['erabiltzailea'])) {
    echo "Ongi etorri, " . $_SESSION['erabiltzailea'] . "!";
    echo "<br>";

    $vista = new Login_Bista();
    $vista->Aukera_Eman();

    if (isset($_POST["opcion"])) {
        if ($_POST['opcion'] == "zerrenda") {
            // Puntuazio zerrenda lortu
            $sql = "SELECT erabiltzailea, puntuazio_max FROM jokalariak ORDER BY puntuazio_max DESC";
            $emaitza = $konexioa->query($sql);

            if ($emaitza->num_rows > 0) {
                echo "Puntuazio zerrenda:";
                echo "<br>";
                echo "<table border='1'>";
                echo "<tr><th>Erabiltzailea</th><th>Puntuazio Maximoa</th></tr>";
                while ($lerroa = $emaitza->fetch_assoc()) {
                    echo "<tr><td>" . $lerroa['erabiltzailea'] . "</td><td>" . $lerroa['puntuazio_max'] . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "Ez dago erabiltzaile puntuazioik datu basean.";
            }
        } elseif ($_POST['opcion'] == "jokatu") {
            // Galdera eta erantzunak bistaratu


            $vista = new Login_Bista();
            $vista->galderak_marraztu($galderen_arraya);
        }
    }
} else {
    // Logina egin
    $vista = new Login_Bista();
    $vista->HasierakoFormularioa();
}


if (isset($_POST['jokatu_botoia'])) {

    $puntuazioa = 0;
    $arrayPost = [];

    foreach ($_POST as $galderaID => $userErantzuna) {
        if (strpos($galderaID, 'galdera') === 0) {
            $arrayPost[] = $userErantzuna;
        }
    }

    $kont = 0;
    foreach ($galderen_arraya as $preguntaGA => $respuestas) {
        $respuesta_correcta = $erantzunen_arraya[$preguntaGA];
        $respuesta_usuario = $arrayPost[$kont];

        if ($respuesta_usuario === $respuesta_correcta) {
            echo "Pregunta: " . $preguntaGA . "<br>";
            echo "Erantzuna zuzena: " . $respuesta_correcta . " beraz +3 puntu gehiago<br><br>";
            $puntuazioa += 3;
        }
        $kont++;
    }

    // Mostrar resultados
    echo "Zure puntuazioa: " . $puntuazioa ."<br>";

    // Actualizar puntuación en la base de datos (debe implementarse)
    $erabiltzailea = $_SESSION['erabiltzailea'];
	$aldatu = "UPDATE jokalariak SET puntuazio_max = puntuazio_max + $puntuazioa WHERE erabiltzailea = '$erabiltzailea'";

	//Ejecutar la sentencia SQL
	if (mysqli_query($konexioa, $aldatu)) {
		echo "La puntuación de " . $erabiltzailea . " se ha cambiado correctamente.<br>";
        echo "<a href='aukerak_kontrolatzailea.php'>Volver</a>";

	} else {
		echo "Ha ocurrido un error.";
	}
}

$konexioa->close();
?>
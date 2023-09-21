<!DOCTYPE html>
<html>
<head>
    <title>Datuak</title>
</head>
<body>
    <h1>Datu pertsonalak</h1>
    <?php
    if (isset($_POST['submit'])) {
        $nombre = $_POST['name'];
        $apellidos = $_POST['apellidos'];
        $edad = $_POST['edad'];
        $peso = $_POST['peso'];
        $genero = $_POST['sexo'];
        $estado_civil = $_POST['estado_civil'];
        $afi = isset($_POST['afi']) ? $_POST['afi'] : array();

        if (empty($nombre)) {
            echo '<p style="color: red;">Izena ez da sartu</p>';
        } else {
            echo '<p>Zure izena <strong>' . $nombre . '</strong> da.</p>';
        }

        if (empty($apellidos)) {
            echo '<p style="color: red;">Abizenak ez dira sartu</p>';
        } else {
            echo '<p>Zure abizenak <strong>' . $apellidos . '</strong> dira.</p>';
        }

        if (empty($edad)) {
            echo '<p style="color: red;">Adina ez da sartu</p>';
        } else {
            echo '<p>Zure adina <strong>' . $edad . '</strong> da.</p>';
        }

        if (empty($peso)) {
            echo '<p style="color: red;">Pisua ez da sartu</p>';
        } else {
            echo '<p>Zure pisua <strong>' . $peso . ' kg</strong> da.</p>';
        }

        if (!empty($genero)) {
            echo '<p>Zure sexua <strong>' . $genero . '</strong> da.</p>';
        }

        if ($estado_civil == "soltero") {
            echo '<p>Zure estatua soltero da.</p>';
        } elseif ($estado_civil == "casado") {
            echo '<p>Zure estatua casado da.</p>';
        } else {
            echo '<p>Zure estatua beste da.</p>';
        }

        if (!empty($afi)) {
            echo '<p>Zure gustokoak dira: <strong>' . implode(", ", $afi) . '</strong>.</p>';
        } else {
            echo '<p>Gustokoak ez dira sartu</p>';
        }
    } else {
        echo '<p style="color: red;">Datuak ez dira bidali</p>';
    }
    ?>
    <a href="01Ariketa.php">Itzuli formularioa</a>
</body>
</html>

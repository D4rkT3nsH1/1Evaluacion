<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Kalkulagailua</h1>
    <form action="" method="post">
        <label for="numero1">Sartu lehen zenbakia:</label>
        <input type="text" id="numero1" name="numero1"
            value="<?php echo isset($_POST['numero1']) ? $_POST['numero1'] : ''; ?>"><br><br>

        <label for="numero2">Sartu bigarren zenbakia:</label>
        <input type="text" id="numero2" name="numero2"
            value="<?php echo isset($_POST['numero2']) ? $_POST['numero2'] : ''; ?>"><br><br>

        <input type="submit" name="sumatu" value="Batuketa">
        <input type="submit" name="kendu" value="Kenketa">
        <input type="submit" name="biderkatu" value="Biderketa">
        <input type="submit" name="zatitu" value="Zatiketa">
    </form>
    <?php
    if (isset($_POST['sumatu']) || isset($_POST['kendu']) || isset($_POST['biderkatu']) || isset($_POST['zatitu'])) {
        $numero1 = isset($_POST['numero1']) ? $_POST['numero1'] : '';
        $numero2 = isset($_POST['numero2']) ? $_POST['numero2'] : '';

        if (!is_numeric($numero1) || !is_numeric($numero2)) {
            echo '<p style="color: red;">Zenbaki osoak sartu behar dituzu.</p>';
        } else {
            $resultado = 0;

            if (isset($_POST['sumatu'])) {
                $resultado = $numero1 + $numero2;
                echo "<p>$numero1 + $numero2 = $resultado</p>";
            } elseif (isset($_POST['kendu'])) {
                $resultado = $numero1 - $numero2;
                echo "<p>$numero1 - $numero2 = $resultado</p>";
            } elseif (isset($_POST['biderkatu'])) {
                $resultado = $numero1 * $numero2;
                echo "<p>$numero1 * $numero2 = $resultado</p>";
            } elseif (isset($_POST['zatitu'])) {
                if ($numero2 == 0) {
                    echo '<p style="color: red;">Ezin da 0-re biderkatu.</p>';
                } else {
                    $resultado = $numero1 / $numero2;
                    echo "<p>$numero1 / $numero2 = $resultado</p>";
                }
            }
        }
    }
    ?>
</body>

</html>
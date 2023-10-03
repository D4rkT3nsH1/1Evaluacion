<?php
// Konexioa sortu
$servidor = 'localhost:3306';
$usuario = 'root';
$password = '';
$dbname = 'PassAriketa';
$conn = new mysqli($servidor, $usuario, $password, $dbname);

if ($conn->connect_error) {
    die("Ezin izan da konexioa ezarri: " . $conn->connect_error);
}

if (isset($_POST["radioKudeaketa"])) {
    $opcionSeleccionada = $_POST["radioKudeaketa"];
    // 2.1 Erabiltzailearen Alta
    if ($opcionSeleccionada === "signup") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $check_user = "SELECT * FROM ERABILTZAILEAK WHERE USER='$username'";
        $result = $conn->query($check_user);

        if ($result->num_rows > 0) {
            echo "Errorea: Erabiltzailea DB-an badago.";
        } else {
            $insert_user = "INSERT INTO ERABILTZAILEAK (USER, PASSWORD) VALUES ('$username', '$password')";
            if ($conn->query($insert_user) === TRUE) {
                echo "Erabiltzailea alta eman da.";
            } else {
                echo "Errorea: " . $conn->error;
            }
        }
        echo "</br><a href='form.html'>Volver atras</a>";
    }

    // 2.2 Erabiltzailearen Baja
    else if ($opcionSeleccionada === "delete") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $check_user = "SELECT * FROM ERABILTZAILEAK WHERE USER='$username' AND PASSWORD='$password'";
        $result = $conn->query($check_user);

        if ($result->num_rows == 0) {
            echo "Errorea: Erabiltzailea ez da existitzen edo pasahitza ez da zuzena.";
        } else {
            $delete_user = "DELETE FROM ERABILTZAILEAK WHERE USER='$username'";
            if ($conn->query($delete_user) === TRUE) {
                echo "Erabiltzailea baja eman da.";
            } else {
                echo "Errorea: " . $conn->error;
            }
        }
        echo "</br><a href='form.html'>Volver atras</a>";
    }

    // 2.3 Pasahitzaren Aldaketa
    else if ($opcionSeleccionada === "changepassword") {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $newpassword = $_POST["newpassword"];

        $check_user = "SELECT * FROM ERABILTZAILEAK WHERE USER='$username' AND PASSWORD='$password'";
        $result = $conn->query($check_user);

        if ($result->num_rows == 0) {
            echo "Errorea: Erabiltzailea ez da existitzen edo pasahitza ez da zuzena.";
        } else {
            $update_password = "UPDATE ERABILTZAILEAK SET PASSWORD='$newpassword' WHERE USER='$username'";
            if ($conn->query($update_password) === TRUE) {
                echo "Pasahitza aldatuta.";
            } else {
                echo "Errorea: " . $conn->error;
            }
        }
        echo "</br><a href='form.html'>Volver atras</a>";
    }

    // 2.4 Erabiltzaileen Zerrenda
    else if ($opcionSeleccionada === "userlist") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $check_user = "SELECT * FROM ERABILTZAILEAK WHERE USER='$username' AND PASSWORD='$password'";
        $result = $conn->query($check_user);

        if ($result->num_rows == 0) {
            echo "Errorea: Erabiltzailea ez da existitzen edo pasahitza ez da zuzena.";
        } else {
            $get_users = "SELECT * FROM ERABILTZAILEAK";
            $users = $conn->query($get_users);

            if ($users->num_rows > 0) {
                echo "<h2>Erabiltzaileen Zerrenda:</h2>";
                echo "<ul>";
                while ($row = $users->fetch_assoc()) {
                    echo "<li>" . $row["USER"] . "</li>";
                }
                echo "</ul>";
            } else {
                echo "Erabiltzaileak ez daude zerrendan.";
            }
        }
        echo "</br><a href='form.html'>Volver atras</a>";
    }
}
$conn->close();
?>
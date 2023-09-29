<?php
$usuario = $_POST["usuario"];
$password = $_POST["password"];

// Verificar las credenciales
if ($usuario === "desarrollador" && $password === "1234") {
    echo "Estás en el sistema";
} else {
    echo "<p style='color: red;'>Usuario o contraseña incorrectos</p><br>";
    echo '<a href="login.html">Volver al inicio de sesión</a>';
}

?>
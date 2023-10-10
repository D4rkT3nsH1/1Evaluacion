<?php
$servidor = 'localhost:3306';
$usuario = 'root';
$password = '';
$dbname = 'reto2_prueba';
$conn = mysqli_connect($servidor, $usuario, $password);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Base de datos creada o ya existente.\n";
} else {
    echo "Error al crear la base de datos: " . $conn->error;
}

$conn->select_db($dbname);

$sql_create_table = "CREATE TABLE IF NOT EXISTS usuario (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    User VARCHAR(10),
    Password VARCHAR(20)
)";

if ($conn->query($sql_create_table) === TRUE) {
    echo "Tabla usuario creada o ya existente.\n";
} else {
    echo "Error al crear la tabla usuario: " . $conn->error;
}

$conn->close();
?>
<?php
$servername = "localhost";
$username = "usuario";
$password = "contraseña";
$database = "nombre_de_la_base_de_datos";

$conn = null;

function db_connect()
{
    // global para acceso a variables globales
    global $servername, $username, $password, $database, $conn;

    // intento de conexión
    try {
        $conn = new mysqli($servername, $username, $password, $database);
    } catch (Exception $e) {
        $conn = null;
    }
}


function db_query($query_string)
{
    // global para acceso a variables globales
    global $conn;

    // Si falla la conexion a la db o no hay elementos en la tabla, retorna false
    $data = false;

    db_connect(); // Intento de conexión a db

    // Comprobar que haya conexión a la base de datos
    if ($conn != null) {
        if (!($conn->connect_error)) {

            // Consulta a la base de datos para obtener datos 
            $result = $conn->query($query_string);

            if ($result->num_rows > 0) {
                // Obtener los datos como un array asociativo
                $data = $result->fetch_all(MYSQLI_ASSOC);
            }
            $result->close();
            $conn->close();
        }

    }

    return $data;
}

?>
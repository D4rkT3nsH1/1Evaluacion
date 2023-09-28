<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>
    <?php

    //MySQL
    $servidor = 'localhost:3306';
    $usuario = 'root';
    $password = '';
    $conexion = mysqli_connect($servidor, $usuario, $password);


    if (!$conexion) {
        echo 'Conexión fallida<br>';
    } else {

        //Seleccionar base de datos usuarios
        mysqli_select_db($conexion, "usuarios");
        $sql2 = "ALTER TABLE clientes ADD apellidos VARCHAR(20), ADD edad INT";

        if (mysqli_query($conexion, $sql2)) {
            echo "Column created successfully";
        } else {
            echo "Column is not created successfully ";
        }


    }

    ?>
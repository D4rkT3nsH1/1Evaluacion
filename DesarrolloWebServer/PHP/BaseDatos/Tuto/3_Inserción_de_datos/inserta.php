<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Documento sin título</title>
</head>

<body>
	<?php
	$minombre = $_POST["nombre"];
	$miapellidos = $_POST["apellidos"];
	$miedad = $_POST["edad"];

	//Creo las variables de conexión a MySQL
	$servidor = "localhost";
	$usuario = "root";
	$pass = "";

	//Establecer la conexión con MySQL
	$conexion = mysqli_connect($servidor, $usuario, $pass) or die("Error de conexión");

	//Seleccionamos la Base de Datos
	mysqli_select_db($conexion, "usuarios");

	//creamos la sentencia SQL de inserción
	$insertar = "INSERT clientes (nombre,apellidos,edad) VALUES ('$minombre','$miapellidos','$miedad')";

	//Ejecutar la sentencia SQL
	
	if (mysqli_query($conexion, $insertar)) {
		echo "El cliente con nombre " . $minombre . " se ha insertado correctamente.";

	} else {
		echo "Ha ocurrido un error.";
	}

	?>

</body>

</html>
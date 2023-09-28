<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Comprobar</title>
</head>

<body>
	<?php

	$encontrado = FALSE;

	//capturo el valor del campo de formulario
	//$minombre = $_POST["nombre"];
	//$miapellidos = $_POST["apellidos"];
	//$miedad = $_POST["edad"];

	//Creo las variables de conexión a MySQL
	$host = "localhost";
	$usuario = "root";
	$pass = "";

	//Establecer la conexión con MySQL
	$conexion = mysqli_connect($host, $usuario, $pass) or die("Error de conexión");

	//Seleccionamos la Base de Datos
	mysqli_select_db($conexion, "usuarios");

	//creamos la sentencia SQL de consulta
	$consultar = "SELECT * FROM clientes";

	// Ejecutar la consulta
	$result = $conexion->query($consultar);

	if ($result->num_rows > 0) {
		// Mostrar los resultados en una tabla HTML
		echo "<table>";
		echo "<tr><th>Nombre</th><th>Apellidos</th><th>Edad</th></tr>"; // Reemplaza con los nombres de tus columnas
		while ($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . $row["nombre"] . "</td>"; // Reemplaza "id" con el nombre de tu columna de ID
			echo "<td>" . $row["apellidos"] . "</td>"; // Reemplaza "columna1" con el nombre de tus columnas
			echo "<td>" . $row["edad"] . "</td>"; // Reemplaza "columna2" con el nombre de tus columnas
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "La tabla está vacía.";
	}

	?>

</body>

</html>
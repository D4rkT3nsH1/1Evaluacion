<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Subir archivo</title>
</head>

<body>
	<?php

	//Crear la carpeta uploads en el servidor
	
	//Restricciones
	$directorioSubida = "C:\\Users\\2AW3-14\\Downloads\\Prueba\\";
	$max_file_size = "123456789";
	$extensionesValidas = array("txt", "html", "pdf");

	if (isset($_POST["submit"]) && isset($_FILES['imagen'])) {

		$izena = $_POST["izena"];

		$errores = 0;
		$nombreArchivo = $_FILES['imagen']['name'];
		$filesize = $_FILES['imagen']['size'];
		$directorioTemp = $_FILES['imagen']['tmp_name'];
		$tipoArchivo = $_FILES['imagen']['type'];
		$arrayArchivo = pathinfo($nombreArchivo);
		$extension = $arrayArchivo['extension'];

		// Comprobamos la extensión del archivo
		if (!in_array($extension, $extensionesValidas)) {
			echo $izena . ", la extensión del archivo no es válida";
			$errores = 1;
		}
		// Comprobamos el tamaño del archivo
		if ($filesize > $max_file_size) {
			echo $izena . ", la imagen debe de tener un tamaño inferior a 120 Mb";
			$errores = 1;
		}

		// Movemos el archivo si no hay errores
		if ($errores == 0) {
			$nombreCompleto = $directorioSubida . $nombreArchivo;
			move_uploaded_file($directorioTemp, $nombreCompleto);
			echo ($izena . ", el archivo se ha subido correctamente");
		}
	}
	?>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>
  <h1>Datos personales del formulario recibido</h1>

  <style></style>

  <fieldset>
    <legend>Formulario recibido</legend>
    
    Nombre:
    <?php isset($_POST["name"]) ? print $_POST["name"] : ""; ?><br>
    Apellidos:
    <?php isset($_POST["apellidos"]) ? print $_POST["apellidos"] : ""; ?><br>
    Edad:
    <?php isset($_POST["edad"]) ? print $_POST["edad"] : ""; ?><br>
    Peso:
    <?php isset($_POST["peso"]) ? print $_POST["peso"] : ""; ?><br>
    Sexo:
    <?php isset($_POST["sexo"]) ? print $_POST["sexo"] : ""; ?><br>
    Estado civil:
    <?php isset($_POST["ec"]) ? print $_POST["ec"] : ""; ?><br>
    Aficiones:
    <?php isset($_POST["afi"]) ? print $_POST["afi"] : ""; ?><br>

  </fieldset>

</body>

</html>
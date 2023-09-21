<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
</head>

<body>
  <h1>Datos personales (Formulario)</h1>

  <style>
    .form {
      display: flex;
      justify-content: space-around;
      align-items: center;
    }

    #formLast {
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .form:not(:last-child) {
      margin-bottom: 25px;
    }
  </style>

  <form action="01AriketaPOST.php" method="post">
    <fieldset>
      <legend>Formulario</legend>
      <p>Escriba los datos siguientes:</p>

      <div class="form">
        <div>
          <label for="name">Nombre: </label><br />
          <input type="text" id="name" name="name" required />
        </div>

        <div>
          <label for="apellidos">Apellidos: </label><br />
          <input type="text" id="apellidos" name="apellidos" required />
        </div>

        <div>
          <label for="edad">Edad: </label><br />
          <select>
            <?php
            for ($i = 18; $i <= 100; $i++) {
              echo "<option value=", $i," > $i </option>";
            }
            ?>
          </select>
        </div>
      </div>

      <div class="form">
        <div>
          <label for="peso">Peso: </label><br />
          <input type="number" id="peso" name="peso" min="0" /> Kg
        </div>

        <div>
          <label for="sexo">Sexo: </label><br />
          <input type="radio" value="hombre" name="sexo" /> Hombre
          <input type="radio" value="mujer" name="sexo" /> Mujer
        </div>

        <div>
          <label for="estado_civil">Estado civil: </label><br />
          <input type="radio" value="soltero" name="estado_civil" /> Soltero
          <input type="radio" value="casado" name="estado_civil" /> Casado
          <input type="radio" value="otro" name="estado_civil" /> Otro
        </div>
      </div>

      <div id="formLast">
        <div>
          <label>aficiones: </label>
        </div>
        <div>
          <input type="checkbox" id="Cine" name="afi[]" value="Cine" />
          <label for="Cine">Cine</label>

          <input type="checkbox" id="Literatura" name="afi[]" value="Literatura" />
          <label for="Literatura">Literatura</label>

          <input type="checkbox" id="Tebeos" name="afi[]" value="Tebeos" />
          <label for="Tebeos">Tebeos</label><br />

          <input type="checkbox" id="Deporte" name="afi[]" value="Deporte" />
          <label for="Deporte">Deporte</label>

          <input type="checkbox" id="Musica" name="afi[]" value="Musica" />
          <label for="Musica">Musica</label>

          <input type="checkbox" id="Television" name="afi[]" value="Television" />
          <label for="Television">Television</label>
        </div>
      </div>

      <input type="submit" name="submit" value="Enviar" />
      <input type="reset" value="Borrar" />
    </fieldset>
  </form>
</body>

</html>
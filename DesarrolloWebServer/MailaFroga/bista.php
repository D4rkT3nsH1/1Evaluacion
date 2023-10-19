<?php
class Login_Bista
{

    //Logina egin aurretik agertuko dena, formulario osoa.
    //Formulario completo con la parte del login.
    public function HasierakoFormularioa()
    {
        ?>
        <form method="POST" action="aukerak_kontrolatzailea.php">
            <div>
                <div>
                    <label><b>Erabiltzailea/ Usuario</b></label>
                    <input type="text" placeholder="Sartu Erabiltzaile izena" name="erab" />
                </div>

                <div>
                    <label><b>Pasahitza/ Contraseña</b></label>
                    <input type="password" placeholder="Sartu pasahitza" name="ph" />
                </div>
                <br>
                <div>
                    <label><b>Zer da egin nahi duzuna?/ ¿Qué es lo que quieres hacer?</b></label>
                </div>
                <input type="radio" value="zerrenda" name="opcion" />Puntuazio Zerrenda/ Listado puntuaciones
                <input type="radio" value="jokatu" name="opcion" /> Jokatu/ Jugar
                <br><br>
                <input type="submit" value="AURRERA" name="botoia" />
            </div>
        </form>
        <?php
    }


    //Behin logina agiaztatuta dagoenean agertuko dena, login gabeko formularioa.
    //Una vez que el login esté verificado, el fomulario sin la parte de login.
    public function Aukera_Eman()
    {
        ?>
        <form method="POST" action="aukerak_kontrolatzailea.php">
            <div>
                <div>
                    <label><b>Zer da egin nahi duzuna?/ ¿Qué es lo que quieres hacer?</b></label>
                </div>

                <input type="radio" value="zerrenda" name="opcion" />Puntuazio Zerrenda/ Listado puntuaciones
                <input type="radio" value="jokatu" name="opcion" /> Jokatu/ Jugar
                <br>
                <br>
                <input type="submit" value="AURRERA" name="botoia" />
            </div>
        </form>
        <?php
    }

    //Array asoziatibo bat emanda, arraya erakutsiko du pantailan.
    //Mostrará en pantalla el array asociativo dado.
    public function zerrendatu($zerrenda_asoziatiboa)
    {

        ?>
        <table border="1">
            <tr>
                <th>Erabiltzailea</th>
                <th>Puntzuazioa</th>
            </tr>
            <?php
            foreach ($zerrenda_asoziatiboa as $erabiltzailea => $puntuazioa) {
                ?>
                <tr>
                    <td>
                        <?php echo ($erabiltzailea); ?>
                    </td>
                    <td>
                        <?php echo ($puntuazioa); ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php

    }


    /*Array asoziatibo bat sartuta (key-a galdera eta value erantzun posibleen arraya izanda),
      galdera erantzunak bistaratzen ditu pantailan./

      Dado un array asociativo (key es la pregunta y el value es una array con las posbles respuestas),
      muestra en pantalla la preguntas y respuestas.     */
    public function galderak_marraztu($galdera_erantzunen_arraya)
    {

        echo '<form method="POST" action="aukerak_kontrolatzailea.php">';
        // Galderaren etiketa sortu/ Crear la etiqueta de la pregunta
        $kont = 0;
        foreach ($galdera_erantzunen_arraya as $galdera => $erantzunak) {
            echo "<b>" . $galdera . " &nbsp</b>";

            // Erantzunen menua osatu/ Crear el menú desplegable
            echo '<select name="galderaJokoa' . $kont++ . '">';

            foreach ($erantzunak as $erantzuna) {
                echo "<option value='" . $erantzuna . "'>" . $erantzuna . "</option>";
            }
            echo '</select><br><br>';

        }

        echo '<input type="submit" value="BIDALI" name="jokatu_botoia"/>';
        echo '</form>';

    }
}


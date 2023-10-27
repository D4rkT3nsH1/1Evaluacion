<?php

class LogVista
{

    //Logina egin aurretik agertuko dena, formulario osoa.
    //Formulario completo con la parte del login.

    public function botonVoler()
    {
        ?>
        <form method="POST" action="Controlador.php">
            <input type="submit" value="Volver" name="volver">
        </form>
        <?php
    }

    public function HasierakoFormularioa()
    {
        ?>
        <form method="POST" action="Controlador.php">
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
                    <label><b>¿Qué es lo que quieres hacer?</b></label>
                </div>
                <input type="radio" value="zerrenda" name="opcion" /> Listado puntuaciones
                <input type="radio" value="jokatu" name="opcion" /> Jugar
                <br><br>
                <input type="submit" value="AURRERA" name="botoia" />
            </div>
        </form>
        <?php
    }


    public function Aukera_Eman()
    {
        ?>
        <form method="POST" action="Controlador.php">
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

    public function Aukera_Eman_Admin()
    {
        ?>
        <form method="POST" action="Controlador.php">
            <div>
                <div>
                    <label><b>¿Qué es lo que quieres hacer?</b></label>
                </div>

                <input type="radio" value="zerrenda" name="opcion" /> Administrar usuarios
                <input type="radio" value="preguntas" name="opcion" /> Administrar preguntas
                <input type="radio" value="addUser" name="opcion" /> Añadir usuario
                <input type="radio" value="addGaldera" name="opcion" /> Añadir pregunta(s)
                <input type="radio" value="jokatu" name="opcion" /> Jugar
                <br>
                <br>
                <input type="submit" value="AURRERA" name="botoia" />
            </div>
        </form>
        <?php
    }

    public function addUser()
    {
        ?>
        <form method="POST" action="Controlador.php">
            <div>
                <div>
                    <label><b>Añadir Usuarios</b></label>
                </div>
                <div>
                    <label for="user">Erabiltzailea</label>
                    <input type="text" name="user" />
                </div>
                <div>
                    <label for="pass">Pasahitza</label>
                    <input type="password" name="pass" />
                </div>
                <div>
                    <label for="isAdmin">Admin da?</label>
                    <select name="isAdmin" id="adminSelect">
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <br>
                <input type="submit" value="Añadir usuario" name="botoia_user" />
            </div>
        </form>
        <?php
    }

    public function UserData()
    {
        ?>
        <form method="POST" action="Controlador.php">
            <div>
                <div>
                    <label><b>¿De que usuario desearias ver los datos?</b></label>
                </div>
                <div>
                    <label for="userData">Erabiltzailea</label>
                    <input type="text" name="userData" />
                </div>
                <br>
                <input type="submit" value="Datos del usuario" name="user_data" />
            </div>
        </form>
        <?php
    }
    public function UserDataByGalderaId()
    {
        ?>
        <form method="POST" action="Controlador.php">
            <div>
                <div>
                    <label><b>¿De que pregunta desearias ver los datos?</b></label>
                </div>
                <div>
                    <label for="galderaID">GalderaId</label>
                    <input type="number" min="1" name="galderaID" />
                </div>
                <br>
                <input type="submit" value="Buscar" name="galdera_id_btn" />
            </div>
        </form>
        <?php
    }

    public function addGaldera()
    {
        ?>
        <form method="POST" action="Controlador.php">
            <div>
                <div>
                    <label><b>Añadir pregunta, las respuestas deben estar diseccionadas de esta manera: 1/2/3/4</b></label>
                </div>
                <div>
                    <label for="pregunta">Pregunta</label>
                    <input type="text" name="pregunta" />
                </div>
                <div>
                    <label for="respuestas">Respuestas</label>
                    <input type="text" name="respuestas" />
                </div>
                <div>
                    <label for="respuestaBuena">Respuesta buena</label>
                    <input type="text" name="respuestaBuena" />
                </div>
                <div>
                    <label for="puntuacion">Puntuacion</label>
                    <input type="number" min="1" max="50" name="puntuacion" />
                </div>
                <br>
                <br>
                <input type="submit" value="Añadir pregunta" name="botoia_galdera" />
            </div>
        </form>
        <?php
    }

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

    public function zerrendatuGalderaData($zerrenda_asoziatiboa)
    {

        ?>
        <h2>Preguntas relacionadas con la búsqueda</h2>
        <table border="1">
            <tr>
                <th>Erabiltzailea</th>
                <th>Partida eguna-ordua</th>
                <th>GalderaId</th>
                <th>Ondo/Txarto</th>
            </tr>
            <?php
            foreach ($zerrenda_asoziatiboa as $data) {
                ?>
                <tr>
                    <td>
                        <?php echo ($data[0]); ?>
                    </td>
                    <td>
                        <?php echo ($data[1]); ?>
                    </td>
                    <td>
                        <?php echo ($data[2]); ?>
                    </td>
                    <td>
                        <?php if ($data[3] == 1) {
                            echo "Ondo";
                        } else {
                            echo "Txarto";
                        } ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php

    }

    public function zerrendatuGalderak($zerrenda_asoziatiboa)
    {

        ?>
        <table border="1">
            <tr>
                <th>Id Galdera</th>
                <th>Galdera</th>
            </tr>
            <?php
            foreach ($zerrenda_asoziatiboa as $galdera => $data) {
                ?>
                <tr>
                    <td>
                        <?php echo ($galdera); ?>
                    </td>
                    <td>
                        <?php echo ($data); ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php

    }


    public function galdera_erantzunak_marraztu($galdera_erantzunen_arraya)
    {
        echo '<form method="POST" action="Controlador.php">';
        $kont = 0;
        foreach ($galdera_erantzunen_arraya as $galdera => $erantzunak) {
            echo "<b>" . $galdera . " &nbsp</b>";

            echo '<select name="galdera' . $kont++ . '">';

            foreach ($erantzunak as $erantzuna) {
                echo "<option value='" . $erantzuna . "'>" . $erantzuna . "</option>";
            }
            echo '</select><br><br>';

        }

        echo '<input type="submit" value="BIDALI" name="jokatu_botoia"/>';
        echo '</form>';

    }
}
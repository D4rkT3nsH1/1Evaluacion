<?php


/**
 * Bistaren deskribapena
 
 */
class Login_Bista {
    
    public function atzeraBotoia() {
        ?>
            <form method="POST" action="aukerak_kontrolatzailea.php">
            	<input type="submit" value="ATZERA" name="atzera"/>
            </form>
        <?php
    }
    //Logina egin aurretik agertuko dena, formulario osoa.
    //Formulario completo con la parte del login.
    public function HasierakoFormularioa() {
        ?>
        <form method="POST" action="aukerak_kontrolatzailea.php">
            <div >
                <div >
                    <label><b>Erabiltzailea/ Usuario</b></label>
                    <input type="text" placeholder="Sartu Erabiltzaile izena" name="erab"/>
                </div>

                <div>
                    <label><b>Pasahitza/ Contraseña</b></label>
                    <input type="password" placeholder="Sartu pasahitza" name="ph"/>
                </div>
                <br>
                <div>
                    <label><b>Zer da egin nahi duzuna?/ ¿Qué es lo que quieres hacer?</b></label> 
                </div>          
                <input type="radio" value="zerrenda" name="opcion"/>Puntuazio Zerrenda / Listado puntuaciones
                <br><input type="radio" value="jokatu" name="opcion"/> Jokatu / Jugar
                <br><input type="radio" value="alta" name="opcion"/>Sortu erabiltzailea / Crear usuario
                <br><input type="radio" value="galdera" name="opcion"/>Galdera berria sortu / Crear nueva pregunta
                <br><input type="radio" value="partidak" name="opcion"/>Partiden historiala ikusi / Ver el historial de partidas
                <br><br>
                <input type="submit" value="AURRERA" name="botoia"/>
            </div>
        </form>
        <?php
    }


    //Behin logina agiaztatuta dagoenean agertuko dena, login gabeko formularioa.
    //Una vez que el login esté verificado, el fomulario sin la parte de login.
    public function Aukera_Eman() {
        ?>
        <form method="POST" action="aukerak_kontrolatzailea.php">
            <div>
                <div>
                    <label><b>Zer da egin nahi duzuna?/ ¿Qué es lo que quieres hacer?</b></label> 
                </div>
                                          
                <input type="radio" value="zerrenda" name="opcion"/>Puntuazio Zerrenda/ Listado puntuaciones
                <br><input type="radio" value="jokatu" name="opcion"/> Jokatu/ Jugar
                <br><input type="radio" value="galdera" name="opcion"/>Galdera berria sortu / Crear nueva pregunta
                <br><input type="radio" value="partidak" name="opcion"/>Partiden historiala ikusi / Ver el historial de partidas
                <br>
                <br>
                <input type="submit" value="AURRERA" name="botoia"/>
            </div>
        </form>
        <?php
    }
    
    public function Galdera_Motak() {
        ?>
        <form method="POST" action="aukerak_kontrolatzailea.php">
            <div>
                <div>
                    <label><b>Galdera zailak ala errazak nahi dituzu?/ ¿Quieres preguntas faciles o dificiles?</b></label> 
                </div>
                                          
                <input type="radio" value="zailak" name="galderaMota"/>Zailak/ Dificiles
                <input type="radio" value="errazak" name="galderaMota"/> Errazak/ Faciles
                <br>
                <br>
                <input type="submit" value="AURRERA" name="botoia2"/>
            </div>
        </form>
        <?php
    }

    //Array asoziatibo bat emanda, arraya erakutsiko du pantailan.
    //Mostrará en pantalla el array asociativo dado.
    public function zerrendatu($zerrenda_asoziatiboa) {

        ?>
        <table border="1">
            <tr><th>Erabiltzailea</th><th>Puntzuazioa</th></tr>
            <?php
            foreach ($zerrenda_asoziatiboa as $erabiltzailea => $puntuazioa) {
            ?>
                <tr><td><?php echo($erabiltzailea); ?></td><td><?php echo($puntuazioa); ?></td></tr>
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
    public function galdera_erantzunak_marraztu ($galdera_erantzunen_arraya){
                
        echo '<form method="POST" action="aukerak_kontrolatzailea.php">';
         // Galderaren etiketa sortu/ Crear la etiqueta de la pregunta
         $kont=0;
         foreach($galdera_erantzunen_arraya as $galdera => $erantzunak){
            echo "<b>".$galdera." &nbsp</b>";

            // Erantzunen menua osatu/ Crear el menú desplegable
            echo '<select name="galdera'.$kont++. '">';
            
            foreach($erantzunak as $erantzuna ){
                echo "<option value='".$erantzuna."'>".$erantzuna."</option>";
            }
            echo '</select><br><br>';    
            
        }
        
        echo '<input type="submit" value="BIDALI" name="jokatu_botoia"/>';
        echo '</form>';
       
    }

    public function GalderaBerriarenFormularioa() {
        ?>
        <form method="POST" action="aukerak_kontrolatzailea.php">
            <div >
                <div >
                    <label><b>Galdera:</b></label><br>
                    <input type="text" placeholder="Sartu galdera" name="galdera"/>
                </div>

                <div>
                    <label><b>Erantzun posibleak formatu honetan "erantzuna1/erantzuna2/erantzuna3":</b></label><br>
                    <input type="text" placeholder="Sartu erantzunak" name="erantzunak"/>
                </div>
                
                <div >
                    <label><b>Erantzun zuzena (goiko erantzunaren berdin egon behar da idatzita):</b></label><br>
                    <input type="text" placeholder="Sartu erantzuna" name="erantzunZuzena"/>
                </div>

                <div>
                    <label><b>Galderaren puntuazioa:</b></label><br>
                    <input type="text" placeholder="Sartu puntuazioa" name="puntuazioa"/>
                </div>
                
                <br>
                <div>
                    <label><b>Galdera zaila ala erraza izango da?</b></label> 
                </div>  
                        
                <input type="radio" value="1" name="zailtasuna"/>Zaila
                <input type="radio" value="0" name="zailtasuna"/>Erraza
                <br><br>
                
                <input type="submit" value="AURRERA" name="botoiaGaldera"/>
            </div>
        </form>
        <?php
    }
    
    public function Jarraipena() {
        ?>
        <form method="POST" action="aukerak_kontrolatzailea.php">
            <div >
                <div >
                    <label><b>Bilatu nahi duzun pertsonaren erabiltzailea sartu:</b></label>
                    <input type="text" placeholder="Sartu Erabiltzaile izena" name="erabiltzailea"/>
                    <input type="submit" value="BILATU" name="erabiltzaileBilaketa"/>
                </div>
				<br>
                <div>
                    <label><b>Bilatu nahi duzun galderaren ID-a sartu:</b></label>
                    <input type="text" placeholder="Sartu galderaren id-a" name="galderaid"/>
                    <input type="submit" value="BILATU" name="galderaBilaketa"/>
                </div>
                <br>
                
                
            </div>
        </form>
        <?php
    }
    
    public function galderaErantzunak($zuzenak, $okerrak) {
        
        ?>
        <table border="1">
        	<tr>
        		<th colspan=2>GALDERAREN ERANTZUNAK</th>
        	</tr>
            <tr align=center>
                <th>Zuzenak</th>
                <th>Okerrak</th>
            </tr>
            <tr align=center>
                <td><?php echo($zuzenak); ?></td>
                <td><?php echo($okerrak); ?></td>
            </tr>
        </table>
        <?php
    
    }
    
    
    public function JarraipenaErabiltzailea() {
        ?>
        <form method="POST" action="aukerak_kontrolatzailea.php">
            <div >
                <div >
                    <label><b>Bilatu nahi duzun eguna sartu (Horrela idatzi: "urtea-hilea-eguna"):</b></label>
                    <input type="text" placeholder="Sartu eguna" name="eguna"/>
                    <input type="submit" value="BILATU" name="egunBilaketa"/>
                </div>
				<br>
                <div>
                    <label><b>Bilatu nahi duzun galderaren ID-a sartu:</b></label>
                    <input type="text" placeholder="Sartu galderaren id-a" name="galderaIdErab"/>
                    <input type="submit" value="BILATU" name="galderaBilaketaErab"/>
                </div>
                <br>
                
                
            </div>
        </form>
        <?php
    }
    
    public function zerrendatuPartidaGalderarekiko($zerrenda_asoziatiboa) {
        
        ?>
        <h3><?php echo $_SESSION["erabBilatu"] ?> erabiltzailearen datuak:</h3>
        <table border="1">
            <tr>
                <th>GALDERA ID-a</th>
                <th>ERABILTZAILEA</th>
                <th>ERANTZUNA</th>
                <th>DATA</th>
            </tr>
            
            <?php
            foreach ($zerrenda_asoziatiboa as $galdera => $lerroa) {
            ?>
                <tr>
                    <td><?php echo($galdera); ?></td>
                    <td><?php echo($lerroa[0]); ?></td>
                    <td><?php if ($lerroa[1]==1) { echo "Zuzena"; } else { echo "Okerra"; }?></td>
                    <td><?php echo($lerroa[2]); ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    
    }
    
    public function zerrendatuPartidaEgunarekiko($zerrenda_asoziatiboa) {
        
        ?>
        <h3><?php echo $_SESSION["erabBilatu"] ?> erabiltzailearen datuak:</h3>
        <table border="1">
            <tr>
                <th>DATA</th>
                <th>ERABILTZAILEA</th>
                <th>GALDERA ID-a</th>
                <th>ERANTZUNA</th>
            </tr>
            
            <?php
            foreach ($zerrenda_asoziatiboa as $data => $lerroa) {
            ?>
                <tr>
                    <td><?php echo($data); ?></td>
                    <td><?php echo($lerroa[0]); ?></td>
                    <td><?php echo($lerroa[1]); ?></td>
                    <td><?php if ($lerroa[2]==1) { echo "Zuzena"; } else { echo "Okerra"; }?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    
    }
}


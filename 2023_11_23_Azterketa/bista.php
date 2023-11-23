<?php

/**
 * Bistaren deskribapena 
 * Descripcion de la vista
 
 */

class Login_Bista {

    //Logina egin aurretik agertuko dena, formulario osoa.
    //Formulario completo con la parte del login.
    public function Login() {
        ?>
        <form method="POST" action="login_controlador.php">
            <div >
                <div >
                    <label><b>Erabiltzailea/ Usuario</b></label>
                    <input type="text" placeholder="Sartu Erabiltzaile izena" name="erab_usuario"/>
                </div>

                <div>
                    <label><b>Pasahitza/ Contraseña</b></label>
                    <input type="password" placeholder="Sartu pasahitza" name="ph"/>
                </div>     
                <br>
                <input type="submit" value="Sartu/Entrar" name="b_sartu_entrar"/>
                <input type="submit" value="Aldatu pasahitza/Cambiar contraseña" name="b_aldatu_cambiar"/>
                <input type="submit" value="Alta eman/ Darse de alta" name="b_berria_nuevo"/>            
            </div>
        </form>
        <?php
    }

    public function ikusiPasahitzaAldatzeko_verCambioContras() {
        ?>
        <form method="POST" action="login_controlador.php">
            <div >
                <div >
                    <label><b> Sartu Pasahitz berria/ Introduce la nueva contraseña</b></label>
                    <input type="text" name="ph"/>
                </div>
                
                <input type="submit" value="Aldatu/ Cambiar" name="onartuAldaketa_aceptarCambio"/> 
            </div>
        </form>
        <?php
    }



    //Behin logina agiaztatuta dagoenean agertuko dena, login gabeko formularioa.
    //Una vez que el login esté verificado, el fomulario sin la parte de login.
    public function Alta_AukeraEman_Opcion() {
        ?>
         <form method="POST" action="login_controlador.php">
            <div >
                <div >
                    <label><b> Izena/ Nombre</b></label>
                    <input type="text" placeholder="Sartu Erabiltzailearen izena" name="izena_nombre"/>
                </div>

                <div>
                    <label><b>Jaiotze Data/ Fecha de nacimiento</b></label>
                    <input type="date"  name="data_fecha"/>
                </div>
                <br>
                <div >
                    <label><b>Erabiltzailea berria/ Nuevo Usuario</b></label>
                    <input type="text" placeholder="Sartu Erabiltzailea" name="erab_usuario"/>
                </div>

                <div>
                    <label><b>Pasahitza/ Contraseña</b></label>
                    <input type="password" placeholder="Sartu pasahitza" name="ph"/>
                </div>
                <br>
                
                <input type="submit" value="Ok" name="ok_alta"/> 
            </div>
        </form>
        <?php
    }

    public function AukeraEmanErab_DarOpcionesUsuario(){
        
        ?>
        <form method="POST" action="aukerak_controlador.php">
            <div>
                <div>
                    <label><b>Zer da egin nahi duzuna?/ ¿Qué es lo que quieres hacer?</b></label> 
                </div>
                                          
                <input type="radio" value="idatzi_escribir" name="opcion"/>Gutuna idatzi / Escribir carta
                <input type="radio" value="aldatu_cambiar" name="opcion"/> Gutuna aldatu / Cambiar carta 
                <br>
                <br>
                <input type="submit" value="Ok" name="b_gutuna_carta"/>
            </div>
        </form>
        <?php
    }

    public function AukeraEmanOlen_DarOpcionesOlen($ebailtzaileak_usuarios){
        
        ?>
        <form method="POST" action="aukerak_controlador.php">
            <div>
                <div>
                    <label><b>Ze erabiltzaileren ekintzak sartu nahi dituzu?/ ¿A qué usuario quieres le quieres asignar acciones? </b></label> 
                </div>
                <?php
                 echo '<select name="erab_usuario">';
                 foreach ($ebailtzaileak_usuarios as $user) {
                         
                         echo '<option value="' . $user . '">' . $user . '</option>';
                      }     ?>                          
                <br>
                <br>
                <input type="submit" value="Ok" name="b_erabAukeratu_elegirUsuario"/>
            </div>
        </form>
        <?php
    }


    public function EkintzakBistaratu_VisualizarAcciones ($ekintzak_acciones){

        ?>
        <form method="POST" action="aukerak_controlador.php">
        <label><b> <?php $_SESSION['Erab_usuario'] ?> Erabiltzailearen ekintzak eguneratu:</b></label>
        <br><br>

        
            <?php
            foreach ($ekintzak_acciones as $ekintza_accion => $puntuazioa_puntuacion) {
                echo($ekintza_accion. " " . $puntuazioa_puntuacion. " puntu/puntos");
            ?>
                <input type="checkbox" name="ekintzak[]" value="<?php echo($ekintza_accion); ?>">
                    
            <?php 
            } ?>
            <br>
            <input type="submit" value="Ok" name="b_ekintzak_acciones"/>
        </form>

        <?php
    
    }
    

    //Array asoziatibo bat emanda, arraya erakutsiko du pantailan.
    //Mostrará en pantalla el array asociativo dado.
    public function erakutsiOpariak_mostrarRegalos($zerrenda_asoziatiboa) {

        ?>
        <form method="POST" action="aukerak_controlador.php">
        <label><b>Olentzero eta Mari Domingi maiteak ondorengoa gustatuko litzaidake:/ Queridos Olentzero y Mari Domingi me gustaría que me traerais lo siguiente:</b></label>
        <br><br>

        
            <?php
            foreach ($zerrenda_asoziatiboa as $oparia_regalo => $puntuazioa_puntuacion) {
                echo($oparia_regalo. " " . $puntuazioa_puntuacion. " puntu/puntos");
            ?>
                <input type="checkbox" name="opariak[]" value="<?php echo($oparia_regalo); ?>">
                    
            <?php 
            } ?>
            <br>
            <input type="submit" value="Ok" name="b_eskariak_peticiones"/>
        </form>

        <?php
    
    }


    /*Array asoziatibo bat sartuta (key-a galdera eta value erantzun posibleen arraya izanda),
      galdera erantzunak bistaratzen ditu pantailan./

      Dado un array asociativo (key es la pregunta y el value es una array con las posbles respuestas),
      muestra en pantalla la preguntas y respuestas.     */
    public function galdera_erantzunak_marraztu ($galdera_erantzunen_arraya){
                
        echo '<form method="POST" action="aukerak_controlador.php">';
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

    /*Aukera ematen du jokoaren zailtasun maila zehazteko./

    Dá opción a elegir el grado de dificultad del juego.
    */
    public function zailtasuna_aukeratu(){
        ?>
        <form method="POST" action="aukerak_controlador.php">
            <div>
                <div>
                    <label><b>Ze motatako galderak nahi dituzu?/ ¿Qué tipo de preguntas quieres?</b></label> 
                </div>
                                          
                <input type="radio" value="zailak" name="opcion"/>Zailak/ Dificiles
                <input type="radio" value="errazak" name="opcion"/> Errazak/ Fáciles
                <br>
                <br>
                <input type="submit" value="AURRERA" name="botoia_zailtasuna"/>
            </div>
        </form>
        <?php
    }


/*Aukere formulariorai botoi bat gehitzen zaio./

Se muestra un botón para cuando el admin quiera introducir una nueva pregunta.
*/

    public function erakutsi_admin_aukera(){
        ?>
        <form method="POST" action="aukerak_controlador.php">
            <div>
                <div>
                    <label><b>Zer da egin nahi duzuna?/ ¿Qué es lo que quieres hacer?</b></label> 
                </div>
                                          
                <input type="radio" value="zerrenda" name="opcion"/>Puntuazio Zerrenda/ Listado puntuaciones
                <input type="radio" value="jokatu" name="opcion"/> Jokatu/ Jugar
                <br>
                <br>
                <input type="submit" value="GALDERA BERRI BAT TXERTATU" name="galdera_gehitu"/>
                <input type="submit" value="AURRERA" name="botoia"/>
            </div>
        </form>
        <?php
    }


/*Galdera berri bat osatzeko beharrezko eremuak pantailaratzen ditu./

Dá la opción a que el usuario introducca los datos para generar una 
nueva pregunta.
*/

public function Galdera_Berria_Osatu() {
    ?>
    <form method="POST" action="aukerak_controlador.php">
        <div >
            <div >
                <label><b>Galdera/ Pregunta</b></label>
                <input type="text"  name="galdera"/>
            </div>

            <div>
                <label><b>Erantzun posibleak "/" ikurrarekin banatuta / Las posibles respuestas divididas por el simbolo "/"</b></label>
                <input type="text" name="eran_pos"/>
            </div>
            <div >
                <label><b>Erantzun zuzena/ La respuesta correcta </b></label>
                <input type="text"  name="eran_ona"/>
            </div>

            <div>
                <label><b>Pintuazioa/ Puntuación</b></label>
                <input type="text" name="puntuazioa"/>
            </div>
            <br>
            <input type="submit" value="AURRERA" name="galdera_ados"/>
               
        </div>
    </form>
    <?php
}
}

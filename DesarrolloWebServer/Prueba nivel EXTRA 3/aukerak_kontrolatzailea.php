<?php
session_start();

include_once 'bista.php';
include_once 'modeloa.php';

$LogBis = new Login_Bista();

$jok_model = new Jokalari_Modeloa();
$jok_model->konektatu();

// Logina egiaztatzen du, egokia ez bada mezua erakutsi eta formularioa berriro kargatuta.
// Comprueba el login, si no es adecuado muestra un mensaje y el formulario.
if ($_SESSION["balioztatua"]) {
    $LogBis->atzeraBotoia();
}


if (isset($_POST['atzera'])) {
    $LogBis->Aukera_Eman();
}

if (isset($_POST['botoia']) && !$_SESSION["balioztatua"]) {
    if ($jok_model->balioztatzea($_POST['erab'], $_POST['ph'])) {
        $_SESSION["balioztatua"] = TRUE;
        $_SESSION["Erab"] = $_POST['erab'];
        if (isset($_POST['opcion'])) {
            if ($_POST['opcion'] == "alta") {
                ?>
                    <h3 style="color: red;">Kontua jadanik duzu sortuta.</h3>
                <?php
            }
        }
    } else if (isset($_POST['opcion'])) {
        if ($_POST['opcion'] == "alta") {
            // izena existitzen den edo ez konporbatzen dugu, userra ezin delako errepikatu
            if ($jok_model->balioztatzeaErabiltzaileIzena($_POST['erab'])) {
                ?>
                	<h3 style="color: red;">User hori existitzen da.</h3>
                <?php
                $LogBis->HasierakoFormularioa();
            } else {
                // pasahitza hutsik ez dagoela konprobatzen dugu
                if (empty($_POST['ph'])) {
                    ?>
                    	<h3 style="color: red;">Ez duzu pasahitzarik jarri.</h3>
                    <?php
                    $LogBis->HasierakoFormularioa();
                } else {
                    // datuak zuzenak direla konprobatu ostean datu basera sartzen dugu funtzioaren bidez
                    $jok_model->erabiltzaile_berria($_POST['erab'], $_POST['ph']);
                    // sesioa balioztatzen dugu eta aukerak bistaratzen ditugu
                    $_SESSION["balioztatua"] = TRUE;
                    $_SESSION["Erab"] = $_POST['erab'];
                    ?>
                    	<h3 style="color: black;">Kontu behar bezala sortu da.</h3>
                    <?php
                }
            }
        } else {
            ?>
        	<h3 style="color: red;">Saiatu berriro, erabiltzailea edo pasahitza ez
        	dituzu ondo sartu. Edo altan eman nahi bazara, azpiko radio button-a
        	sakatu behar duzu.</h3>
        <?php
        $LogBis->HasierakoFormularioa();
        }
    } else {
        ?>
        	<h3 style="color: red;">Saiatu berriro, erabiltzailea edo pasahitza ez
        	dituzu ondo sartu. Edo altan eman nahi bazara, azpiko radio button-a
        	sakatu behar duzu.</h3>
        <?php
        $LogBis->HasierakoFormularioa();
    }
}

/*
 * Logina egiaztatuta dagola eta fomularioko botoia emanda, aukeraren arabera puntuazioak erakutsi
 * edo jokoari hasiera emango zaio. Aukerarik ez bada egin errore mezua agertuko da eta aukeren
 * formularioa erakutsiko da. /
 *
 * Una vez el login esté hecho y se pulse el boton del formulario según la opción escogida muestra
 * la puntuación o muestra el juego. Si no se ha elegido ninguna opción muestra una un error y el
 * fomulario para poder elegir la opción.
 */

if ($_SESSION["balioztatua"] && isset($_POST['botoia'])) {
    if (isset($_POST['opcion'])) {
        switch ($_POST['opcion']) {

            case "zerrenda":
                $LogBis->Aukera_Eman();
                $LogBis->zerrendatu($jok_model->zerrenda_ordenatuta());
                break;

            case "jokatu":
                $LogBis->Galdera_Motak();
                break;
                
            case "alta":
                $LogBis->Aukera_Eman();
                break;
                
            case "galdera":
                if ($jok_model->adminBalioztatzea($_SESSION["Erab"])) {
                    $LogBis->GalderaBerriarenFormularioa();
                } else {
                    ?>
                    	<h3 style="color: red;">Ez zara administraria. Aukera ezazu beste zerbait.</h3>
                    <?php
                    $LogBis->Aukera_Eman();
                }
                break;
                
            case "partidak":
                if ($jok_model->adminBalioztatzea($_SESSION["Erab"])) {
                    $LogBis->Jarraipena();
                } else {
                    ?>
                    	<h3 style="color: red;">Ez zara administraria. Aukera ezazu beste zerbait.</h3>
                    <?php
                    $LogBis->Aukera_Eman();
                }
                break;
        }
    } else {
        ?>
            <h3 style="color: red;">Ez duzu zehaztu zer den egin nahi duzuna/ No has
            	elegido qué quieres hacer.</h3>
        <?php
        $LogBis->Aukera_Eman();
    }
}

if ($_SESSION["balioztatua"] && isset($_POST['botoiaGaldera'])) {
    
    $datuZuzenak = TRUE;
    $puntuazioZuzena = TRUE;
    
    //puntuazioa zenbakiak direla konprobatzeko
    $permitidos = "0123456789";
    for ($i=0; $i<strlen($_POST['puntuazioa']); $i++){
        if (strpos($permitidos, substr($_POST['puntuazioa'],$i,1))===false){
            $puntuazioZuzena = FALSE;
        }
    }
    
    if ($_POST['galdera'] == NULL || $_POST['erantzunak'] == NULL || $_POST['erantzunZuzena'] == NULL || $_POST['puntuazioa'] == NULL) {
        $datuZuzenak = FALSE;
    }
    
    if ($datuZuzenak && $puntuazioZuzena) {
        if (isset($_POST['zailtasuna'])){
            $jok_model->galdera_berria($_POST['galdera'], $_POST['erantzunak'], $_POST['erantzunZuzena'], $_POST['puntuazioa'], $_POST['zailtasuna']);
        } else {
            ?>
            <h3 style="color: red;">Ez duzu zailtasuna aukeratu.</h3>
            <?php
            $LogBis->GalderaBerriarenFormularioa();
        }
        
    } else {
        if (!$puntuazioZuzena) {
            ?>
                <h3 style="color: red;">Puntuazioan zenbakiak bakarrik sartu ahal dira.</h3>
            <?php
        }
        if (!$datuZuzenak) {
            ?>
                <h3 style="color: red;">Ez dituzu datu guztiak bete.</h3>
            <?php
        }
        $LogBis->GalderaBerriarenFormularioa();
    }
    
}

//HEMEN GALDERA MOTAK ZEHAZTEN DIRA
if ($_SESSION["balioztatua"] && isset($_POST['botoia2'])) {
    if (isset($_POST['galderaMota'])) {
        switch ($_POST['galderaMota']) {

            case "zailak":
                $LogBis->galdera_erantzunak_marraztu($jok_model->galderaZailakIdatzi());
                $_SESSION["galderaZailak"] = TRUE;
                break;

            case "errazak":
                $LogBis->galdera_erantzunak_marraztu($jok_model->galderaErrazakIdatzi());
                $_SESSION["galderaErrazak"] = TRUE;
                break;
        }
    } else {
        ?>
        	<h3 style="color: red;">Ez duzu zehaztu galdera mota/ No has
                	elegido qué tipo de preguntas quieres.</h3>
        <?php
        $LogBis->Galdera_Motak();
    }
}


/*
 * Logina zuzenda izanda eta jokatzeko botoiari emanda, jokoko erantzunak egiaztatu eta
 * puntuazioa kalkulatzen da ostean DBan eguneraketa egiteko./
 *
 * Si el login es correcto y se ha elegido la opción de jugar se analizan la respuestas, se asigna
 * la puntuación y se actualiza dicha puntuación el la DB.
 */
if ($_SESSION["balioztatua"] && isset($_POST['jokatu_botoia'])) {
    $puntuak = 0;
    $kont = 0;
    
    if ($_SESSION["galderaZailak"]) {
        foreach ($jok_model->erantzunZailZuzenak() as $galdera => $erantzuna) {
            
            $galderaID = $jok_model->galderarenIdAtera($erantzuna[0]);
            
            //erantzuna zuzena den ala ez
            if ($_POST['galdera' . $kont ++] == $erantzuna[0]) {
                echo ($galdera . " galderaren erantzuna " . $erantzuna[0] . " da. Beraz zuzena da, oso ondo " . $erantzuna[1] . " lortu dituzu. <br><br>");
                $puntuak = $puntuak + $erantzuna[1];
                
                $jok_model->partidaDatuak($_SESSION["Erab"],$galderaID ,1);
            } else {
                $jok_model->partidaDatuak($_SESSION["Erab"],$galderaID ,0);
            }
        }
    } 
    
    $kont = 0;
    if ($_SESSION["galderaErrazak"]){
        foreach ($jok_model->erantzunErrazZuzenak() as $galdera => $erantzuna) {
            
            $galderaID = $jok_model->galderarenIdAtera($erantzuna[0]);
            
            //erantzuna zuzena den ala ez
            if ($_POST['galdera' . $kont ++] == $erantzuna[0]) {
                echo ($galdera . " galderaren erantzuna " . $erantzuna[0] . " da. Beraz zuzena da, oso ondo " . $erantzuna[1] . " lortu dituzu. <br><br>");
                $puntuak = $puntuak + $erantzuna[1];
                
                $jok_model->partidaDatuak($_SESSION["Erab"],$galderaID ,1);
            } else {
                $jok_model->partidaDatuak($_SESSION["Erab"],$galderaID ,0);
            }
        }
    }
    
    
    $_SESSION["galderaZailak"] = FALSE;
    $_SESSION["galderaErrazak"] = FALSE;
        
    echo $puntuak . " puntu lortu dituzu. <br><br>";
    $jok_model->eguneratu_puntuazioa($_SESSION["Erab"], $puntuak);
    $LogBis->Aukera_Eman();
}

if ($_SESSION["balioztatua"] && isset($_POST['galderaBilaketa'])) {
    if ($_POST['galderaid'] != null) {
        if ($jok_model->galderaBalioztatzea($_POST['galderaid'])) {
            $erantzunZuzenak = $jok_model->zenbatZuzen($_POST['galderaid']);
            $erantzunOkerrak = $jok_model->zenbatGaizki($_POST['galderaid']);
            
            ?>
            	<h3 style="color: black;"><?php echo $_POST['galderaid'];?> ID-a duen galdera: <?php echo $jok_model->galderaIdatzi($_POST['galderaid']);?></h3>
            <?php
            $LogBis->galderaErantzunak($erantzunZuzenak, $erantzunOkerrak);
        } else {
            ?>
            	<h3 style="color: red;">Ez da galdera id hori existitzen.</h3>
            <?php
            $LogBis->Jarraipena();
        }
    } else {
        ?>
        	<h3 style="color: red;">Ez duzu id-rik sartu.</h3>
        <?php
        $LogBis->Jarraipena();
    }
    
}
    
if ($_SESSION["balioztatua"] && isset($_POST['erabiltzaileBilaketa'])) {
    if ($_POST['erabiltzailea'] != null) {
        if($jok_model->balioztatzeaErabiltzaileIzena($_POST['erabiltzailea'])) {
            $_SESSION["erabBilatu"] = $_POST['erabiltzailea'];
            $LogBis->JarraipenaErabiltzailea();
        } else {
            ?>
            	<h3 style="color: red;">Ez da erabiltzaile hori existitzen.</h3>
            <?php
            $LogBis->Jarraipena();
        }
    } else {
        ?>
        	<h3 style="color: red;">Ez duzu erabiltzailerik sartu.</h3>
        <?php
        $LogBis->Jarraipena();
    }
}

if ($_SESSION["balioztatua"] && isset($_POST['galderaBilaketaErab'])) {
    if ($_POST['galderaIdErab'] != null) {
        if ($jok_model->galderaBalioztatzea($_POST['galderaIdErab'])) {
            if ($jok_model->galderaPartidaBalioztatzea($_POST['galderaIdErab'], $_SESSION["erabBilatu"])) {
                $partidaGaldera = $jok_model->partidaZerrendatuGalderarekiko($_POST['galderaIdErab'], $_SESSION["erabBilatu"]);
                $LogBis->zerrendatuPartidaGalderarekiko($partidaGaldera);
                
            } else {
                ?>
                	<h3 style="color: red;">Erabiltzaileak ez du galdera hori erantzun.</h3>
                <?php
                $LogBis->JarraipenaErabiltzailea();
            }
        } else {
            ?>
            	<h3 style="color: red;">Ez da galdera id hori existitzen.</h3>
            <?php
            $LogBis->JarraipenaErabiltzailea();
        }
    } else {
        ?>
        	<h3 style="color: red;">Ez duzu ID-rik sartu.</h3>
        <?php
        $LogBis->JarraipenaErabiltzailea();
    }
}

if ($_SESSION["balioztatua"] && isset($_POST['egunBilaketa'])) {
    if ($_POST['eguna'] != null) {
        ?>
        	<h3 style="color: black;"><?php echo $_POST['eguna']; ?> egunean erantzun zituen galderak:</h3>
        <?php
        if ($jok_model->egunaPartidaBalioztatzea($_POST['eguna'], $_SESSION["erabBilatu"])) {
            $partidaEguna = $jok_model->partidaZerrendatuEgunarekiko($_POST['eguna'], $_SESSION["erabBilatu"]);
            foreach ($partidaEguna as $lerroa => $e) {
                echo $lerroa . ", " . $e[0] . ", " . $e[1] . ", " . $e[2];
            }
            $LogBis->zerrendatuPartidaEgunarekiko($partidaEguna);
            
        } else {
            ?>
            	<h3 style="color: red;">Ez du galderarik erantzun egun horretan.</h3>
            <?php
            $LogBis->JarraipenaErabiltzailea();
        }
    } else {
        ?>
        	<h3 style="color: red;">Ez duzu egunik sartu.</h3>
        <?php
        $LogBis->JarraipenaErabiltzailea();
    }
}
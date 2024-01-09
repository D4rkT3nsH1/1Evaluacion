
<?php

require_once '../model/modelo_produktuak.php';
$produktu_id = $_GET['value'];
echo $produktu_id;
$cont = new modelo_produktuak();
$cont->setId_produktuak($produktu_id);
$cont->delete();
unset($cont);
//$cont->borrar_ikasle($ikasle_id);
//print($ikasle_id)
?>



 
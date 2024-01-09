
<?php

include_once("../model/modelo_produktuak.php");
$cont = new modelo_produktuak();
$cont->setProduktuak();

$datos = $cont->getProduktuak();

$produktuak = json_encode($datos);
print $produktuak;

?>


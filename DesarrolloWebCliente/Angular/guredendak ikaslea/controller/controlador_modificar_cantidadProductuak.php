<?php
require_once '../model/modelo_produktuak.php';

$datos = json_decode($_GET['value']);
$longitud = sizeof($datos);

foreach ($datos as $item) {
    $id = $item->Id_produktuak;
    $cantidad = $item->Cantidad;
    var_dump("indice :" . $id);
    var_dump("contorlador :" . $cantidad);

    $cont = new modelo_produktuak();
    $cont->setId_produktuak($id);
    var_dump($cont->getId_produktuak());
    $cont->setCantidad($cantidad);
    var_dump($cont->getCantidad());
    $cont->updateCantidad();
}

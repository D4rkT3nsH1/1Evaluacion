<?php
require_once '../model/modelo_produktuak.php';
// var_dump($_GET['value']);
$datos = json_decode($_GET['value']);
//$longitud=sizeof($datos);
//var_dump($datos);
//for ($i = 1; $i <= $longitud; $i++) {

$id = $datos->id_produktuak;
$nombre = $datos->nombre;
$tipo = $datos->tipo;
$precio = $datos->precio;
$cantidad = $datos->cantidad;
$foto = $datos->foto;
//var_dump($cantidad);
$cont = new modelo_produktuak();
$cont->setId_produktuak($id);
$cont->setNombre($nombre);
$cont->setTipo($tipo);
$cont->setPrecio($precio);
$cont->setCantidad($cantidad);
$cont->setFoto($foto);
//var_dump($cont->getFoto());
$cont->update();
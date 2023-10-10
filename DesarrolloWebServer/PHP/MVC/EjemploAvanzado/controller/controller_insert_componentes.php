
<?php

include_once ("../model/componentes_model.php");

$data=json_decode(file_get_contents("php://input"),true);

$componentes= new componentes_model();

$componentes->id_marca=$data['id_marca'];
$componentes->img_componentes=$data['img_componentes'];
$componentes->tipo=$data['tipo'];
$componentes->stock=$data['stock'];
$componentes->precio=$data['precio'];

$response=array();
//var_dump($persona);
$response['error']=$componentes->insert();

echo json_encode($response);
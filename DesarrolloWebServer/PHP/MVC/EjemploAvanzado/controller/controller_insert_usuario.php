<?php

include_once ("../model/usuarios_model.php");

$data=json_decode(file_get_contents("php://input"),true);
//var_dump(file_get_contents("php://input"));

$usuarios= new usuarios_model();

$usuarios->nombre=$data['nombre'];
$usuarios->correo=$data['correo'];
$usuarios->pasahitza=$data['pasahitza'];

$response=array();
//var_dump($usuarios);
$response['usuarios']=$usuarios->insert();

echo json_encode($response);
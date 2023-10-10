<?php
include_once ("../model/usuarios_model.php");

$data=json_decode(file_get_contents("php://input"),true);


$usuario=new usuarios_model();

$response=array();

$usuario->nombre=$data['nombre'];
$usuario->pasahitza=$data['pasahitza'];


$response['usuario']=$usuario->setList();
$response['error']=$data['nombre'];

echo json_encode($response);

unset ($usuario);

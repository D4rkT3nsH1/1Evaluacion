<?php

include_once ("../model/usuarios_model.php");

$usuarios=new usuarios_model(); 

$response=array();
$response['usuario']=$usuarios->setList();
$response['error']="not error"; 

echo json_encode($response);

unset ($componentes);

<?php

include_once ("../model/componentes_model.php");

$marca= new marca_model();

$response=array();
$response['marca']=$marca->setList();
$response['error']="not error"; 

echo json_encode($response);

unset ($componentes);

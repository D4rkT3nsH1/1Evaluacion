<?php

include_once ("../model/componentes_model.php");

$componentes= new componentes_model();

$response=array();
$response['componentes']=$componentes->setList();
$response['error']="not error"; 

echo json_encode($response);

unset ($componentes);

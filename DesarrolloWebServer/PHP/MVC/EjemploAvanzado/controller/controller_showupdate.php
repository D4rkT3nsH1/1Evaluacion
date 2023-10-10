<?php
include_once ("../model/componentes_model.php");

$data=json_decode(file_get_contents("php://input"),true);

$componentes=new componentes_model();

$componentes->id_componentes=$data['id_componentes'];

$response=array();

if ($componentes->id_componentes!=null)
{
    $componentes->setId_componentes($componentes->id_componentes);
    $response['error']=$componentes->showupdate();
    
} else{
    $response['error']="Ez da id pasatu/No se ha pasado id";
}

echo json_encode($response);
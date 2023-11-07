<?php
// importar librería de base de datos
include_once("db.php");

// Obtener datos de coches
$array_de_coches = db_query("SELECT modelo, marca, ano, precio FROM coches");

// Si $coches NO es un array que además esta lleno, crear unos datos Fake de pruebas
if (!(is_array($coches) && sizeof($coches) > 0)) {
    $array_de_coches = array(
        array("modelo" => "Coche1", "marca" => "Marca1", "ano" => 2020, "precio" => 20000),
        array("modelo" => "Coche2", "marca" => "Marca2", "ano" => 2019, "precio" => 25000),
        array("modelo" => "Coche3", "marca" => "Marca3", "ano" => 2021, "precio" => 22000),
        array("modelo" => "Coche4", "marca" => "Marca4", "ano" => 2018, "precio" => 18000),
        array("modelo" => "Coche5", "marca" => "Marca5", "ano" => 2017, "precio" => 17000)
    );
}

// Devolver los datos codificados en formato JSON
header("Content-Type: application/json");
echo json_encode($array_de_coches);
?>
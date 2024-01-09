
 <?php

require_once '../model/modelo_produktuak.php';
$produktu_array =json_decode($_GET['value']);

$nombre=$produktu_array->nombre;
$tipo=$produktu_array->tipo;
$precio=$produktu_array->precio;

$cantidad= $produktu_array->cantidad;
$foto=$produktu_array->foto; 
var_dump($tipo);

$cont = new modelo_produktuak();
$cont->setNombre($nombre);
$cont->setTipo($tipo);
$cont->setPrecio($precio);

$cont->setCantidad($cantidad);
$cont->setFoto($foto);
$nuevo=$cont->insert();
//print $nuevo;
unset($cont);

//necesito el id del último alumno insertado

?>
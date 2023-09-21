<?php
$a=7;
$b=8;
$c=7;

if ($a == $b && $a == $c){
    echo "Hay 3 numeros iguales a $a";
}else if ($a == $b && $a != $c){
    echo "Hay 2 numeros iguales a $a";
}else if ($a != $b && $a == $c){
    echo "Hay 2 numeros iguales a $a";
}else if ($a != $b && $a != $c && $b == $c){
    echo "Hay 2 numeros iguales a $b";
}else{
    echo "No hay ningun numero igual";
}

?>
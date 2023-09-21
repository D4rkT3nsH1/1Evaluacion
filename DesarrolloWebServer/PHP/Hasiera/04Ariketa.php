<?php
$a=-7;

if ($a > "A" && $a < "Z"){
    echo "$a Maiuskula da";
}else if($a > "a" && $a < "z"){
    echo "$a Minuskula da";
}else if($a == "" || $a == " "){
    echo "Karaktere zuria da";
}else if($a == "." || $a == ","){
    echo "$a Puntuazio-zeinua da";
}else if(is_numeric($a)){
    echo "$a Zenbaki bat da";
}else{
    echo "Beste karaktere bat da";
}

?>
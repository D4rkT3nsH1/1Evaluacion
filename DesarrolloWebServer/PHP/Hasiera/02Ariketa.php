<?php
$a=56;
$b=96;
$c=48;

if ($a > $b){
    if ($a > $c){
        if ($b > $c){
            echo "$c, $b, $a";
        }else{
            echo "$b, $c, $a";
        }
    }else{
        echo "$b, $a, $c";
    }
} else if ($a > $c){
        echo "$c, $a, $b";
    }else if ($c > $b){
            echo "$a, $b, $c";
        }else{
            echo "$a, $c, $b";
        }

?>
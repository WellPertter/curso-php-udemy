<?php
    $array = [];

    for($i = 10;$i<=20;$i++){
        array_push($array, $i);
    }

    for($i = 0;$i<=10;$i++){
        if (($array[$i]%2) != 0){
        echo $array[$i].'<br>';
        }
    }
?>  
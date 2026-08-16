<?php
    $array = [];

    for($i = 0;$i<20;$i++){
        $array[$i] = $i + 1;    
    }
    for($i = 0;$i<20;$i++){
        if (($array[$i]%2)==0){
            echo $array[$i].'<br>';
        } 
    }
?>  
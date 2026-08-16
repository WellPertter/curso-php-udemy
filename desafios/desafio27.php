<?php
    $lista = [10, 'string1', '1000', 10, 'string1', '1000', 10, 'string1', 'ar', true];
    $x = 0;
    while ($x < 10) {
        if (is_string( $lista[$x])){
            echo $lista[$x].'<br>';
        } 
         $x +=1;  
    }
?>
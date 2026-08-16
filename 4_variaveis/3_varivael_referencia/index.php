<?php
    $x = 2;
    $y =& $x; 
    echo $x, "<br>";
        $y  = 4;
    echo $x, "<br>";
?>
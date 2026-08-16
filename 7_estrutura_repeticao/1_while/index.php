<?php
    $x  = 0;
    while ($x < 10) {
        $x += 1;
        echo $x.'<br>';
    }
    $x  = 0;
    echo 'break no 2<br>';
    while ($x < 10) {
        $x += 1;
        echo $x.'<br>';
        if ($x == 2){
            break;
        }
    }
    $x  = 0;
    echo 'do while <br>';
    do {
        $x += 1;
        echo 'DO'.$x.'<br>';
    } while ($x < 3);

?>
<?php
    $matriz = [
        [1, 2, 3, 4],
        [10, 20, 30, 40],
        [100, 200, 300, 400]
    ];
    
    foreach ($matriz as $lista){
        foreach ($lista as $item){
            echo($item);
            echo ' ';
        }
        echo '<br>';
    }

?>
<?php

    function IsPar($num){
        if ($num%2==0){
            echo "O número $num é Par.<br>";   
        } else {
            echo "O número $num é ímpar.<br>";   
        }
    };

    IsPar(24);
    IsPar(19);
    IsPar(2);
    IsPar(1);

?>
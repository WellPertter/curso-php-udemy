<?php


    function funcArgs($num){
        print_r(func_get_args());
        echo '<br>';
        print_r(func_num_args());
        return $num  *  $num ;     
    };
    
    funcArgs(1);



/* 

exercício  OK
    function sumEvenNumbers($num){
        $soma = 0;
        for($x=1; $x <= $num; $x++){
            if ($x%2 == 0){
               $soma += $x; 
            }
            
        }
        return $soma;     
    };
    echo sumEvenNumbers(6); */
?>


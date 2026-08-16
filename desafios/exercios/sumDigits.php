<?php
    function sumDigits($num){
        $soma =  0;
        $numStr = (string) $num;
        
        for($i = 0; $i < strlen($numStr); $i++){
            $soma +=  (integer) $numStr[$i];
        }
        return $soma;
    }
    
    echo sumDigits(22); // Exibe: 4
?>
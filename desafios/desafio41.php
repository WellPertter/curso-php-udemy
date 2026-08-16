<?php
    $frase = "este item está em promoção";
    $frase = ucfirst($frase);
    $frase_final ="";
    $init = false;

    for ($i = 0; $i < strlen($frase); $i++){
        if ($frase[$i] == 'p' || $init){
            $frase_final = $frase_final . strtoupper($frase[$i]);
            $init = true;
        } else {
           $frase_final = $frase_final . $frase[$i]; 
        }

    }

    echo ($frase_final);
?>

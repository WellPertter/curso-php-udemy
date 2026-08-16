<?php
    $quantidade_a = 0;
    $historia = "O rato roeu a roupa do rei de Roma";

    for ($i = 0; $i < strlen($historia); $i++){
        if ($historia[$i] == 'a'){
            $quantidade_a = $quantidade_a + 1;     
        }


        
    }
    echo 'A Quantidade de A é: '.$quantidade_a;
?>

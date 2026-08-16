<?php
    $var1 = 1;
    $var2 = 97;
    $var3 = 'Deus';
    $var4 = 'teste';

    if (is_int($var1) || is_bool($var1)){
        $multi= ($var1 * 2);

        if ($multi > 100){
            echo '1 - O número é maior que 100<br>';
        } else {
            echo '1 - O número é menor que 100<br>';
        }

    } else {
        echo '1 - Não é um número BR<br>';
    }

    if (is_int($var2) || is_bool($var2)){
        $multi= ($var2 * 2);

        if ($multi > 100){
            echo '2 - O número é maior que 100<br>';
        }else {
            echo '2 - O número é menor que 100<br>';
        }

    } else {
        echo '2 - Não é um número BR<br>';
    }

    if (is_int($var3) || is_bool($var3)){
        $multi= ($var3 * 2);

        if ($multi > 100){
            echo '3 - O número é maior que 100<br>';
        }else {
            echo '3 - O número é menor que 100<br>';
        }

    } else {
        echo '3 - Não é um número BR<br>';
    }
?>
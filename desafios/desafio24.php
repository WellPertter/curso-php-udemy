<?php
    $var1 = 'teste';
    $var2 = 1;
    $var3 = true;

    if (is_int($var1)) { 
        echo '1 - É inteiro.<br>';
    } else {
        echo '1 - Não é inteiro.<br>';
    }
    if (is_int($var2)) { 
        echo '2 - É inteiro.<br>';
    } else {
        echo '2 - Não é inteiro.<br>';
    }
    if (is_int($var3)) { 
        echo '3 - É inteiro.<br>';
    } else {
        echo '3 - Não é inteiro.<br>';
    }
?>
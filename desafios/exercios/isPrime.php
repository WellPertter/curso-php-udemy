<?php
    function IsPrime($num){
        if ($num < 2 || ($num > 2 && $num%2 == 0)) {
            return false;
        } elseif  ($num == 2) {
            return true;
        } else {
            for ($i = 3; $i < $num; $i = $i + 1){
                if  ($num%$i == 0){
                    return false;
                    break;
                }
            }
            return true; 
        }
    }

    $inicio = microtime(true);
    echo IsPrime(999999937).'<br>';

    $fim = microtime(true);
    $tempoTotal = $fim - $inicio;

    echo "O código levou " . $tempoTotal . " segundos para rodar.";
?>

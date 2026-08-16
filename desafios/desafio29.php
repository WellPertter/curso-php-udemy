
<?php
    $valores = [10, 20, 30, 40, 50, 60, 70, 80, 90, 100];
    $c = 0;
    while ($c < 10){
        if ($valores[$c] == 30 || $valores[$c] == 40) {
            $c++;
            continue;
        }
        echo $valores[$c].'<br>'; 
        $c++;
    }
?>

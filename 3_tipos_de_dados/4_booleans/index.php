<?php
    $bolean = false;

    if ($bolean) {
        echo "Entrou no IF, então é TRUE<br>";
    }
    if (is_bool($bolean)) {
        echo " 1 É BOOLEAN no IF, então é TRUE<br>";
    }
    if (is_bool(0)) {
        echo " 2 É BOOLEAN no IF, então é TRUE <br>";
    }
    if (0 == false) {
        echo " 0 é falso <br>";
    }
?>
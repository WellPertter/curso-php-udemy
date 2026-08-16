<?php
    $velocidade = 36;

    if ($velocidade < 40) {
        echo 'O motorista está na velocidade correta.<br>';
    } else if ($velocidade == 40) {
        echo 'O motorista deve tomar cuidado!<br>';
    } else if ($velocidade > 40) {
        echo 'O motorista levou um multa.<br>';
    }
?>
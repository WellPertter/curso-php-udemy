<?php
    $a = 10;
    function escopo(){
        $a = 5;
        echo "Escopo local é $a <br>";
    }
    escopo();
    echo "Escopo global é $a <br>";   
?>
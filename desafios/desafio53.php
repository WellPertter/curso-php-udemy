<?php

    class Cachorro {

        function latir() {
            echo "AuAu<br>";
        }
        function andar($passos) {
            echo "Andei $passos passos <br>";
        }
    }

    $pitbull = new Cachorro;
        $pitbull->latir();
    $pitbull->andar(10);


?>
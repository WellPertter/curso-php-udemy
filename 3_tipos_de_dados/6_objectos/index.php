<?php
    class Pessoa{

        function falar() {
            echo "Olá pessoal!";
        }
    }

    $alec = new Pessoa();
    $alec->nome = "Alec";
    echo $alec->nome;

    $alec->falar();
?>
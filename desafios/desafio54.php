<?php
    class Pessoa {
        // propriedades
        public $nome;
        public $idade;
        // métodos
        function andar($passos) {
            echo "$this->nome andou $passos passos <br>";
        }
    }

    $Arthur = new Pessoa;
    $Arthur->nome = 'Arthur';
    $Arthur->idade = '24';
    $Arthur->andar(10);


?>
<?php
    class Humano {
        // propriedades
        public $nome;
        public $idade;
        // métodos
        function falar() {
            echo 'Olá, bom dia! .<br>';
        }
    }

    class Professor extends Humano {
        // propriedades
        public $materia;
        // métodos
        function aula() {
            echo "Estou dando uma de $this->materia agora! .<br>";
        }
    }



    $Carlos = new Professor;
    $Carlos->nome = 'Carlos Professor';
    $Carlos->idade = '52 anos';
    $Carlos->materia = 'História';
    $Carlos->falar(); 
    $Carlos->aula(); 
?>
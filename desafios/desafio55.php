<?php
    class Carro {
        // propriedades
        public $modelo;
        public $velocidade_maxima;
        // métodos
        function setVelocidadeMaxima($velocidade) {
            $this->velocidade_maxima = $velocidade;
        }
        function getVelocidadeMaxima() {
            echo 'A velocidade máxima é: '.$this->velocidade_maxima.'<br>';
        }
    }

    $byd = new Carro;
    $byd->setVelocidadeMaxima('100km'); 
    $byd->getVelocidadeMaxima(); 
?>
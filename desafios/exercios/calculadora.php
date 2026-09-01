<?php
    // constructor
    class Calculadora{    

        function somar($a, $b){
            return ($a + $b);
        } 
        function subtrair($a, $b){
             return ($a - $b);
        } 
        function multiplicar($a, $b){
             return ($a * $b);
        } 
        function dividir($a, $b){
             return ($a / $b);
        } 
    }

    $x = new Calculadora;
    echo $x->somar(10, 2);
    echo '<br>';
    echo $x->subtrair(10, 2);
        echo '<br>';
    echo $x->multiplicar(10, 2);
        echo '<br>';
    echo $x->dividir(10, 2);
?>
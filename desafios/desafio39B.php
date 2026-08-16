<?php

    $lista_de_carros = ["BYD DOPHIN" => 100000,  "BYD KING" => 200000, "TOYOTA HILUX" => 300000];


    foreach($lista_de_carros as $carro => $preco){
        if ($preco >= 150000){
            echo "O carro $carro custa R\$ $preco <br>";
        }
    }
?>

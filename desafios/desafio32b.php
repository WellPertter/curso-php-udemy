<?php

    function funcao_nome_e_sobrenome(){
        $nome = 'José';
        $sobrenome = 'Arthur';
        $nome_sobrenome = $nome  . ' ' . $sobrenome;

        echo $nome_sobrenome . '<br>';     
    };

    funcao_nome_e_sobrenome();

?>
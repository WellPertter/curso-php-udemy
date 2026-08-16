<?php
    function defineCorCarro($cor="vermelha"){
        return $cor;
    }

    echo 'A cor do carro é: '. defineCorCarro().'<br>';
    echo 'A cor do carro é: '. defineCorCarro('Azul').'<br>';
?>
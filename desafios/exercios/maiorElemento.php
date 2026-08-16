<?php

function maiorElemento($lista){
    rsort($lista);
    return $lista[0];
}


echo maiorElemento([1, 2, 3]);



?>
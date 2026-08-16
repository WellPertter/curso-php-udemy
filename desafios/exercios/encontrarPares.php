<?php

function encontrarPares($lista){
    $nova_lista = [];
    foreach ($lista as $item){
        if (($item  % 2 )== 0)    {
           $nova_lista[] = $item; 
        }
    }

    return $nova_lista;
}


print_r( encontrarPares([1, 2, 3, 4, 6, 10, 11]) );



?>
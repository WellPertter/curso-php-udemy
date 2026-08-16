<?php
    function lista_mercadorias($lista){
        $nova_lista = '';
        foreach($lista as $item){
            if ($nova_lista == '') {
                $nova_lista = $item;
            } else {
                $nova_lista = $nova_lista . ', ' . $item ;
            }
        }
        if ($nova_lista == ''){
            return '';
        } else {
            return $nova_lista . '.';
        }
        
    }

    echo lista_mercadorias(['Arroz', 'Trigo', 'Sal', 'Feijao', 'Vinagre']);
?>
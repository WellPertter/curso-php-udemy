<?php
 $alimentos = [
    'batata',
    'maçã',
    'pera',
    'feijão',
    'arroz'
 ];
 print_r($alimentos);
 echo '<br>';
   array_splice($alimentos, 2, 1) ;
   array_splice($alimentos, 2, 1) ;
 print_r($alimentos);
?>
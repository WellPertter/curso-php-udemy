<?php
    $lista = range(10, 45);
    $soma = 0;

  //  foreach ($lista as $item){
   //     if (($item % 6) == 0  && ($item < 30)) {
  //          echo $item. '<br>';
//        }
 //   }
  
    foreach ($lista as $item){
        $soma += $item;

        if ($soma > 30){
            echo " A soma $soma é muita alta!".'<br>';
        } else {
            echo "Soma: $soma".'<br>';
        }
    }
    

?>
<?php
  $lista = ["Arthur" => '24 anos', "Alexia" => '21 anos' , "Alec" => "8 meses"];


  echo '<table border="1">';
  echo '<tr> <th>Nome</th> <th>Idade</th> </tr>';


    foreach ($lista as  $nome => $idade){
      echo '<tr>';
      echo "<td> $nome </td>";
      echo "<td> $idade </td>";
      echo '</tr>';
    }


  echo '</table>';


?>
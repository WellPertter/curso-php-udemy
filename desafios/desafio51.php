<?php

  $lista = [ "Alexia" => 200, "Arthur" => 1000, "Alec" => 300];

  

  arsort($lista);
  echo '<table border="1">';
  echo '<tr>  <th>Nome</th> <th>Pontos</th> </tr>';


    foreach ($lista as  $nome => $pontos){
      echo '<tr>';
      echo "<td> $nome  </td>";
      echo "<td> $pontos </td>";
      echo '</tr>';
    }


  echo '</table>';


?>
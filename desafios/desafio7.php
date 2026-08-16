<?php
    $pessoa = ["nome" => "Alec", "idade" => 0.54, "mãe" => "Alexia Rodrigues", "pai" => "José Arthur"];
    $nome = $pessoa['nome']; 

    if ($pessoa["idade"] >= 18){
        echo "O $nome é maior de idade.";
    } else {
        echo "O não é $nome maior de idade.";        
    }
?>
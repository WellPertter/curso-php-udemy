<?php
    // interpolar
    $testo = 'test';
    $nome = 'José Arthur';
    echo "Teste interporlar {$nome} <br>";
    echo "Teste interporlar $testo <br>";

  //  header("Content-type: text/plain");
    // evalores de escape
// \t = tab   \\ = barra invertida  \$ = sinal do dolar
    echo "\n oi \n \$ \t oi";

    print('imprimindo algo');
    printf(" %d %s", 1, 'oi');



    echo "\n tamanho da string ". strlen('arthur');


    echo "\n";
    $variavel = "arthur.php";
    for ($i = 0; $i < strlen($variavel); $i++){
        echo $variavel[$i]."\n";
    }

    echo (" xx    x     ");
    echo "\n";
    echo trim(" xx    x       ");
    echo "\n";
    echo ltrim(" xx    x       ");
    echo "\n";
    echo rtrim(" xx    x       ");

    echo "\n";
    echo strtolower("LOkdi2wkd ");
    echo "\n";
    echo strtoupper("LOkdi2wkd ");

    echo "\n";
    echo ucfirst(strtolower("LOkdi2wkd LOkdi2wkd"));
    echo "\n";
    echo ucwords(strtolower("LOkdi2wkd LOkdi2wkd"));   

    echo "\n";
    echo strip_tags("<p>OI</P>  ");

    $texto = 'Olá, sou o Arthur';
    echo substr($texto, 12, 6);

    $texto = ' sou o Arthur';
    echo strrev($texto);

    echo "<br>";
    $texto = ' sou o Arthur';
    echo str_repeat($texto, 2);  

    // string para array
    echo "<br>";
    $texto = ' sou o Arthur';
    print_r( explode(" ", $texto));  

    // string para array
    echo "<br>";
    $lista = ['item5', 'item4', 'item3', 'item2'];
    echo implode(', ', $lista);

    echo "<br>";
    $texto = ' sou o Arthur e estou curtindo bastante o PHP, estou aprendendo sobre o elevante azul e o \$';
    print_r( strpos($texto, 'Arthur'));  
    
    echo "<br>";
    $texto = ' sou o Arthur e estou curtindo bastante o PHP, estou aprendendo sobre o elevante azul Arthur e o \$';
    print_r( strrpos($texto, 'Arthur'));  


    echo "<br>";
    $texto = ' sou o Arthur e estou curtindo bastante o PHP, estou aprendendo sobre o elevante azul Arthur e o \$';
    print_r( strstr($texto, 'estou'));  

    echo "<br>";
    $url = 'https://www.udemy.com';
    $arrayurl = parse_url($url);
    print_r($arrayurl);

?>
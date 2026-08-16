<?php
// alteracao de index
    $arr =[];
    $arr[1] = "teste";

// atribiur valor em um novo index no finla 
    $arr[] = 'ulitmo';


    // range para criar um array

    $arr3 = range(0, 10);


    print_r($arr3);
    echo '<br>';
    echo count($arr3);
    echo '<br>';
    // array multidimensional
    $matriz[0][0] = 1;
        $matriz[1][0] = 2;
            print_r($matriz);
    $matriz2 = [
        [1, 2],
        [3, 4]
    ];
    echo '<br>';
          print_r($matriz2);

    echo '<br>';
    // Pegar os valores da lista para uma variável

    $pessoa = ['Arthur', 24, "desenvolvedor"];

    list($nome, $idade, $profissao) = $pessoa;
    echo $nome;


// array_slice ( array, início, quanitdade de items para pegar) = retonra um array delimitado;

    $pessoa = ['Arthur', 24, "desenvolvedor"];
    $pessoa_nome_e_idade = array_slice($pessoa, 0, 2);
        echo '<br>';
          print_r($pessoa_nome_e_idade);

//  array_chunk  ->  dividar array em arrays com base na quantidade de elementos;
    $pessoa = ['Arthur', 24, "desenvolvedor", "endereço"];
        echo '<br>';
          print_r(array_chunk($pessoa, 1));  // R

    // array associativos
  //  array_keys -> retornar as chaves (array)
  //  array_values -> retonar os valores (array)

  $array_associativo = [
    'marca' => 'bmw',
    'motor' => 1.4,
    'cor' => 'azul'
  ];
        echo '<br>';
          print_r( array_keys($array_associativo));  // R
        echo '<br>';
          print_r( array_values($array_associativo));  // R

    // array_key_exists('key', $lista) => diz se tem a chave no array  -> null or 1
    // isset($array_associativo['marca']) => diz se tem a chave no array  -> null or 1

        echo '<br>';
          print_r( array_key_exists('marcax', $array_associativo));  // R

        echo '<br>';
          print_r( isset($array_associativo['marca']));  // R

// array_splice => remove array_splice($lista, 2, 1)  - Retornar e remove um array a partir do index 2, 1 elemento.

      echo '<br>';
          print_r( $array_associativo);  // R

      echo '<br>';
          print_r(array_splice($array_associativo, 2, 1));  // R

/// extract +> Extrais variais da lista criando com base no nome  ( somente para arrays associativos, subscrevendo o nome da variável)

  $array_associativo_2 = [
    'marca' => 'bmw',
    'motor' => 1.4,
    'cor' => 'azul'
  ];

    echo '<br>';
  extract($array_associativo_2);
echo "$marca";


/// compact -> cria um array a partir de variáveis 
    $tipo_carro = '4x4';
    $tipo_carro_cor =  'branco';
    $tipo_carro_marca = 'toyota'; 
   $carros = compact("tipo_carro","tipo_carro_cor","tipo_carro_marca");
   print_r($carros);
    echo '<br>';

   // foreach e arrays

   foreach ($carros as  $chave => $valor){
    echo $chave. ': '.$valor;
        echo '<br>';
   }


   // array_reduce -> array_reduce($lista, $funcao)  reduzir o array a um único
  $lista = range(0, 10);

  function soma($a, $b){
    return $a + $b;
  }
  
  $resultado = array_reduce($lista, "soma");

  echo $resultado;
        echo '<br>';
  echo in_array(1, $lista);

    // orderna o array rsort(decrescente) e sort ( crescente)
       echo '<br>';
  rsort($lista);
     echo '<br>';
  print_r($lista);
       echo '<br>';
  sort($lista);
     echo '<br>';
  print_r($lista);

  // coomo orderna arrays associativos 
 /// asort ( $lista) - orderna pelo valor  -> arsort
  //ksort( $lista ) - ordena pela chave    -> krsort
    $tipo_carro = '4x4';
    $tipo_carro_cor =  'branco';
    $tipo_carro_marca = 'toyota'; 
   $carros = compact("tipo_carro","tipo_carro_cor","tipo_carro_marca");

  echo '<br>';
  asort($carros);
  echo '<br>';
  print_r($carros);
  echo '<br>';
  ksort($carros);
  echo '<br>';
  print_r($carros);


  echo '<br>';
  arsort($carros);
  echo '<br>';
  print_r($carros);
  echo '<br>';
  krsort($carros);
  echo '<br>';
  print_r($carros);

  // array_reverse($array)  -> retonrar o arrey invertido
  $lista = [ "Alexia" , "Arthur" , "Alec"];
  echo '<br>';
  print_r($lista);
   $lista  = array_reverse($lista);
  echo '<br>';
  print_r($lista);


  
// shuffle($lista) -> retorna a lista ordenada de forma aleatória
 $lista = [ "Alexia" , "Arthur" , "Alec"];
   echo '<br>';
  print_r($lista);
  shuffle($lista);
  echo '<br>';
    print_r($lista);
  shuffle($lista);
  echo '<br>';
  shuffle($lista);
    print_r($lista);
  echo '<br>';
  print_r($lista);

 $lista_num = [3 , 2 , 1];
   echo '<br>';
  echo array_sum($lista_num);

   echo '<br>';
  print_r(array_merge( $lista ,  $lista_num));
     echo '<br>';
   print_r($lista);

     echo '<br>'; 
     
     echo '<br>'; 
   print_r( array_diff( $lista_num, $lista));
?>
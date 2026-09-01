<?php
    // métodos que vão facilitar o trabalho com datas
    date_default_timezone_set('America/Sao_Paulo');
    $d = date("d/m/y"); //day/month/year
    echo $d .'<br>';
    $d = date("F j, Y, g:i a"); //day/month/year
    echo $d.'<br>';


    $d = date("d/m/y", strtotime('+2years'));   // 2 anos no futuro
    echo $d.'<br>';
    $d = date("d/m/y", strtotime('-2years'));   // 2 anos no futuro
    echo $d.'<br>';


    // mktime(hora, minuto, segundo, mês, dia, ano)
    $d = mktime(8, 29, 55, 8, 22, 2026);

    echo $d.'<br>';
    $d = date('d/m/Y',  $d);
    echo $d.'<br>';

    // objeto DateTime()  ->  se passar parâmetros gera a data, se não a ATUAL.  usa print_r 
    $data = new DateTime;
    print_r($data);
    //formatação ( classe )
    echo '<br>'.$data->format('d/n/Y');
    echo '<br>'.$data->format('F');
    $data->modify('+5 years'); 
    echo '<br>'.$data->format('d/n/Y'); 

    // setdate(ano, mes, dia)
    // settime(hora, minuto, segundo)
    echo '<br>';
    print_r($data);
    $data->setDate(1999, 1, 1);
    echo '<br>';
   print_r($data);
    $data->setTime(19, 1, 1);
    echo '<br>';
   print_r($data);


   // medir a diferença entre duas datas
    $data2 = new DateTime;
    $data = new DateTime;
    $data->modify('+5 years'); 

  echo '<br>';
    print_r($data2 );
  echo '<br>';
    print_r($data );
  echo '<br>';
    print_r($data2->diff($data));
 echo '<br>';
echo ($data2->diff($data))->format('%y years');

    // comparação de datas > <  ==
    echo '<br>';
    if ($data > $data2){
        echo 'Sim, é maior!';
    } else {
        echo 'É menor!';
    }
    echo '<br>';

?>
<?php
    $host = "localhost";
    $user = "";
    $password = "";
    $database = "cursophp";

    $conn = new mysqli($host, $user, $password, $database);

    $idade = 10;

    $stmt = $conn->prepare("SELECT * FROM pessoas WHERE idade > ?");

    $stmt->bind_param('i', $idade);

    $stmt->execute();

    
    if ($stmt->error){
        echo "Erro: ".$stmt->error;
    }

    $data =  $stmt->get_result()->fetch_all();  // simplificação

    print_r($data);
    echo '<br>';



    $stmt->execute();
    $data =  $stmt->get_result()->fetch_row();  // Resgata apenas 1 linha( a primeira )

    print_r($data);
    echo '<br>';


    $conn->close();


    // 
?>
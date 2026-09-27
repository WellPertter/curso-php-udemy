<?php
    $host = "localhost";
    $user = "";
    $password = "";
    $database = "cursophppdo";

    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);


    // query
    $nome = 'Pedro2';

    $stmt = $conn->prepare("INSERT INTO pessoas(nome) VALUES (:nome)");

    $stmt->bindParam(':nome', $nome);

    $stmt->execute();

    // update
    $nome = 'Pedro';
    $novo = 'Aurora';

    $stmt = $conn->prepare("UPDATE pessoas SET nome = :novo WHERE nome = :nome");

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':novo', $novo);

    $stmt->execute();

    // select
    $idade = 1;


    $stmt = $conn->prepare("SELECT * FROM pessoas WHERE idade > :idade");

    $stmt->bindParam(':idade', $nome);


    $stmt->execute();

   // $data = $stmt->fetch(PDO::FETCH_ASSOC);  // uma linha só
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);  

    print_r($data);





    $conn = null;
?>
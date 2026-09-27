<?php
    $host = "localhost";
    $user = "";
    $password = "";
    $database = "cursophp";

    $conn = new mysqli($host, $user, $password, $database);


    $nome = 'Antonio';
    $idade = 9;

    $stmt = $conn->prepare("INSERT INTO pessoas (nome, idade) VALUES (?, ?)");

    $stmt->bind_param("si", $nome, $idade); // s= string, i = integer, d = double

    $stmt->execute();




?>
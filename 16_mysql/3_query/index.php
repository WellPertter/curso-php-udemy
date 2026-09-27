<?php
    $host = "localhost";
    $user = "";
    $password = "";
    $database = "cursophp";

    $conn = new mysqli($host, $user, $password, $database);

    // query
   // $conn->query("CREATE TABLE usuarios(`name` varchar(100) NOT NULL);");


    $tabela = 'usuarios';
    $nome = 'Luiz';


    //$conn->query("INSERT INTO $tabela (`name`) VALUES('$nome');");
    $sql = "SELECT * FROM pessoas";

    $result = $conn->query($sql)->fetch_assoc();
    print_r($result);
    echo '<br>';
    $result = $conn->query($sql)->fetch_all();
    print_r($result);




    $conn->close();
?>
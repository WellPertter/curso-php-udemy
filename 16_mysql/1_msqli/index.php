<?php
    $host = "localhost";
    $user = "";
    $password = "";
    $database = "cursophp";

    $conn = new mysqli($host, $user, $password, $database);

    if($conn->connect_errno){
        echo "erro na conexão<br>";
        echo "erro: ". mysqli_connect_error().'<br>';
        echo "erro: ".$conn->connect_errno;
    }


?>
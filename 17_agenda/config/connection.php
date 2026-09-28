<?php 
    $host = "localhost";
    $user = "admin2";
    $password = "root@2026";
    $database = "agenda";

    $sql_createds = "CREATE TABLE IF NOT EXISTS contacts (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(250),
        phone VARCHAR(20),
        observation TEXT
    )";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);

        // Ativar os erros 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $conn->exec($sql_createds);
    } catch(PDOException $e) {
        $error = $e->getMessage();
        echo "Erro: $error";
    }

?>
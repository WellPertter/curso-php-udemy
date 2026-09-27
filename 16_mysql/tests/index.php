<?php
    $host = "localhost";
    $user = "";
    $password = "";
    $database = "cursophp";

    $conn = new mysqli($host, $user, $password, $database);

    echo '<form method="POST">';
    echo '<input type="text" name="sql">';
    echo '<input type="submit" name="execute" value="Executar">';
    echo '</form>';

    if (isset($_POST['execute'])) {

        $conn->query($_POST['sql']);
    }

?>
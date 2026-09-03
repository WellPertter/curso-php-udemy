<?php
    session_start();

    if (isset($_SESSION["lista"])){
       $lista = $_SESSION["lista"];
    } else {
        $lista = [];
        $_SESSION["lista"]  = $lista;
    }

    

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $item = $_POST["item"];

        if (isset($_POST["adicionar"])) {
            $lista[] = $item;
        }

        if (isset($_POST["remover"])) {
            $chave = array_search($item, $lista);

            if ($chave !== false) {
                unset($lista[$chave]);
            }
        }

        if (isset($_POST["editar"])) {
            $itemAntigo = $_POST["item"];
            $itemNovo = $_POST["novoitem"];

            $chave = array_search($itemAntigo, $lista);

            if ($chave !== false) {
                $lista[$chave] = $itemNovo;
            }
        }

        $_SESSION["lista"]  = $lista;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="text" name="item">
        <button type="submit" name="adicionar">Adicionar Item</button>
    </form>
    <br>
    <form method="POST">
        <input type="text" name="item">
        <button type="submit" name="remover">Remover Item</button>
    </form>
    <br>
    <form method="POST">
        <input type="text" name="item">
        <input type="text" name="novoitem">
        <button type="submit" name="editar">Editar Item</button>
    </form>

    <ul>
    <?php foreach($lista as $item){ echo "<li> $item </li>";} ?>
    </ul>
</body>
</html>
<?php

   $metodo = $_SERVER['REQUEST_METHOD'].'<br>';

    if (isset($_POST['nome'])){
        $nome = $_POST['nome'];
    } else {
        $nome = '';
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

    <?php
        if ($metodo == 'GET'):
    ?>

    <form action="index.php" method="post">
        <div>
            <input type="text" name="nome" placeholder="Preencha o seu nome" >
        </div>
        <div>
            <input type="number" name="idade" placeholder="Preencha a seu idade" >
        </div>
        <div>
            <input type="submit" value="Enviar">
        </div>
    </form>

    <?php
        else:
    ?>
    <h1>O seu nome é <?= $nome ?> </h1>
    <?php
        endif;
    ?>

    
</body>
</html>

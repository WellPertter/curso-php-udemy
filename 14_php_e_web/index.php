<?php
   // print_r($_SERVER);

    echo $_SERVER['MYSQL_HOME'].'<br>';

    if ($_SERVER['SERVER_NAME'] == 'localhost'){
        echo 'Está acessando o localhost!';
    }

    // autopreenchimento
    $usuario = [
        'nome' => 'José Arthur',
        'idade' => '24',
        'profissão' => 'Desenvolvedor'
    ];

    if ($usuario) {
        $nome = $usuario['nome'];  
        $idade = $usuario['idade'];  
        $profissao = $usuario['profissão'];  
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
    
    <form action="">
        <input type="text" name="nome" value="<?= $nome ?>" planceholder="Digite seu nome"> <br>
        <input type="text" name="idade" value="<?= $idade ?>" planceholder="Digite sua idade"><br>
        <input type="text" name="profissao" value="<?= $profissao ?>" planceholder="Digite sua profissão"><br>
    </form>
</body>
</html>
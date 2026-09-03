<?php
    $validacoes = [];

    if(count($_POST)>0){
  
        echo "Teste"."<br>";

        if($_POST["nome"] === ""){
          $validacoes[] = "Por favor, preencha o seu nome!";  
        }
        if($_POST["email"] === ""){
          $validacoes[] = "Por favor, preencha o seu e-mail!";  
        }
        if($_POST["senha"] === ""){
          $validacoes[] = "Por favor, preencha a sua senha!";  
        }   
        if($_POST["confirmacao"] === ""){
          $validacoes[] = "Por favor, confirme a sua senha!";  
        }
        if(!($_POST["senha"] == $_POST["confirmacao"])){
          $validacoes[] = "As senhas precisam ser iguais!";  
        }
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
    <?php if (count($validacoes) > 0): ?>
        <ul>
            <?php 
               foreach ($validacoes as $item) {
                    echo"<li> ".$item ."</li>";
                }
            ?>
        </ul>
    <?php endif; ?>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <input type="text" name="nome"  placeholder="Digite o seu nome"> <br>
        <input type="email" name="email"  placeholder="Digite o seu e-mail"> <br>
        <input type="password" name="senha"  placeholder="Digite a sua senha"> <br>
        <input type="password" name="confirmacao"  placeholder="Confirme a sua senha"> <br>
        <input type="submit" value="Enviar"><br>
    </form>
</body>
</html>
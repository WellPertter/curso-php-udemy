<?php
    include_once('backend.php');
?>

<h1>Seja bem vindo ao nosso site</h1>
<p> <?php echo $nome; ?> veja as ofertas </p>
<h2>Configura os principais itens</h2>
<ul>
    <?php foreach($lista as $item): ?>
        <li><?php echo $item; ?></li>
    <?php endforeach; ?>
</ul>
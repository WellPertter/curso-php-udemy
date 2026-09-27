<?php
    include_once("helpers/url.php");
    include_once("data/categories.php");
    include_once("data/posts.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Codar</title>
    <!-- Estilo do projeto -->
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/style.css">
    <!-- Fontes do projeto -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="icon" href="<?= $BASE_URL ?>/img/bug.ico" type="favicon.ico">
</head>
<body>
    <header> 
        <a href="<?= $BASE_URL ?>" id="logo">
           <img src="<?= $BASE_URL ?>/img/logo.svg" alt="blog codar"> 
        </a> 
        <nav>
            <ul id="navbar">
                <li><a href="<?= $BASE_URL ?>" class="navlink">Home</a></li>
                <li><a href="#" class="navlink">Categorias</a></li>
                <li><a href="#" class="navlink">Sobre</a></li>
                <li><a href="<?= $BASE_URL ?>contato.php" class="navlink" >Contato</a></li>
            </ul>
        </nav>
    </header>
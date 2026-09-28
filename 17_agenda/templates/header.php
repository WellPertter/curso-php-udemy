<?php
    include_once("config/url.php");
    include_once("config/process.php");

    //limpar a mensagem
    if(isset($_SESSION['msg'])){
        $printMsg = $_SESSION['msg'];
        $_SESSION['msg'] = '';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contatos</title>

    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css" integrity="sha512-oc9+XSs1H243/FRN9Rw62Fn8EtxjEYWHXRvjS43YtueEewbS6ObfXcJNyohjHqVKFPoXXUxwc+q1K7Dee6vv9g==" crossorigin="anonymous" />
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.css" integrity="sha512-x9WwyMYBnlXMNQ6kQ/Lyzu1NqIhLQKL5Oq6xByfXuRj7s9CskyCbLv/1IjqzJmXwFXWr0ov6jBV7Qbc0hh9nHg==" crossorigin="anonymous" referrerpolicy="no-referrer">
     <!-- css -->   
    <link rel="stylesheet" href="<?=$BASE_URL?>css/styles.css">

</head>
<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="<?=$BASE_URL?>index.php">
                <img src="<?=$BASE_URL?>img/logo.svg" alt="Agenda" >
            </a>
            <div class="navbar-nav">
                <a href="<?=$BASE_URL?>index.php" class="nav-link active" id="home-link">Agenda</a>
                <a href="<?=$BASE_URL?>create.php" class="nav-link active" >Adicionar Contato</a>
            </div>
        </nav>
    </header>
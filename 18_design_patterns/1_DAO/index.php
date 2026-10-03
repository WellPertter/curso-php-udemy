<?php
    include_once("db.php");
    include_once("dao/CarDAOMySQL.php");

    $carDao = new CarDAOMySQL($conn);

    $cars = $carDao->FindAll();

?>

<h1>Insira um carro</h1>

<form action="process.php" method="post">
    <div>
        <label for="brand">Marca do Carro</label>
        <input type="text" name="brand" placeholder="Insira a Marca">
    </div>
    <div>
        <label for="km">KM do Carro</label>
        <input type="text" name="km" placeholder="Insira o km">
    </div>
    <div>
        <label for="color">Cor do Carro</label>
        <input type="text" name="color" placeholder="Insira a color">
    </div>
    <input type="submit" value="Enviar">
</form>


<ul>
    <?php foreach($cars as $car): ?>
        <li><?= $car->getBrand() ?> - <?= $car->getKm() ?>km - <?= $car->getColor() ?></li>
     <?php endforeach; ?>       
</ul>
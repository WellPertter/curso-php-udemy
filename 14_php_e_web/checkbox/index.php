<?php
    if(isset($_POST["igredientes"])){
        $igredientes = $_POST["igredientes"];
        print_r($igredientes);
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
    
    <form action="index.php" method="post">
        <input type="checkbox" name="igredientes[]" value="tomate" > tomate<br>
        <input type="checkbox" name="igredientes[]" value="cebola" > cebola<br>
        <input type="checkbox" name="igredientes[]" value="feijão" > feijão<br>
        <input type="checkbox" name="igredientes[]" value="arroz" > arroz<br>
        <input type="submit" > <br>
    </form>
</body>
</html>
<?php
    $x =10; // Global

    function teste() { //Local
        $x = 5;
        echo $x, " Local <br>";
    }
    teste() ;
    echo $x, " Global <br>";
?>
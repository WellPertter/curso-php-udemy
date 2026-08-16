<?php
    $x =10; // Global

    if (true){
        echo $x, " Global <br>";
    }
    function testandoglobal() { //Local
        global $x;
        echo $x, " Local <br>";
    }
    testandoglobal();
?>
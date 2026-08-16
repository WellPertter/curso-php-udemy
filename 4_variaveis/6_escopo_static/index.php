<?php
    function teste() {
        static $a = 0;
        $a++;
        echo $a, "<br>";
    }
   teste();
   teste();
   teste();
?>
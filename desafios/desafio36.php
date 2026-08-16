<?php
    function array_7($array) {
        $new_array = [];

        for($x=0; $x < count($array); $x++){
            //echo $array[$x].'<br>';

            if ($array[$x] > 7) {
                array_push($new_array, $array[$x]);
            }
        }

        return $new_array;
    }
    

    foreach(array_7([1, 2, 3, 8, 9]) as $item){
        echo $item.'<br>';
    }

?>
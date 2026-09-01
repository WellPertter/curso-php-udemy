<?php
    class Passenger{
        public $name= 'João';
        public $age;
        public $seatNumber;


        function getName(){
             return  $this->name;
        } 
        function getAge(){
             return  $this->age;
        } 
        function getSeatNumber(){
             return  $this->seatNumber;
        } 

        function setSeatNumber($seatNumber){
            $this->seatNumber = $seatNumber;
        } 

    }



    <?php
    class Passenger{
        public $name= 'Maria';
        public $age='30';
        public $seatNumber='A12';


        function getName(){
             return  $this->name;
        } 
        function getAge(){
             return  $this->age;
        } 
        function getSeatNumber(){
             return  $this->seatNumber;
        } 

        function setSeatNumber($seatNumber){
            $this->seatNumber = $seatNumber;
        } 

    }

?>

?>
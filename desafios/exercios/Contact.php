<?php

    class Contact{
        public $name= 'João';
        public $email;
        public $phone;


        function getName(){
             return  $this->name;
        } 
        function getEmail(){
             return  $this->email;
        } 
        function getPhone(){
             return  $this->phone;
        } 

        function setEmail($email){
            $this->email = $email;
        } 
        function setPhone($phone){
            $this->phone = $phone;
        } 

    }



    <?php
    class Contact{
        public $name= 'João';
        public $email= 'joao@example.com';
        public $phone='123456789';


        function getName(){
             return  $this->name;
        } 
        function getEmail(){
             return  $this->email;
        } 
        function getPhone(){
             return  $this->phone;
        } 

        function setEmail($email){
            $this->email = $email;
        } 
        function setPhone($phone){
            $this->phone = $phone;
        } 

    }


    
?>
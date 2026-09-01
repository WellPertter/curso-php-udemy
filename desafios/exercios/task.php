<?php
    // constructor
    class Task{    
        public $title;
        public $description;
        public $completed;




        function markAsCompleted(){
            $this->completed = true;
        } 
        function markAsIncomplete(){
            $this->completed = false;
        } 

        function getTitle(){
             return  $this->title;
        } 
        function getDescription(){
             return  $this->description;
        } 
        function isCompleted(){
             return  $this->completed;
        } 
    }

        function getTitle(){
            if (is_null($this->title)){
                return 'ESTUDAR';
            } else {
             return  $this->title;}
        } 
        function getDescription(){
            if (is_null($this->description)){
                return 'ESTUDAR';
            } else {
                return  $this->description;
            }

        } 
        function isCompleted(){
             return  $this->completed;
        } 




    $x = new Task;
    $x->markAsCompleted();
     echo $x->isCompleted(); 





<?php

    class Task{    
        public $title;
        public $description;
        public $completed;


        function markAsCompleted(){
            $this->completed = true;
        } 
        function markAsIncomplete(){
            $this->completed = false;
        } 
        
        function getTitle(){
            if (is_null($this->title)){
return 'Estudar';
            } else {
             return  $this->title;}
        } 
        function getDescription(){
            if (is_null($this->description)){
                return 'Estudar para a prova';
            } else {
             return  $this->description;}

             return  $this->description;
        } 
        function isCompleted(){
            if (is_null($this->completed)){
               return false;
            } else {return  $this->completed;}
             
        } 
    }
   
?>














?>
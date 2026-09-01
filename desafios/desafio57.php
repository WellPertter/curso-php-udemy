<?php
    // constructor
    class Cachorro{    
        public $especie;
        public $raca;

        function __construct($especie, $raca) {
            $this->especie = $especie;
            $this->raca = $raca;
        }
        function getEspecie(){
            echo $this->especie.'<br>';
        } 
        function getRaca(){
            echo $this->raca.'<br>';
        } 



    }

    $Poodle = new Cachorro('Canis lupus familiaris', 'Poodle');
    $Poodle->getEspecie();
    $Poodle->getRaca();
?>
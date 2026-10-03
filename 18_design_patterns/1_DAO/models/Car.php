<?php 

    class Car {
        private $Id;
        private $brand;
        private $km;
        private $color;

        public function getId() {
            return $this->Id;
        }
        public function setId($Id) {
            $this->Id = $Id;
        }

        public function getBrand() {
            return $this->brand;
        }
        public function setBrand($brand) {
            $this->brand = $brand;
        }

        public function getKm() {
            return $this->km;
        }
        public function setKm($km) {
            $this->km = intval($km);
        }

        public function getColor() {
            return $this->color;
        }
        public function setColor($color) {
            $this->color = $color;
        }

    }


    interface CarDAO{
        public function create(Car $car);
        public function FindAll();

    }
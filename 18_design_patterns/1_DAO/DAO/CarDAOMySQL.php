<?php 
    include_once("models/Car.php");

    class CarDAOMySQL implements CarDAO {
        private $conn;

        public function __construct(PDO $conn){
            $this->conn = $conn;
        }

        public function FindAll(){
            $cars = [];

            $stmt =$this->conn->query("SELECT * FROM cars ORDER BY brand, km, color");

            $data =$stmt->fetchAll();

            foreach ($data as $veiculo){
                $car = new Car();
                $car->setId($veiculo["Id"]);
                $car->setBrand($veiculo["brand"]);
                $car->setKm($veiculo["km"]);
                $car->setColor($veiculo["color"]);

                $cars[] = $car;
            }

            return $cars;
        }

        public function create(Car $car){

            $stmt =$this->conn->prepare("INSERT INTO cars (brand, km, color) VALUES(:brand, :km, :color)");
            $stmt->bindParam(":brand", $car->getBrand());
            $stmt->bindParam(":km", $car->getKm());
            $stmt->bindParam(":color", $car->getColor());
            $stmt->execute();

        }


    }



<?php
    // padrões para a classe respeitar
    interface Cacacteristicas{
        const consante ='CONTANTE';
        public function falarInter();
    }

    // Objetos são entidades que possuem comportamentos e características
    class Pessoa implements Cacacteristicas{
        // propriedades
        public $nome = 'Arthur';
        protected $protegida = 'Só essa classe e as que fizerem extends';
        private $privado = 'Só essa classe.';

        public $profissao;
        protected $profissao_2;
        private $profissao_3;

        
        public const CHAVE_API = '123';

        // métodos
        function falar() {
            echo "Olá, eu sou um objeto<br>";
        }
        private function somar($x, $y) {
            echo  ($x+$y)."<br>";
        }
        function falarInter(){
             echo "Olá, eu sou um objeto<br>";           
        }
        function Constante(){
             echo self::consante;           
        }
    }

    class Profissional {
        function setProfisscao($objeto) {
            $objeto->profissao = 'Nova profissão';
        }
    }

    class Programador Extends Pessoa{

    }




    $Arthur = new Programador;
    echo $Arthur->nome.'<br>';

    // verificando henraça 
    if ($Arthur instanceof Pessoa){
        echo 'Tem herança com Pessoa: Sim';
    } else {
        echo 'Tem herança com Pessoa: Não';
    }
    $Arthur->Constante();



    trait Objeto{
        public function teste(){
            echo '<br>teste<br>';
        }
    }

    class Central{
        use Objeto;
    }


    $x = new Central;
    $x->teste();


    abstract class ClasseAbstrada{
        public static function teste(){
            echo '<br>teste2<br>';
        }  
    }
    ClasseAbstrada::teste();


    // constructor
    class Carro{
        public $modelo;
        public $cor;
        function __construct($modelo, $cor) {
            $this->modelo = $modelo;
            $this->cor = $cor;
        }
    }

    $byd_2 = new Carro('BYD 2026', 'AZUL');
   echo  $byd_2->modelo.'<br>';


    $anonyma = new class(){
        public $nome = 'WellPertter';
        function GetOi(){
            echo  'oi<br>';
        }
    };

    $anonyma->GetOi();

    if (class_exists("Carro")){
        echo 'A classe carro existe';
    } else {
        echo 'A classe carro não existe';
    }
       echo '<br>';
     print_r( get_class_methods("Carro"));
     echo '<br>';
     print_r( get_class_vars("Carro"));
   echo '<br>';



    // objetos
    if (is_object($anonyma)){
        echo 'É um objeto';
    } else {
        echo 'Não é um objeto';
    }
    echo '<br>';
     echo get_class($byd_2);
     echo '<br>';
     print_r(method_exists($anonyma, 'GetOi'));
   echo '<br>';


// $Prof= new Profissional;
  //  $Arthur->profissao = 'Dev Desktop';
   // echo $Arthur->profissao.'<br>';

 //   $Prof->setProfisscao($Arthur);
   // echo $Arthur->profissao.'<br>';

?>
<?php

// Definition des fonctions

class Dice {
    public $face;
    public $nbjets;
    public $seuilrel;
    public $kept;

    // Le constructeur prendra en compte les valeurs n m k via une méthode POST
    function __construct($n, $m, $k){
        $this->nbjets = $n;
        $this->seuilrel = $m;
        $this->kept = $k;    }

    // Getters and Setters
  //  function setDice($n, $m, $k){
        //$this->nbjets = $n;
        //$this->seuilrel = $m;
        //$this->kept = $k;
   // }

    function getJets(){
        return $this->nbjets;
    }
    function getRel(){
        return $this->seuilrel;
    }
    function getKept(){
        return $this->kept;
    }

    // Méthode du jet de dés
    function playDice(){
        $n = $this->nbjets;
        $m = $this->seuilrel;
        $i = 0;
        echo $i."<br>".$n."<br>".$m."<br>";
        for ($i; $i <= $n; $i++){
            $f = rand(1,10);
            if ($f >= $m){
                $f += rand(1,10);
            }
            echo $i." <-Index . Value -> ".$f.'<br>';
        }
    }
}

// Tester un lancé

$jet1 = new Dice(10,5,2);
echo $jet1->playDice();

?>
<?php

// Definition des fonctions

class Dice
{
    public $face;
    public $nbjets;
    public $seuilrel;
    public $kept;

    // Le constructeur prendra en compte les valeurs n m k via une méthode POST
    function __construct( $n, $m, $k )
    {
        $this->nbjets = $n;
        $this->seuilrel = $m;
        $this->kept = $k;
    }

    // Getters and Setters
    function getJets()
    {
        return $this->nbjets;
    }

    function getRel()
    {
        return $this->seuilrel;
    }

    function getKept()
    {
        return $this->kept;
    }

    // Méthode du jet de dés
    function playDice()
    {
        $n = $this->nbjets;
        $m = $this->seuilrel;
        $k = $this->kept;
        $i = 1;
        $brutvalue = 0;
        $montant = array();
        //debug
        echo 'Valeur i='.$i . "<br>" . 'Valeur Jets='.$n . "<br>" . 'Valeur Relance='.$m . "<br>". 'Valeur Conserve='.$k . "<br><br>";
        for ( $i; $i <= $n; $i++ ) {
            $f = rand ( 1, 10 );
            // Debug
            echo 'valeur sf base: '.$f.' - ';
            $val += $f;
            while ( $f >= $m ) {
                $f = rand ( 1, 10 );
                //debug
                echo '/'.$f.'/';
                $val += $f;
                $f = 0;
            }
            array_push ( $montant, $val );
            //debug
            echo $i . " <-Index . Value -> " . $val . '<br>';
            $val = 0;
        }
        rsort ( $montant );
        echo '<br>';
        //debug
        print_r ($montant);
        echo '<br>';
        echo '<br>';
        for ($x=0;$x < $k;$x++) {
            $brutvalue += $montant[$x];
        }
        //debug
        echo 'Valeur ktotale : '.$brutvalue;
    }

}

// Tester un lancé

$jet1 = new Dice( 10, 5, 3 );
echo $jet1->playDice ();

?>
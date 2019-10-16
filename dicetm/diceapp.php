<?php

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
        // echo 'Valeur i='.$i . "<br>" . 'Valeur Jets='.$n . "<br>" . 'Valeur Relance='.$m . "<br>". 'Valeur Conserve='.$k . "<br><br>";
        for ( $i; $i <= $n; $i++ ) {
            $f = rand ( 1, 10 );
            //debug
            // echo 'valeur sf base: '.$f.' - ';
            $val += $f;
            while ( $f >= $m ) {
                $f = 0;
                $f = rand ( 1, 10 );
                //debug
                // echo '/'.$f.'/';
                $val += $f;
            }
            array_push ( $montant, $val );
            //debug
            // echo "/  Index :". $i . "// Value -> " . $val . '<br>';
            $val = 0;
        }
        rsort ( $montant );
        //echo '<br>';
        //debug
        // print_r ($montant);
        //echo '<br>';
        //echo '<br>';
        for ($x=0;$x < $k;$x++) {
            $brutvalue += $montant[$x];
        }
        //debug
        // echo 'Valeur ktotale :';
        // echo $brutvalue;
        return $brutvalue;
    }
}

// Jouer les probabilités approximatives

$gJets = 100000;
$results = [];
for($i = 1; $i < $gJets; ++$i){
    $jet[$i] = new Dice(6,6,3);
    $y = $jet[$i]->playDice();
    array_push ($results,$y);
}

// Probabilité des occurrences pour n nombre

$compteur = array_count_values ($results);
ksort ($compteur);
$tojson = [];
foreach($compteur as $khey => $valou){
    array_push ($tojson,['['.$khey.','.$valou.']']);
}
//print_r ($tojson);
// Conversion pour le json
$cleanjson1 = [];
foreach ($tojson as $kle => $kval){
    foreach ($kval as $skle => $sval){
        array_push ($cleanjson1,$sval);
    }
}
//echo 'Données stastiques des prévisions approximatives pour les occurences de n jusqua n+x :<br><br>';
//print_r ($cleanjson1);
//print_r (json_encode ($cleanjson1, JSON_FORCE_OBJECT, JSON_PRETTY_PRINT));

//$cleanjson1 = array_values ($compteur);
//$graph1json = json_encode ($compteur,JSON_FORCE_OBJECT);
//print_r ($graph1json);

//debug
//foreach ($compteur as $indx => $val){
//    echo '['.$indx.','.$val.'],<br>';
//}

//--------------------------------------------------

// Probabilité pour qu'une occurrence sois > n nombre

$nprob = [];
$nfirst = array_key_first ($compteur);
$nlast = array_key_last ($compteur);
for ($z = 0; $z < $nlast; ++$z){
    $sd = 0;
    foreach ($compteur as $nomb => $occur){
        if ($nomb < $z) {
            $sd+= 0;
        } else {
            $sd += $occur;
        }
    }
    if ($z < $nfirst){
        $nperc = 100;
    } else {
        $nperc = ( $sd / $gJets ) * 100;
    }
    array_push ($nprob, $nperc);
}

// Conversion pour le json

$cleanjson2 = [];
foreach ($nprob as $thenum => $theperc){
    array_push ($cleanjson2,'['.$thenum.','.$theperc.']');
}
json_encode ($cleanjson2, JSON_FORCE_OBJECT, JSON_PRETTY_PRINT);
//echo '<br><br>Données stastiques des prévisions approximatives pour les probabilités que r soit > n :<br><br>';
//print_r ($cleanjson2);
//print_r (json_encode ($cleanjson2, JSON_FORCE_OBJECT, JSON_PRETTY_PRINT));

//--------------------------------------------------

?>
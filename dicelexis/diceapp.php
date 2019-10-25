<?php

class Dice
{
    public $nbjets;
    public $seuilrel;
    public $kept;

    function __construct($n,$m,$k)
    {
        $this -> nbjets = $n;
        $this -> seuilrel = $m;
        $this -> kept = $k;
    }

    function playDice()
    {
        $n = $this -> nbjets;
        $m = $this -> seuilrel;
        $k = $this -> kept;
        $i = 1;
        $val = 0;
        $brutvalue = 0;
        $montant = array();
        for ($i; $i <= $n; $i++) {
            $f = rand(1,10);
            $val += $f;
            while ($f >= $m) {
                $f = rand(1,10);
                $val += $f;
            }
            array_push($montant,$val);
            $val = 0;
        }
        rsort($montant);
        for ($x = 0; $x < $k; $x++) {
            $brutvalue += $montant[ $x ];
        }
        return $brutvalue;
    }
}

if ($_POST[ 'nbDices' ]) {
    if ($_POST[ 'keep' ]) {
        if ($_POST[ 'reroll' ]) {

            $vnbdice =  (int)$_POST[ 'nbDices' ];
            $vkeep = (int)$_POST[ 'keep' ];
            $vreroll = (int)$_POST[ 'reroll' ];

            $gJets = 100000;
            $results = [];
            for ($i = 1; $i < $gJets; ++$i) {
                $jet[ $i ] = new Dice($vnbdice,$vreroll,$vkeep);
                $y = $jet[ $i ] -> playDice();
                array_push($results,$y);
            }

            $compteur = array_count_values($results);
            ksort($compteur);
            $tojson = [];
            foreach ($compteur as $khey => $valou) {
                array_push($tojson,['[' . $khey . ',' . $valou . ']']);
            }

            $cleanjson1 = [];
            foreach ($tojson as $kle => $kval) {
                foreach ($kval as $skle => $sval) {
                    array_push($cleanjson1,$sval);
                }
            }

            $nprob = [];
            $nfirst = array_key_first($compteur);
            $nlast = array_key_last($compteur);
            for ($z = 0; $z < $nlast; ++$z) {
                $sd = 0;
                foreach ($compteur as $nomb => $occur) {
                    if ($nomb < $z) {
                        $sd += 0;
                    } else {
                        $sd += $occur;
                    }
                }
                if ($z < $nfirst) {
                    $nperc = 100;
                } else {
                    $nperc = ($sd / $gJets) * 100;
                }
                array_push($nprob,$nperc);
            }


            $cleanjson2 = [];
            foreach ($nprob as $thenum => $theperc) {
                array_push($cleanjson2,'[' . $thenum . ',' . $theperc . ']');
            }
            json_encode($cleanjson2,JSON_FORCE_OBJECT,JSON_PRETTY_PRINT);
        }
    }
}

?>
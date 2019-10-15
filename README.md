Utilisation de Google Charts avec de la Back-End PHP pour display des probabilités au lancer de dés Keep&Roll
---------------------
Source : https://richie.u-strasbg.fr/~virgile/sf4/public/index.php/cours/poo/dices
---------------------
Ressources:
- PHP (POO) : https://www.php.net/manual/en/language.oop5.php
- Google Charts : https://developers.google.com/chart/
- Jquery AJAX : https://api.jquery.com/jquery.ajax/
- Javascript minime
- Mise en page html
- CSS Facultatif
---------------------
Outcome : https://teva.re/diceview
---------------------------------------------------------------------------------------------------------

Tâches à réaliser (non définitives):

- HTML:
   - Mise en page classique avec template PHP
   - Inclure les scripts nécessaires
   
- CSS :
   - Facultatif 
   
- Javascript :
   - Inclure les scripts des graphiques après les divs results
   - Permettre au nom du graphique de changer en fonction de la fonction
   - Rajouter un AJAX call avant l'appel de la fonction tableau (Jquery AJAX)
   
- PHP/HTML:
   - Form avec méthode post qui enverra en back-end les valeurs du nombre de jets, seuil de relance et valeurs conservées
   
- PHP:
   - Créer une classe Global Dice
   - Définir les variables de classe (nombre de faces?, nombre de jets, seuil de relance, valeurs conservées)
   - Définir un constructeur de classe avec les variables ci-dessus qu'on nommera ($n, $m, $k)
   - Definir des Getters et Setters ?
   - Définir une condition if isset$POST pour appeller la fonction à l'envoi du formulaire
   - Définir une fonction Gamble() qui représentera la fonction appellée pour chaque objet 
      - La fonction prendra un object Dice() et utilisera les valeurs ci-dessus
      - on utilisera une variable $i = 0 qui reset a chaque appel de la fonction
      - on utilisera une boucle for(i = 0; i <= nombre de jets; i++)
      - pour chaque jet de dé = fonction random(1,10)
      - retourner la valeur de jet[i] pour le dé
      - Si la valeur du random => à $m le seuil de relance on relance un dé
      - créer un array contenant les résultats des lancers 
      - Trier les résultats de grand à petit https://stackoverflow.com/questions/27791312/sorting-integer-value-in-php
      - Conserver les x plus grands définis par $k == valeurs conservées(1<)
      - Additionner les valeurs et retourner le résultats tel que "dice[i]" = "résultat";
   - Appeller la fonction pour un nombre de 1000 , 10 000 ou 100 000 dés jetés
   - Créer un array pour chaque résultat de dé sous la forme:
      - array {
              1 { dice[i] = "résultat" }
              2 { ... }
              }
   - Créer une fonction json_encode qui transformera l'array en json
   - Renvoyer le json vers la vue principale qui la décodera dans le js de l'api google
 

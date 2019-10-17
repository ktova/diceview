<?php require_once('template.php') ?> 

<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> Dice Views </title>
        <meta name="Meteotm" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
        <script src="https://kit.fontawesome.com/0d2059c859.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>

    <div class="form-container">
        <h1>Simulation</h1>
    <form id="diceap" name="diceap" method="post">
            <label for="nbDices">Dés jetés: &nbsp;</label><select name="nbDices" id="nbDices">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select><br>
            <label for="keep">Dés gardés: &nbsp;</label><select name="keep" id="keep">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select><br>
        <label for="reroll">Relance: &nbsp;</label><select name="reroll" id="reroll">
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select><br><br>
        <input type="submit" value="Simulation" data-bcup-haslogintext="no"/>
    </form>
    </div>

<?php include 'diceapp.php' ?>
<div id="results1"></div>
<script type="text/javascript"
        src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
<script type="text/javascript">
    // Load the Visualization API
    google.load('visualization', '1', {
        packages: ['corechart']
    });
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Résultat du jet');
        data.addColumn('number', 'Occurences');
        data.addRows([
            <?php
                foreach ($cleanjson1 as $key => $value){
                    echo $value.',';
                }
            ?>
        ]);
        var options = {
            width : '100%',
            height : 563,
            hAxis : {
                title : '<?php echo "Relance du jet: ".$vnbdice."g".$vkeep." avec relance à ".$vreroll." sur 100 000 jets"; ?>'
            },
            vAxis: {
                title: 'Occurences'
            }
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('results1'));
        chart.draw(data, options);
    }
</script>

<div id="results2"></div>
<script type="text/javascript"
        src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1','packages':['corechart']}]}"></script>
<script type="text/javascript">
    // Load the Visualization API
    google.load('visualization', '1', {
        packages: ['corechart']
    });
    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Résultat du jet');
        data.addColumn('number', 'Occurences');
        data.addRows([
            <?php
            foreach ($cleanjson2 as $key => $value){
                echo $value.',';
            }
            ?>
        ]);
        var options = {
            width : '100%',
            height : 563,
            hAxis : {
                title : '<?php echo "Relance du jet: ".$vnbdice."g".$vkeep." avec relance à ".$vreroll." sur 100 000 jets"; ?>'
            },
            vAxis: {
                title: "Probabilité d'obtenir un total >= n"
            }
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('results2'));
        chart.draw(data, options);
    }
</script>

</body>
</html>

<?php echo($footer) ?>
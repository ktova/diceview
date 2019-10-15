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
<?php include 'diceapp.php' ?>
<div id="results"></div>
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
        // Ajax php returned json data
        var jsonData = $.ajax({
            url: "getData.php",
            dataType: "json",
            async: false
        }).responseText;

        // Create our data table out of JSON data loaded from server.
        var data = new google.visualization.DataTable();
        data.addColumn('number', 'Résultat du jet');
        data.addColumn('number', 'Occurences');
        data.addRows([
            // Insérer les données ici
            // Sous la forme
            [18,1],
            [20,4],
            [18,1],
            [20,4],
            [18,1],
            [20,4],
            [21,1]
            // etc
        ]);
        var options = {
            width : 900,
            height : 563,
            hAxis : {
                title : "Titre du Graphique"
            },
            vAxis: {
                title: 'Occurences'
            }
        };
        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('results'));
        chart.draw(data, options);
    }
</script>

</body>
</html>

<?php echo($footer) ?>
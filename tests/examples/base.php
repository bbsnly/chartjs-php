<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Base - ChartJS PHP</title>
</head>
<body>
<canvas id="myChart" width="400" height="400"></canvas>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"
        integrity="sha256-SiHXR50l06UwJvHhFY4e5vzwq75vEHH+8fFNpkXePr0=" crossorigin="anonymous"></script>

<script>
    var ctx = document.getElementById("myChart").getContext("2d");

    var myChart = new Chart(ctx, <?php echo $myChart ?>);
</script>
</body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sd208";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// Modify the SQL query to filter data for Male and Female only
$sql = "SELECT gender, COUNT(*) as count FROM users WHERE gender IN ('Male', 'Female') GROUP BY gender";
$result = $conn->query($sql);

$gender_data = array();
while ($row = $result->fetch_assoc()) {
    $gender_data[] = $row;
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Gender Pie Chart</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Gender');
            data.addColumn('number', 'Count');

            <?php
            foreach ($gender_data as $gender_row) {
                echo "data.addRow(['" . $gender_row['gender'] . "', " . $gender_row['count'] . "]);";
            }
            ?>

            var options = {
                title: 'Gender Distribution'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <h1>Gender Pie Chart</h1>
    <div id="piechart" style="width: 500px; height: 300px;"></div>
</body>
</html>

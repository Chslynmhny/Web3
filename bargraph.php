<!DOCTYPE >
<html>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Activities');

            <?php
            // Replace this with your actual database connection code
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "sd208";

            // Create a connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to retrieve activity counts for each month
            $sql = "SELECT MONTH(Date) AS Month, COUNT(*) AS ActivityCount
                    FROM Activities
                    GROUP BY MONTH(Date)
                    ORDER BY Month";

            $result = $conn->query($sql);

            while($row = $result->fetch_assoc()) {
                echo "data.addRow(['Month " . $row['Month'] . "', " . $row['ActivityCount'] . "]);\n";
            }

            $conn->close();
            ?>
            
            var options = {
                title: 'Activities per Month',
                hAxis: {
                    title: 'Month'
                },
                vAxis: {
                    title: 'Number of Activities'
                },
                bars: 'vertical'
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
    
</head>
<body>
    <div id="chart_div" style="width: 800px; height: 400px;"></div>
</body>
</html>

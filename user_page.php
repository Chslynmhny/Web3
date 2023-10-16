<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>sbs</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="user.css">
    
</head>
<body class="main-layout">
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#"/></div>
    </div>
    <div class="header">
        <div class="container-fluid">
            <div class="row d_flex">
                <div class="col-md-2 col-sm-3 col logo_section">
                    <div class="full">
                        <div class="center-desk">
                            <div class="logo">
                                <a href="index.html"><img src="images/logo.png" alt="#" /></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12">
                    <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="user_page.php">Home</a>
                                </li>
                               
                                <li class="nav-item">
                                    <a class="nav-link" href="logout.php">Log Out</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-md-2">
                    <ul class="email text_align_right">
                        <li class="d_none"><a href="Javascript:void(0)"><i class="fa fa-user" aria-hidden="true"></i></a></li>
                        <li class="d_none"> <a href="Javascript:void(0)"><i class="fa fa-search" style="cursor: pointer;" aria-hidden="true"></i></a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <br><br><br><br><br><br><br>
<body>

 <!-- Form for adding a new activity -->
    <div class="form-container">
        <form method="post">
            <h2>Add New Activity</h2>
            <label for="activity_name">Activity Name:</label>
            <input type="text" name="activity_name" required><br>

            <label for="activity_date">Date:</label>
            <input type="date" name="activity_date" required><br>

            <label for="activity_time">Time:</label>
            <input type="time" name="activity_time"><br>

            <label for="activity_location">Location:</label>
            <input type="text" name="activity_location"><br>

            <label for="activity_ootd">Outfit of the Day:</label>
            <input type="text" name="activity_ootd"><br>

            <input type="submit" name="add_activity" value="Add Activity">
        </form>
    </div>
    <div class="container">

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "sd208";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_POST['add_activity'])) {
                $name = $_POST['activity_name'];
                $date = $_POST['activity_date'];
                $time = $_POST['activity_time'];
                $location = $_POST['activity_location'];
                $ootd = $_POST['activity_ootd'];

                $sql = "INSERT INTO activities (Name, Date, Time, Location, OOTD) VALUES ('$name', '$date', '$time', '$location', '$ootd')";
                if ($conn->query($sql) === true) {
                    echo "Activity added successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // Function to set activity status (Cancel, Done, Remarks)
            if (isset($_POST['set_status'])) {
                $activity_id = $_POST['activity_id'];
                $status = $_POST['activity_status'];

                $sql = "UPDATE activities SET Status = '$status' WHERE ActivityID = $activity_id";
                if ($conn->query($sql) === true) {
                    echo "Activity status updated successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // Function to fetch and display activities in ascending order by date
            $sql = "SELECT * FROM activities ORDER BY Date ASC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h2>Activities</h2>";
                echo "<table border='1'>";
                echo "<tr><th>Name</th><th>Date</th><th>Time</th><th>Location</th><th>Outfit of the Day</th><th>Status</th><th>Actions</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    $activity_id = $row['ActivityID'];
                    $status = $row['Status'];

                    echo "<tr>";
                    echo "<td>" . $row['Name'] . "</td>";
                    echo "<td>" . $row['Date'] . "</td>";
                    echo "<td>" . $row['Time'] . "</td>";
                    echo "<td>" . $row['Location'] . "</td>";
                    echo "<td>" . $row['OOTD'] . "</td>";
                    echo "<td>" . $status . "</td>";
                    echo "<td><form method='post'>
                    <input type='hidden' name='activity_id' value='$activity_id'>
                    <select name='activity_status'>
                        <option value='Cancel'>Cancel</option>
                        <option value='Done'>Done</option>
                        <option value='Remarks'>Remarks</option>
                    </select>
                    <input type='submit' name='set_status' value='Set Status' class='input1'>
                    <input type='submit' name='edit_activity' value='Edit' class='input1'>
                </form></td>";
                }

                echo "</table>";
            } else {
                echo "No activities found.";
            }

            if (isset($_POST['edit_activity'])) {
                $activity_id = $_POST['activity_id'];
                // Retrieve the existing activity information from the database
                $sql = "SELECT * FROM activities WHERE ActivityID = $activity_id";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    // Display a form to edit the activity details
                    echo "<h2>Edit Activity</h2>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='activity_id' value='$activity_id'>";
                    echo "<label for='activity_name'>Activity Name:</label>";
                    echo "<input type='text' name='activity_name' value='" . $row['Name'] . "' required><br>";
                    echo "<label for='activity_date'>Date:</label>";
                    echo "<input type='date' name='activity_date' value='" . $row['Date'] . "' required><br>";
                    echo "<label for='activity_time'>Time:</label>";
                    echo "<input type='time' name='activity_time' value='" . $row['Time'] . "'><br>";
                    echo "<label for='activity_location'>Location:</label>";
                    echo "<input type='text' name='activity_location' value='" . $row['Location'] . "'><br>";
                    echo "<label for='activity_ootd'>Outfit of the Day:</label>";
                    echo "<input type='text' name='activity_ootd' value='" . $row['OOTD'] . "'><br>";
                    echo "<input type='submit' name='update_activity' value='Update Activity'>";
                    echo "</form>";
                }
            }
            
            if (isset($_POST['update_activity'])) {
                $activity_id = $_POST['activity_id'];
                $name = $_POST['activity_name'];
                $date = $_POST['activity_date'];
                $time = $_POST['activity_time'];
                $location = $_POST['activity_location'];
                $ootd = $_POST['activity_ootd'];

                $sql = "UPDATE activities 
                        SET Name = '$name', Date = '$date', Time = '$time', Location = '$location', OOTD = '$ootd'
                        WHERE ActivityID = $activity_id";
                
                if ($conn->query($sql) === true) {
                    echo "Activity updated successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }


            $conn->close();
        ?>

    </div>
</body>
</html>


<?php include_once("include/footer.php") ?>
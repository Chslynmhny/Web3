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
    <link rel="stylesheet" href="adminstyle.css">
    
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
                                    <a class="nav-link" href="admin_page.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="users.php">Manage Users</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="pie.php">Pie Chart</a>
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

    <br><br><br><br>
    <hr class="bold-hr">


       <!-- Announcement -->
        <div class="announcement-form">
                <form method="post">
                <h2>Create a New Announcement:</h2><br>
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required><br><br>
                    <label for="content">Content:</label><br>
                    <textarea id="content" name="content" rows="4" required></textarea><br><br>
                    <input type="submit" name="create" value="Create Announcement">
                </form>
        </div>
     <div class="box">
    <?php
   
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "sd208";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Query to fetch user data from the database
            $sql_users = "SELECT * FROM users";
            $result_users = mysqli_query($conn, $sql_users);
            if (!$result_users) {
                die("User data query failed: " . mysqli_error($conn));
            }

            // Query to fetch gender data from the database for the pie chart
            $sql_gender = "SELECT gender, COUNT(*) as count FROM users WHERE gender IN ('Male', 'Female') GROUP BY gender";
            $result_gender = $conn->query($sql_gender);

            $gender_data = array();
            while ($row = $result_gender->fetch_assoc()) {
                $gender_data[] = $row;
            }

            if (isset($_POST['create'])) {
                $title = $_POST['title'];
                $content = $_POST['content'];
        
                $sql = "INSERT INTO Announcements (Title, Content) VALUES ('$title', '$content')";
        
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Announcement created successfully.');</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            $sql = "SELECT AnnouncementID, Title, Content, DatePosted FROM Announcements ORDER BY DatePosted DESC";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                echo "<h2>Announ<span>cements:</span></h2>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='announcement-sub'>";
                    echo "<div class='announcement'>";                  
                    echo "<h3>" . $row['Title'] . "</h3>";
                    echo "<p>" . $row['Content'] . "</p>";
                    echo "<p>Date Posted: " . $row['DatePosted'] . "</p>";
                    echo "<a href='edit_announcement.php?id=" . $row['AnnouncementID'] . "'>Edit</a> | ";
                    echo "<a href='delete_announcement.php?id=" . $row['AnnouncementID'] . "'>Delete</a><br><br>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "No announcements yet.";
            }
        ?>
</div><br><br>
<hr class="bold-hr">
<br><br>
        <div class="pie">
         <h1>Gender Pie Chart</h1>
         <div id="piechart"></div>
        </div>
        <br><br>
        <hr class="bold-hr">
        <br><br>
    </div>
        <div class="container">
        <h1>Show All<span> Users</span></h1><br>
        <table class="mytable">
            <thead>
                <tr>
                    <th>FullName</th>
                    <th>Username</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Role</th>
                    <th>Age</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result_users)) { ?>
                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['gender'] ?></td>
                        <td><?php echo $row['dob'] ?></td>
                        <td><?php echo $row['role'] ?></td>
                        <td><?php echo $row['age'] ?></td>
                        <td>
                            <button class="action-button" onclick="openEditModal('<?php echo $row['id'] ?>')">Edit</button>
                            <button class="action-button" onclick="openDeleteModal('<?php echo $row['id'] ?>')">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<br><br>
<hr class="bold-hr">
<br><br>
    <!-- Edit User Modal -->
    
    <div id="editUserModal" class="modal">
        <div class="modal-content">
            <h2>Edit User</h2>
            <form method="POST" action="edit_user.php">
                <input type="hidden" id="editUserId" name="editUserId"> <!-- Hidden field to store the user's ID -->
                
                <label for="editFullname">Full Name:</label><br>
                <input type="text" id="editFullname" name="editFullname" placeholder="Full Name" required><br>
                
                <label for="editUsername">Username:</label><br>
                <input type="text" id="editUsername" name="editUsername" placeholder="Username" required><br>
                
                <label for="editGender">Gender:</label><br>
                <select id="editGender" name="editGender"required><br>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select><br>
                
                <label for="editDob">Date of Birth:</label><br>
                <input type="date" id="editDob" name="editDob"><br>
                
                <label for="editRole">Role:</label><br>
                <input type="text" id="editRole" name="editRole" placeholder="Role" required><br>
                
                <label for="editAge">Age:</label><br>
                <input type="number" id="editAge" name="editAge" placeholder="Age" required><br>
                
                <button type="submit">Save Changes</button>
                <button type="button" onclick="closeEditModal()">Cancel</button>
            </form>
        </div>
    </div>


    <!-- Delete User Modal -->
    
    <div id="deleteUserModal" class="modal">
        <div class="modal-delete">
            <h2>Delete User</h2>
            <form method="POST" action="delete_user.php"><br>
                <input type="hidden" id="deleteUserId" name="deleteUserId"> <!-- Hidden field to store the user's ID -->
                <p>Are you sure you want to delete this user?</p><br>
                <button type="submit">Delete User</button>
                <button type="button" onclick="closeDeleteModal()">Cancel</button>
            </form>
        </div>
    </div>
 <br>
    <div id="chart_div"></div>

    <script>
        function openEditModal(userId) {
            
            document.getElementById('editUserId').value = userId;
            document.getElementById('editUserModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editUserModal').style.display = 'none';
        }

        function openDeleteModal(userId) {
    
            document.getElementById('deleteUserId').value = userId;
            document.getElementById('deleteUserModal').style.display = 'block';
        }

        function closeDeleteModal() {
            document.getElementById('deleteUserModal').style.display = 'none';
        }
            function openAddUserModal() {
            document.getElementById('addUserModal').style.display = 'block';
        }
        function closeAddUserModal() {
            document.getElementById('addUserModal').style.display = 'none';
        }
    </script>

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
            title: 'Gender Distribution',

            };


            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
   </script>
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
</body>

</html>

<?php include_once("include/footer.php") ?>

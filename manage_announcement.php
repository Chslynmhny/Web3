<!DOCTYPE html>
<html>
<head>
    <title>Announcement Management</title>
</head>
<body>
    <h1>Announcement Management</h1>
    <?php
    // Database connection parameters
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

    // Create a new announcement
    if (isset($_POST['create'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];

        $sql = "INSERT INTO Announcements (Title, Content) VALUES ('$title', '$content')";

        if ($conn->query($sql) === TRUE) {
            echo "Announcement created successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Retrieve and display announcements
    $sql = "SELECT AnnouncementID, Title, Content, DatePosted FROM Announcements ORDER BY DatePosted DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Announcements:</h2>";
        while ($row = $result->fetch_assoc()) {
            echo "<h3>" . $row['Title'] . "</h3>";
            echo "<p>" . $row['Content'] . "</p>";
            echo "<p>Date Posted: " . $row['DatePosted'] . "</p>";
            echo "<a href='edit_announcement.php?id=" . $row['AnnouncementID'] . "'>Edit</a> | ";
            echo "<a href='delete_announcement.php?id=" . $row['AnnouncementID'] . "'>Delete</a><br><br>";
        }
    } else {
        echo "No announcements yet.";
    }

    

    $conn->close();
    ?>

    
    <form method="post">
    <h2>Create a New Announcement:</h2>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="4" required></textarea><br><br>
        <input type="submit" name="create" value="Create Announcement">
    </form>
</body>
</html>

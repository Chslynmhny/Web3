<!DOCTYPE html>
<html>
<head>
    <title>Edit Announcement</title>
</head>
<body>
    <h1>Edit Announcement</h1>
    
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

    if (isset($_POST['update'])) {
        $announcementID = $_POST['announcement_id'];
        $title = $_POST['title'];
        $content = $_POST['content'];

        $sql = "UPDATE Announcements SET Title='$title', Content='$content' WHERE AnnouncementID='$announcementID'";

        if ($conn->query($sql) === TRUE) {
            header("Location: Admin_page.php");
        } else {
            echo "Error updating announcement: " . $conn->error;
        }
    }

    if (isset($_GET['id'])) {
        $announcementID = $_GET['id'];

        $sql = "SELECT AnnouncementID, Title, Content FROM Announcements WHERE AnnouncementID='$announcementID'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
    ?>
    <form method="post">
        <input type="hidden" name="announcement_id" value="<?php echo $row['AnnouncementID']; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $row['Title']; ?>" required><br><br>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="4" required><?php echo $row['Content']; ?></textarea><br><br>
        <input type="submit" name="update" value="Update Announcement">
    </form>
    <?php
        } else {
            echo "Announcement not found.";
        }
    }

    $conn->close();
    ?>
</body>
</html>

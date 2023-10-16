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

if (isset($_GET['id'])) {
    $announcementID = $_GET['id'];

    $sql = "DELETE FROM Announcements WHERE AnnouncementID='$announcementID'";

    if ($conn->query($sql) === TRUE) {
        header("Location: Admin_page.php");
    } else {
        echo "Error deleting announcement: " . $conn->error;
    }
}

$conn->close();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sd208";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user ID from the form
    $deleteUserId = $_POST['deleteUserId'];

    // Perform the database delete operation
    $sql = "DELETE FROM users WHERE id='$deleteUserId'";

    if (mysqli_query($conn, $sql)) {
        // Deletion successful
        header("Location: users.php"); // Redirect back to the user list page
    } else {
        echo "Error deleting user: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

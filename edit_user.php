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
    $editUserId = $_POST['editUserId'];

    // Retrieve form data
    $editFullname = mysqli_real_escape_string($conn, $_POST['editFullname']);
    $editUsername = mysqli_real_escape_string($conn, $_POST['editUsername']);
    $editGender = mysqli_real_escape_string($conn, $_POST['editGender']);
    $editDob = mysqli_real_escape_string($conn, $_POST['editDob']);
    $editRole = mysqli_real_escape_string($conn, $_POST['editRole']);
    $editAge = mysqli_real_escape_string($conn, $_POST['editAge']);

    // Perform the database update
    $sql = "UPDATE user SET 
    name='$editFullname', 
    username='$editUsername', 
    gender='$editGender', 
    dob='$editDob', 
    role='$editRole', 
    age='$editAge' 
    WHERE id='$editUserId'";


    if (mysqli_query($conn, $sql)) {
        // Update successful
        header("Location: users.php"); // Redirect back to the user list page
    } else {
        echo "Error updating user: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


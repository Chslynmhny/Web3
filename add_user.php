<?php
// Ensure that the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sd208";

    // Create a database connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $fullname = $_POST["fullname"];
    $username = $_POST["username"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    $role = $_POST["role"];
   
    $age = $_POST["age"];

    // Perform database insertion
    $sql = "INSERT INTO user (name, username, gender, dob, role, age) VALUES ('$fullname', '$username', '$gender', '$dob', '$role', '$age')";

    if (mysqli_query($conn, $sql)) {
        // User added successfully
        header("Location: users.php"); // Redirect to the user management page
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }


    // Close the database connection
    mysqli_close($conn);
}
?>

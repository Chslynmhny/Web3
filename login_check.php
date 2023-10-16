<?php
session_start(); // Start the session
include_once("include/DBUtil.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $conn = getConnection();

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Password is correct, set the user's role in the session
        $_SESSION["role"] = $row["role"];

        if ($row["role"] == "user") {
            header("Location: user_page.php");
            exit();
        } elseif ($row["role"] == "admin") {
            header("Location: admin_page.php");
            exit();
        } else {
            // Handle other roles or cases here
            header("Location: other_page.php");
            exit();
        }
    } else {
        // Handle the case when no user was found with the provided username
        header("Location: login_error.php");
        exit();
    }

    // Close the database connection
    closeConnection($conn);
}
?>


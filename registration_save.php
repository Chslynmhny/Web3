<?php
include_once("include/DBUtil.php");

$name = $_POST["name"];
$username = $_POST["username"];
$password = $_POST["password"];
$gender = $_POST["gender"];
$dob = $_POST["dob"];

// Calculate age based on Date of Birth
$dobDate = new DateTime($dob);
$currentDate = new DateTime();
$age = $currentDate->diff($dobDate)->y;

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);



$conn = getConnection();

$stmt = $conn->prepare("INSERT INTO users (name, username, password, gender, dob, role, age) VALUES (?, ?, ?, ?, ?, 'user', ?)");
$stmt->bind_param("sssssi", $name, $username, $hashedPassword, $gender, $dob, $age);


if ($stmt->execute()) {
  
    header("Location: login.php");
    exit; 
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
closeConnection($conn);
?>

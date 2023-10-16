<?php
session_start(); // Start the session if not already started

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirect to the login page or any other desired page
header("Location: login.php"); // Change 'login.php' to your desired destination
exit();
?>

<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or home page
    header("Location: login.php"); // Change this to your login page URL
    exit();
} else {
    // If the user is not logged in, redirect to the home page
    header("Location: login.html"); // Change this to your desired page
    exit();
}
?>

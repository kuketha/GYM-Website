<?php
$servername = "localhost";
$username = "root"; // Default username for WAMP
$password = ""; // Default password for WAMP
$dbname = "gym";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

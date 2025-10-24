<?php
session_start();
$conn = new mysqli("localhost", "root", "", "gym");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM stafflog WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION['staff_id'] = $username;
        header("Location: staff_panel.html");
    } else {
        echo "<p style='color:red; text-align:center;'>Invalid username or password</p>";
    }
}

$conn->close();
?>

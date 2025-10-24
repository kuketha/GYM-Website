<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'gym');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$age = $_POST['age'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];

// Insert new user into database
$sql = "INSERT INTO reg (name, age, email, phone, address) VALUES ('$name', '$age', '$email', '$phone', '$address')";
if ($conn->query($sql) === TRUE) {
    echo "User added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

// Redirect back to manage_users.php
header("Location: manage_users.php");
exit;
?>

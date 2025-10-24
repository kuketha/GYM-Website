<?php
$conn = new mysqli('localhost', 'root', '', 'gym');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$type = $_POST['type'];

$sql = "INSERT INTO staff (name, email, phone, type) VALUES ('$name', '$email', '$phone', '$type')";
if ($conn->query($sql) === TRUE) {
    echo "New staff added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

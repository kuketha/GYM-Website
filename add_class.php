<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $classdate = $_POST['classdate'];
    $classtime = $_POST['classtime'];

    $sql = "INSERT INTO classes (name, description, classdate, classtime) VALUES ('$name', '$description', '$classdate', '$classtime')";
    $conn->query($sql);
}

$conn->close();
header("Location: manage_classes.php");
exit;
?>

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
    $class_id = $_POST['class_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $classdate = $_POST['classdate'];
    $classtime = $_POST['classtime'];

    $sql = "UPDATE classes SET name='$name', description='$description', classdate='$classdate', classtime='$classtime' WHERE id='$class_id'";
    $conn->query($sql);
}

$conn->close();
header("Location: manage_classes.php");
exit;
?>

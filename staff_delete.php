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
    $sql = "DELETE FROM classes WHERE id='$class_id'";
    $conn->query($sql);
}

$conn->close();
header("Location: manage_classes.php");
exit;
?>

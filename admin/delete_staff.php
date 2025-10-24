<?php
$conn = new mysqli('localhost', 'root', '', 'gym');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];

$sql = "DELETE FROM staff WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "Staff deleted successfully!";
} else {
    echo "Error deleting staff: " . $conn->error;
}

$conn->close();
?>

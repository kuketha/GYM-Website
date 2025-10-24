<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'gym');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user ID to delete
$id = $_POST['id'];

// Delete user from database
$sql = "DELETE FROM reg WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "User deleted successfully";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();

// Redirect back to manage_users.php
header("Location: manage_users.php");
exit;
?>

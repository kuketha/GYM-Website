<?php
// Start output buffering
ob_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "gym");
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}

// Check if an ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the membership
    $sql = "DELETE FROM membership_registration WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Membership deleted successfully!";
    } else {
        echo "Error deleting membership: " . $conn->error;
    }
} else {
    echo "No membership ID provided.";
}

// Redirect to the manage memberships page after a short delay
header("Refresh: 2; url=manage_memberships.php");
$conn->close();

// End output buffering and flush output
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Membership</title>
    <style>
        /* Basic CSS Styles */
        body { font-family: Arial, sans-serif; background-color: #f3f4f6; color: #333; margin: 0; padding: 20px; text-align: center; }
        .btn { padding: 10px 20px; background-color: #3498db; color: #fff; border: none; border-radius: 4px; cursor: pointer; margin-top: 20px; }
        .btn:hover { background-color: #2980b9; }
        .back-btn { background-color: #95a5a6; }
        .back-btn:hover { background-color: #7f8c8d; }
    </style>
</head>
<body>
    <p>
        <?php echo isset($message) ? $message : ''; ?>
    </p>
    <a href="manage_memberships.php" class="btn back-btn">Back to Manage Memberships</a>
</body>
</html>

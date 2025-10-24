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

    // Handle renewal
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $new_expiration_date = $_POST['new_expiration_date'];

        $sql = "UPDATE membership_registration SET expiration_date='$new_expiration_date' WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "Membership renewed successfully!";
            header("Refresh: 2; url=manage_memberships.php");
            exit();
        } else {
            echo "Error renewing membership: " . $conn->error;
        }
    }
} else {
    die("No membership ID provided.");
}

// End output buffering
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renew Membership - FitZone Fitness Center</title>
    <style>
        /* Basic CSS Styles */
        body { font-family: Arial, sans-serif; background-color: #f3f4f6; color: #333; margin: 0; padding: 20px; }
        .container { max-width: 400px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); }
        h1 { color: #2c3e50; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="date"] { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { padding: 10px; background-color: #3498db; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background-color: #2980b9; }
        .back-btn { padding: 10px; background-color: #95a5a6; color: #fff; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px; }
        .back-btn:hover { background-color: #7f8c8d; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Renew Membership</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="new_expiration_date">New Expiration Date</label>
                <input type="date" name="new_expiration_date" required>
            </div>
            <button type="submit" class="btn">Renew Membership</button>
            <a href="manage_memberships.php" class="back-btn">Back to Manage Memberships</a>
        </form>
    </div>
</body>
</html>

<?php $conn->close(); ?>

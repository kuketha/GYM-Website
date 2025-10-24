<?php
// Start output buffering
ob_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "gym");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle adding membership
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $membershipplan = $_POST['membershipplan'];
    $expiration_date = $_POST['expiration_date'];
    $status = $_POST['status'];

    $sql = "INSERT INTO membership_registration (fullname, email, phonenumber, membershipplan, expiration_date, status) VALUES ('$fullname', '$email', '$phonenumber', '$membershipplan', '$expiration_date', '$status')";

    if ($conn->query($sql) === TRUE) {
        echo "New membership added successfully!";
        header("Refresh: 2; url=manage_memberships.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// End output buffering and flush
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Membership - FitZone Fitness Center</title>
    <style>
        /* Basic CSS Styles */
        body { font-family: Arial, sans-serif; background-color: #f3f4f6; color: #333; margin: 0; padding: 20px; }
        .container { max-width: 500px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); }
        h1 { color: #2c3e50; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="email"], input[type="date"], input[type="tel"], select { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { padding: 10px; background-color: #3498db; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background-color: #2980b9; }
        .back-btn { background-color: #95a5a6; margin-top: 10px; }
        .back-btn:hover { background-color: #7f8c8d; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Membership</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phonenumber">Phone Number</label>
                <input type="tel" name="phonenumber" required>
            </div>
            <div class="form-group">
                <label for="membershipplan">Membership Plan</label>
                <select name="membershipplan" required>
                    <option value="Basic Plan">Basic Plan</option>
                    <option value="Premium Plan">Premium Plan</option>
                    <option value="Family Plan">Family Plan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="expiration_date">Expiration Date</label>
                <input type="date" name="expiration_date" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
            <button type="submit" class="btn">Add Membership</button>
        </form>
        <a href="manage_memberships.php" class="btn back-btn">Back to Manage Memberships</a>
    </div>
</body>
</html>

<?php $conn->close(); ?>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "gym");
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}

// Fetch all memberships
$sql = "SELECT * FROM membership_registration";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Memberships - FitZone Fitness Center</title>
    <style>
        /* Basic CSS Styles */
        body { font-family: Arial, sans-serif; background-color: #f3f4f6; color: #333; margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); }
        h1 { color: #2c3e50; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #3498db; color: #fff; }
        .btn { display: inline-block; padding: 10px; background-color: #3498db; color: #fff; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; margin-bottom: 5px; }
        .btn:hover { background-color: #2980b9; }
        .action-buttons { display: flex; flex-direction: column; gap: 5px; align-items: center; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Memberships</h1>
        <a href="add_membership.php" class="btn" style="margin-bottom: 15px;">Add Membership</a>
        <a href="send_reminders.php" class="btn" style="margin-bottom: 15px;">Send Reminders</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Membership Plan</th>
                <th>Expiration Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['fullname']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phonenumber']; ?></td>
                <td><?php echo $row['membershipplan']; ?></td>
                <td><?php echo $row['expiration_date']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td>
                    <div class="action-buttons">
                        <a href="update_membership.php?id=<?php echo $row['id']; ?>" class="btn">Update</a>
                        <a href="renew_membership.php?id=<?php echo $row['id']; ?>" class="btn">Renew</a>
                        <a href="delete_membership.php?id=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this membership?');">Delete</a>
                    </div>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>

<?php $conn->close(); ?>

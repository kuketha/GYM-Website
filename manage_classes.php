<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all classes
$sql = "SELECT * FROM classes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Classes - FitZone Fitness Center</title>
    <style>
        body { color: #333; }
        th { background-color: #3498db; color: #fff; }
        .btn { color: #fff; background-color: #3498db; }
        .btn:hover { background-color: #2980b9; }
        .back-btn { color: #fff; background-color: #7f8c8d; padding: 8px; text-decoration: none; border-radius: 4px; }
        .back-btn:hover { background-color: #95a5a6; }
    </style>
</head>
<body>
    <!-- Back Button -->
    <a href="staff_panel.html" class="back-btn">Back to Staff Panel</a>

    <h1>Manage Classes</h1>

    <!-- Add Class Form -->
    <form method="POST" action="staff_add.php">
        <input type="text" name="name" placeholder="Class Name" required>
        <input type="text" name="description" placeholder="Class Description" required>
        <input type="date" name="classdate" required>
        <input type="time" name="classtime" required>
        <button type="submit" class="btn">Add Class</button>
    </form>

    <!-- Display Classes -->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Date</th>
            <th>Time</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['classdate']; ?></td>
            <td><?php echo $row['classtime']; ?></td>
            <td>
                <form method="POST" action="staff_delete.php" style="display: inline;">
                    <input type="hidden" name="class_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn">Delete</button>
                </form>
                <form method="POST" action="staff_update.php" style="display: inline;">
                    <input type="hidden" name="class_id" value="<?php echo $row['id']; ?>">
                    <input type="text" name="name" value="<?php echo $row['name']; ?>" required>
                    <input type="text" name="description" value="<?php echo $row['description']; ?>" required>
                    <input type="date" name="classdate" value="<?php echo $row['classdate']; ?>" required>
                    <input type="time" name="classtime" value="<?php echo $row['classtime']; ?>" required>
                    <button type="submit" class="btn">Update</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
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
        body { font-family: Arial, sans-serif; background-color: #f3f4f6; padding: 20px; }
        .container { max-width: 700px; margin: 0 auto; background: #fff; padding: 20px; border-radius: 8px; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #3498db; color: #fff; }
        .btn { padding: 10px; background-color: #3498db; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background-color: #2980b9; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Manage Classes</h1>

        <!-- Add Class Form -->
        <form method="POST" action="add_class.php">
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
                    <form method="POST" action="delete_class.php" style="display: inline;">
                        <input type="hidden" name="class_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="btn">Delete</button>
                    </form>
                    <form method="POST" action="update_class.php" style="display: inline;">
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
    </div>
</body>
</html>

<?php
$conn->close();
?>

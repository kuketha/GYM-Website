<?php
// Database connection
$servername = "localhost";
$username = "root"; // Update with your database username
$password = ""; // Update with your database password
$dbname = "gym";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize search variable
$searchTerm = '';

// Check if the search form was submitted
if (isset($_POST['search'])) {
    $searchTerm = $conn->real_escape_string($_POST['searchTerm']);
    
    // Modify query to search by name, email, or phone
    $sql = "SELECT * FROM reg WHERE name LIKE '%$searchTerm%' OR email LIKE '%$searchTerm%' OR phone LIKE '%$searchTerm%'";
} else {
    // Default query to fetch all customers
    $sql = "SELECT * FROM reg";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Details - FitZone Fitness Center</title>
</head>
<body>
<a href="staff_panel.html" class="back-btn">Back to Staff Panel</a>
<div style="width: 80%; max-width: 800px; margin: 20px auto; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);">
    <h2>Customer Details</h2>
    
    <!-- Search Form -->
    <form method="POST" action="customer_details.php" style="margin-bottom: 20px;">
        <input type="text" name="searchTerm" placeholder="Search by name, email, or phone" value="<?php echo htmlspecialchars($searchTerm); ?>" required>
        <button type="submit" name="search" style="padding: 5px 10px; cursor: pointer;">Search</button>
    </form>

    <!-- Display Customer Details -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <tr>
            <th style="padding: 10px; border: 1px solid #ddd; background-color: #3498db; color: white;">ID</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Name</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Age</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Email</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Phone</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Address</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['id']; ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['name']; ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['age']; ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['email']; ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['phone']; ?></td>
                <td style="padding: 10px; border: 1px solid #ddd;"><?php echo $row['address']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>

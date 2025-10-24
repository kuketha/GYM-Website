<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve class schedule from the classes table
$sql = "SELECT * FROM classes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Class Schedule</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .schedule-container {
            width: 100%;
            max-width: 500px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
            text-align: center;
        }
        .class-item {
            background-color: #f9f9f9;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .class-item h3 {
            margin: 0;
            color: #007bff;
        }
        .class-item p {
            margin: 5px 0;
            color: #555;
        }
        .back-button {
            display: block;
            text-align: center;
            margin-top: 20px;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="schedule-container">
        <h2>Available Classes</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="class-item">
                    <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                    <p>Date: <?php echo htmlspecialchars($row['classdate']); ?></p>
                    <p>Time: <?php echo htmlspecialchars($row['classtime']); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No classes are available at the moment.</p>
        <?php endif; ?>
        <a href="customer_profile.php" class="back-button">Back</a>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>

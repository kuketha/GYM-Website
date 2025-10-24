<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym";

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update reply1 if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query_id = $_POST['query_id'];
    $reply1 = $_POST['reply1'];

    // Update query with reply1
    $sql = "UPDATE queries SET reply1 = ?, replied_at = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $reply1, $query_id);
    $stmt->execute();
    $stmt->close();

    header("Location: manage_query.php");
    exit();
}

// Fetch all queries
$sql = "SELECT * FROM queries";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Queries</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
            color: #333;
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #0277bd;
        }
        table {
            width: 100%;
            max-width: 900px;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #ffffff;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #b3e5fc;
        }
        th {
            background-color: #b3e5fc;
            color: #0277bd;
        }
        td {
            color: #555;
        }
        tr:nth-child(even) {
            background-color: #f1f8ff;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #b3e5fc;
            border-radius: 4px;
            resize: vertical;
        }
        .readonly-box {
            width: 100%;
            padding: 8px;
            border: 1px solid #b3e5fc;
            border-radius: 4px;
            background-color: #f9f9f9;
            color: #666;
        }
        button {
            margin-top: 10px;
            padding: 8px 12px;
            background-color: #0277bd;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #01579b;
        }
        .back-button {
            margin-top: 20px;
            padding: 8px 12px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }
        .back-button:hover {
            background-color: #3b78ca;
        }
    </style>
</head>
<body>
    <div>
        <h2>Manage Customer Queries</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Inquiry Type</th>
                <th>Message</th>
                <th>Admin Reply (Reply 1)</th>
                <th>Staff Reply (Reply 2)</th>
                
            </tr>
            <?php while($query = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $query['id']; ?></td>
                    <td><?php echo htmlspecialchars($query['name']); ?></td>
                    <td><?php echo htmlspecialchars($query['email']); ?></td>
                    <td><?php echo htmlspecialchars($query['phone']); ?></td>
                    <td><?php echo htmlspecialchars($query['inquiry_type']); ?></td>
                    <td><?php echo htmlspecialchars($query['message']); ?></td>
                    <td>
                        <!-- Display admin's existing reply in a non-editable box -->
                        <div class="readonly-box"><?php echo htmlspecialchars($query['reply1']); ?></div>
                        
                        <!-- Editable textarea for updating reply1 -->
                        <form action="manage_query.php" method="POST">
                            <input type="hidden" name="query_id" value="<?php echo $query['id']; ?>">
                            <textarea name="reply1" rows="2" placeholder="Enter your updated reply here"></textarea>
                            <button type="submit">Reply</button>
                        </form>
                    </td>
                    <td><?php echo htmlspecialchars($query['reply2']); ?></td> <!-- Display staff reply (reply2) as read-only -->
                </tr>
            <?php endwhile; ?>
        </table>
        <a href="welcome_admin.html" class="back-button">Back to Dashboard</a>
    </div>
</body>
</html>

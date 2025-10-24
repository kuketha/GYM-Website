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

// Handle the reply2 submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply_submit'])) {
    $query_id = $_POST['query_id'];
    $reply2 = $_POST['reply2'];
    
    // Update the reply2 field for the specific query
    $sql = "UPDATE queries SET reply2 = ?, replied_at = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $reply2, $query_id);
    $stmt->execute();
    $stmt->close();
    
    // Redirect back to the staff panel after submitting the reply
    header("Location: staff_panel.html");
    exit();
}

// Fetch all queries for viewing
$sql = "SELECT * FROM queries";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Query View - FitZone Fitness Center</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            padding: 20px;
        }
        h2 {
            color: #333;
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
            border: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        td {
            color: #555;
        }
        /* Right-side specific styling */
        .reply-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 300px;
        }
        .readonly-box, .textarea-box {
            width: 100%; /* Adapts to the container width */
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
        }
        .readonly-box {
            background-color: #f9f9f9;
            color: #666;
        }
        button {
            color: #ffffff;
            background-color: #007bff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-button {
            color: #ffffff;
            background-color: #6c757d;
            border: none;
            padding: 10px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div>
    <h2>Inquiry Queries</h2>
    
    <!-- Display Queries -->
    <table>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Inquiry Type</th>
            <th>Message</th>
            <th>Admin Reply (Reply 1)</th>
            <th>Staff Reply (Reply 2)</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['inquiry_type']); ?></td>
                <td><?php echo htmlspecialchars($row['message']); ?></td>
                <td>
                    <!-- Display admin's reply1 as read-only -->
                    <div class="reply-container">
                        <div class="readonly-box"><?php echo $row['reply1'] ? htmlspecialchars($row['reply1']) : "No reply from admin yet"; ?></div>
                    </div>
                </td>
                <td>
                    <!-- Staff's reply2 as an editable textarea within the reduced-width container -->
                    <div class="reply-container">
                        <form action="query_view.php" method="POST">
                            <input type="hidden" name="query_id" value="<?php echo $row['id']; ?>">
                            <textarea name="reply2" class="textarea-box" placeholder="Enter your reply" required><?php echo htmlspecialchars($row['reply2']); ?></textarea>
                            <button type="submit" name="reply_submit">Submit Reply</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>

    <!-- Back Button -->
    <button onclick="window.location.href='staff_panel.html'" class="back-button">Back</button>
</div>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>

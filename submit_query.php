<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Handle query submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_query'])) {
    $customer_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $inquiry_type = $_POST['inquiry_type'];
    $message = $_POST['message'];

    $sql = "INSERT INTO queries (customer_id, name, email, phone, inquiry_type, message) VALUES ('$customer_id', '$name', '$email', '$phone', '$inquiry_type', '$message')";
    $conn->query($sql);
    header("Location: submit_query.php");
    exit();
}

// Fetch existing queries and replies for the customer
$customer_id = $_SESSION['user_id'];
$sql = "SELECT * FROM queries WHERE customer_id = $customer_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit and View Queries</title>
    <style>
        /* CSS Styling for page layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            font-weight: bold;
            color: #555;
        }
        input[type="text"], input[type="email"], input[type="tel"], select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            padding: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .back-button {
            background-color: #6c757d;
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Query Submission Form -->
     <br>
     <br>
     <br>
    <h2>Submit a Query</h2>
    <form action="submit_query.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="inquiry_type">Inquiry Type:</label>
        <select id="inquiry_type" name="inquiry_type" required>
            <option value="" disabled selected>Select inquiry type</option>
            <option value="general">General Inquiry</option>
            <option value="membership">Membership Inquiry</option>
            <option value="services">Services Inquiry</option>
            <option value="other">Other</option>
        </select>

        <label for="message">Message:</label>
        <textarea id="message" name="message" rows="4" required></textarea>

        <button type="submit" name="submit_query">Submit Query</button>
    </form>

    <!-- Display Queries and Replies -->
    <h2>View Admin Replies</h2>
    <table>
        <tr>
            <th>Inquiry Type</th>
            <th>Message</th>
            <th>Admin Reply 1</th>
            <th>Admin Reply 2</th>
        </tr>
        <?php while ($query = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($query['inquiry_type']); ?></td>
                <td><?php echo htmlspecialchars($query['message']); ?></td>
                <td><?php echo $query['reply1'] ? htmlspecialchars($query['reply1']) : "No reply yet"; ?></td>
                <td><?php echo $query['reply2'] ? htmlspecialchars($query['reply2']) : "No reply yet"; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

    <!-- Back Button -->
    <button onclick="window.location.href='customer_profile.php'" class="back-button">Back</button>
</div>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>

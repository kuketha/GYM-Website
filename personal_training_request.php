<?php
// Start the session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch personal training requests from the updated table
$sql = "SELECT pt.id, pt.session_date, pt.session_time, pt.duration, pt.session_type, pt.notes, 
               pt.trainer AS trainer_name, pt.customer AS customer_name 
        FROM personal_training pt
        ORDER BY pt.session_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Training Requests</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; color: #333; padding: 20px; text-align: center; }
        h2 { color: #007bff; }
        table { width: 80%; margin: auto; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 10px; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h2>Personal Training Requests</h2>

<?php
// Check if any personal training requests were found
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>
            
            <th>Trainer</th>
            <th>Customer</th>
            <th>Session Date</th>
            <th>Session Time</th>
            <th>Duration (mins)</th>
            <th>Session Type</th>
            <th>Notes</th>
          </tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>
               
                <td>" . htmlspecialchars($row['trainer_name']) . "</td>
                <td>" . htmlspecialchars($row['customer_name']) . "</td>
                <td>" . htmlspecialchars($row['session_date']) . "</td>
                <td>" . htmlspecialchars($row['session_time']) . "</td>
                <td>" . htmlspecialchars($row['duration']) . "</td>
                <td>" . htmlspecialchars($row['session_type']) . "</td>
                <td>" . htmlspecialchars($row['notes']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No personal training requests found.</p>";
}

// Close the connection
$conn->close();
?>

</body>
</html>

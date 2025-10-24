<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "gym");
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
}

// Example action: Send reminders to all active memberships expiring soon
$sql = "SELECT * FROM membership_registration WHERE status='Active' AND expiration_date <= DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Here you would implement your logic to send an email or notification
        echo "Reminder sent to: " . $row['fullname'] . " (" . $row['email'] . ")<br>";
    }
    echo "All reminders sent successfully!";
} else {
    echo "No active memberships expiring soon.";
}

$conn->close();
?>

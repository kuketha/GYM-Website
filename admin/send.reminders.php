<?php
$conn = new mysqli('localhost', 'root', '', 'gym');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$currentDate = date("Y-m-d");
$reminderDate = date("Y-m-d", strtotime("+7 days")); // 7 days from now

$sql = "SELECT email, fullname FROM membership_registration WHERE expiration_date BETWEEN '$currentDate' AND '$reminderDate' AND status = 'Active'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $to = $row['email'];
        $subject = "Membership Renewal Reminder";
        $message = "Dear " . $row['fullname'] . ",\n\nYour membership is expiring soon! Please consider renewing it before it lapses.\n\nBest Regards,\nFitZone Fitness Center";
        $headers = "From: no-reply@fitzone.com";

        // Send email
        mail($to, $subject, $message, $headers);
        echo "Reminder sent to " . $row['fullname'] . " (" . $to . ")<br>";
    }
} else {
    echo "No reminders to send.";
}

$conn->close();
?>

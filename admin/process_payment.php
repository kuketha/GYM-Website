<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'gym');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$member_id = $_POST['member_id'];
$membership_plan = $_POST['plan'];

// Simulate payment processing
// In a real application, you would integrate with a payment gateway here

// Check if member exists
$sql = "SELECT * FROM membership_registration WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $member_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update the membership status to active
    $update_sql = "UPDATE membership_registration SET status = 'Active' WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("i", $member_id);
    
    if ($update_stmt->execute()) {
        echo "Membership renewed successfully!";
    } else {
        echo "Error renewing membership: " . $conn->error;
    }
} else {
    echo "Member not found!";
}

// Close the connection
$stmt->close();
$conn->close();
?>

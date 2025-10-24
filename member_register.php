<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'gym'); // Adjust these parameters as necessary

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $phonenumber = $conn->real_escape_string($_POST['phonenumber']);
    $membershipplan = $conn->real_escape_string($_POST['membershipplan']);

    // Insert data into the membership_registration table
    $sql = "INSERT INTO membership_registration (fullname, email, phonenumber, membershipplan) VALUES ('$fullname', '$email', '$phonenumber', '$membershipplan')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>Registration Successful!</h2>";
        echo "<p>Thank you for registering, $fullname. Your membership plan is: $membershipplan.</p>";
        echo "<button onclick=\"location.href='index.html'\">Back to Home</button>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

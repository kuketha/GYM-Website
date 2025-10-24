<?php
// Start the session to store session variables
session_start();

// Include the database configuration file (make sure 'config.php' contains the database connection code)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym";

// Create a new database connection using mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve username and password from POST request
$username = $_POST["username"];
$password = $_POST["password"];

// Prepare SQL query to check if the username and password match any entry in the database
$sql = "SELECT * FROM adminlog WHERE username = ? AND password = ?";

// Prepare the statement to avoid SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $password); // Bind the parameters (s for string type)

// Execute the query
$stmt->execute();

// Store the result
$stmt->store_result();

// Check if any rows were returned (meaning a match was found)
if ($stmt->num_rows <= 0) {
    // If no matching rows, display an error message
    echo "Sorry, there is no username $username with the specified password.<br>";
    echo "Try again.";
    exit;
} else {
    // If a match is found, set session variable for the user
    $_SESSION['user'] = $username;

    // Redirect to the 'register.html' page
    header("Location: admin_dashboard.html");
    exit;
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
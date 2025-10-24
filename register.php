<?php
// Database connection details
$servername = "localhost";
$username = "root";  // Change if you have a different username
$password = "";      // Change if you have a password set
$dbname = "gym";

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $name = $conn->real_escape_string($_POST['name']);
    $age = (int)$_POST['age'];
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);

    // Insert data into the table
    $sql = "INSERT INTO reg (name, age, email, phone, address) 
            VALUES ('$name', $age, '$email', '$phone', '$address')";

    if ($conn->query($sql) === TRUE) {
        // Display success message and redirect to login.html
        echo "<script>
                alert('Registered successfully!');
                setTimeout(function() {
                    window.location.href = '';
                }, 2000); // Redirect after 2 seconds
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

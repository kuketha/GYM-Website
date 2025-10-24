<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); 
    exit();
}

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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer = $_POST['customer'];
    $trainer = $_POST['trainer'];
    $session_date = $_POST['session_date'];
    $session_time = $_POST['session_time'];
    $duration = (int) $_POST['duration']; // Ensure duration is an integer
    $session_type = $_POST['session_type'];
    $notes = $_POST['notes'];

    $sql = "INSERT INTO personal_training (customer, trainer, session_date, session_time, duration, session_type, notes) 
            VALUES ('$customer', '$trainer', '$session_date', '$session_time', $duration, '$session_type', '$notes')";

    if ($conn->query($sql) === TRUE) {
        $success_msg = "New personal training request submitted successfully!";
    } else {
        $error_msg = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Training Request Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 500px;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #0277bd;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #0277bd;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #b3e5fc;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            background-color: #0277bd;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #01579b;
        }

        .success-msg {
            color: #4caf50;
            font-weight: bold;
            text-align: center;
        }

        .error-msg {
            color: #f44336;
            font-weight: bold;
            text-align: center;
        }

        .back-btn {
            display: block;
            margin-top: 20px;
            text-align: center;
        }

        .back-btn a {
            text-decoration: none;
            color: #0277bd;
            font-size: 16px;
            padding: 10px;
            border: 1px solid #0277bd;
            border-radius: 4px;
            background-color: #ffffff;
            transition: background-color 0.3s;
        }

        .back-btn a:hover {
            background-color: #0277bd;
            color: white;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <br>
        <br>
        <br>
        <br>
        <h2>Personal Training Request Form</h2>
        
        <!-- Display success message after form submission -->
        <?php if (isset($success_msg)): ?>
            <p class="success-msg"><?php echo $success_msg; ?></p>
        <?php endif; ?>

        <!-- Display error message if there's an issue -->
        <?php if (isset($error_msg)): ?>
            <p class="error-msg"><?php echo $error_msg; ?></p>
        <?php endif; ?>

        <!-- Display form -->
        <form method="POST" action="personal_training_form.php">
            <label for="customer">Customer Name:</label>
            <input type="text" id="customer" name="customer" required>

            <label for="trainer">Trainer Name:</label>
            <input type="text" id="trainer" name="trainer" required>

            <label for="session_date">Session Date:</label>
            <input type="date" id="session_date" name="session_date" required>

            <label for="session_time">Session Time:</label>
            <input type="time" id="session_time" name="session_time" required>

            <label for="duration">Duration (minutes):</label>
            <input type="number" id="duration" name="duration" required>

            <label for="session_type">Session Type:</label>
            <input type="text" id="session_type" name="session_type" required>

            <label for="notes">Special Notes:</label>
            <textarea id="notes" name="notes" rows="4"></textarea>

            <button type="submit">Submit Request</button>
        </form>

        <!-- Back Button -->
        <div class="back-btn">
            <a href="customer_profile.php">Back to Profile</a>
        </div>
    </div>
</body>
</html>

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gym";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Check if the user is registered in the `membership_registration` table
$sql = "SELECT * FROM membership_registration WHERE id = $user_id";
$result = $conn->query($sql);

// If user is not registered in the membership table, stop the script
if ($result->num_rows == 0) {
    echo "<p style='color: red; text-align: center;'>You are not a registered member. Please contact the admin.</p>";
    exit(); // Stop further execution for non-members
}

// Fetch the user's membership details
$membership = $result->fetch_assoc();

// Handle form submission for updating membership
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the membership plan is updated
    $new_plan = $conn->real_escape_string($_POST['membershipplan']);

    // Only update if the membership plan has actually changed
    if ($membership['membershipplan'] !== $new_plan) {
        // Update the membership plan in the database
        $update_sql = "UPDATE membership_registration SET membershipplan = '$new_plan' WHERE id = $user_id";
        if ($conn->query($update_sql) === TRUE) {
            echo "<p style='color: green; text-align: center;'>Membership plan updated successfully!</p>";
            // Refresh membership details to show the new plan
            $membership['membershipplan'] = $new_plan;
        } else {
            echo "<p style='color: red; text-align: center;'>Error updating membership plan: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color: orange; text-align: center;'>Your membership plan is already set to this option.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Membership</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .membership-container {
            width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #2c3e50;
        }
        label, select {
            font-weight: bold;
            margin-top: 15px;
            color: #555;
            display: block;
        }
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .back-button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="membership-container">
        <h2>Update Membership</h2>
        <p>Current Plan: <strong><?php echo $membership['membershipplan']; ?></strong></p>
        
        <form action="update_membership.php" method="POST">
            <label for="membershipplan">Select New Plan:</label>
            <select name="membershipplan" id="membershipplan" required>
                <option value="Basic" <?php if ($membership['membershipplan'] == 'Basic') echo 'selected'; ?>>Basic</option>
                <option value="Premium" <?php if ($membership['membershipplan'] == 'Premium') echo 'selected'; ?>>Premium</option>
                <option value="Family" <?php if ($membership['membershipplan'] == 'Family') echo 'selected'; ?>>Family</option>
            </select>
            <input type="submit" value="Update Membership">
        </form>

        <!-- Back Button -->
        <a href="customer_profile.php" class="back-button">Back</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>

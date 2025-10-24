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

// Fetch user details
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM reg WHERE id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            height: 100vh;
            margin: 0;
        }
        /* Split container styling */
        .container {
            display: flex;
            width: 100%;
        }
        /* Left sidebar - 30% */
        .left-sidebar {
            width: 30%;
            background-color: #2c3e50;
            color: #fff;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        /* Profile image on top right */
        .profile-image {
            position: relative;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            background-color: #ddd;
            margin-bottom: 20px;
            border: 4px solid #ecf0f1;
        }
        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        h2 {
            color: #ecf0f1;
            text-align: center;
            margin: 0 0 20px;
        }
        /* Form styling */
        .form-container {
            padding: 10px 20px;
        }
        .form-container label {
            font-weight: bold;
            color: #ecf0f1;
            display: block;
            margin-top: 10px;
        }
        .form-container input[type="text"],
        .form-container input[type="number"],
        .form-container input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: none;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }
        /* Right content area - 70% */
        .right-content {
            width: 70%;
            padding: 20px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #fff;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            width: 100%;
            max-width: 200px;
        }
        .button-container button {
            background-color: #007bff;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
        }
        .button-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Left Sidebar -->
        <div class="left-sidebar">
            <!-- Circular Profile Image -->
            <div class="profile-image">
                <img src="images.jpg" alt="Profile Image">
            </div>
            <h2>My Dashboard</h2>
            <div class="form-container">
                <form action="update_profile.php" method="POST">
                    <label>Name:</label>
                    <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" disabled>

                    <label>Age:</label>
                    <input type="number" name="age" value="<?php echo htmlspecialchars($user['age']); ?>" disabled>

                    <label>Email:</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>">

                    <label>Phone:</label>
                    <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">

                    <label>Address:</label>
                    <input type="text" name="address" value="<?php echo htmlspecialchars($user['address']); ?>">

                    <input type="submit" value="Update Profile">
                </form>
            </div>
        </div>

        <!-- Right Content Area -->
        <div class="right-content">
            <h2>Welcome to FitZone</h2>
            <p>Use the options below to manage your activities:</p>
            <div class="button-container">
                <button onclick="location.href='change_class.php'">view Change Class</button>
                <button onclick="location.href='personal_training_form.php'">personal training Submit Form</button>
                <button onclick="location.href='submit_query.php'">Submit a Query and view respond</button>
                <button onclick="location.href='co_logout.php'">Logout</button>
            </div>
        </div>
    </div>
</body>
</html>

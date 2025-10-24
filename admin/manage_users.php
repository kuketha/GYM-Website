<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - FitZone Fitness Center</title>
    <style>
        /* Basic styling */
        body { font-family: Arial, sans-serif; background-color: #f3f4f6; color: #333; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .container { max-width: 600px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); }
        h2 { color: #2c3e50; text-align: center; }
        .btn { padding: 10px 15px; margin: 5px; font-size: 16px; border: none; border-radius: 4px; cursor: pointer; }
        .btn-view { background-color: #3498db; color: white; }
        .btn-add { background-color: #2ecc71; color: white; }
        .btn-update { background-color: #f39c12; color: white; }
        .btn-delete { background-color: #e74c3c; color: white; }
        .form-group { margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #3498db; color: white; }
        .section { display: none; } /* Hide sections initially */
    </style>
    <script>
        // Show and hide sections based on button clicks
        function showSection(sectionId) {
            document.getElementById('addSection').style.display = 'none';
            document.getElementById('viewSection').style.display = 'none';
            document.getElementById('deleteSection').style.display = 'none';
            document.getElementById('updateSection').style.display = 'none';
            document.getElementById(sectionId).style.display = 'block';
        }
    </script>
</head>
<body>
    <div class="container">
        <button class="btn btn-dashboard" onclick="location.href='welcome_admin.html'">Admin Dashboard</button>
        
        <h2>Manage Users</h2>
        <!-- Action Buttons -->
        <button class="btn btn-add" onclick="showSection('addSection')">Add User</button>
        <button class="btn btn-view" onclick="showSection('viewSection')">View Users</button>
        <button class="btn btn-update" onclick="showSection('updateSection')">Update User</button>
        <button class="btn btn-delete" onclick="showSection('deleteSection')">Delete User</button>

        <!-- Add User Section -->
        <div id="addSection" class="section">
            <h3>Add New User</h3>
            <form action="manage_users.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address">
                </div>
                <button type="submit" class="btn btn-add" name="add_user">Add User</button>
            </form>
        </div>

        <!-- View Users Section -->
        <div id="viewSection" class="section">
            <h3>Current Users</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection
                    $conn = new mysqli('localhost', 'root', '', 'gym');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT * FROM reg";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['age']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['address']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No users found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Update User Section -->
        <div id="updateSection" class="section">
            <h3>Update User</h3>
            <form action="manage_users.php" method="POST">
                <div class="form-group">
                    <label for="updateUserId">User ID:</label>
                    <input type="number" id="updateUserId" name="id" required>
                </div>
                <div class="form-group">
                    <label for="updateName">New Name:</label>
                    <input type="text" id="updateName" name="name">
                </div>
                <div class="form-group">
                    <label for="updateAge">New Age:</label>
                    <input type="number" id="updateAge" name="age">
                </div>
                <div class="form-group">
                    <label for="updateEmail">New Email:</label>
                    <input type="email" id="updateEmail" name="email">
                </div>
                <div class="form-group">
                    <label for="updatePhone">New Phone:</label>
                    <input type="text" id="updatePhone" name="phone">
                </div>
                <div class="form-group">
                    <label for="updateAddress">New Address:</label>
                    <input type="text" id="updateAddress" name="address">
                </div>
                <button type="submit" class="btn btn-update" name="update_user">Update User</button>
            </form>
        </div>

        <!-- Delete User Section -->
        <div id="deleteSection" class="section">
            <h3>Delete User</h3>
            <form action="manage_users.php" method="POST">
                <div class="form-group">
                    <label for="userId">User ID:</label>
                    <input type="number" id="userId" name="id" required>
                </div>
                <button type="submit" class="btn btn-delete" name="delete_user">Delete User</button>
            </form>
        </div>
    </div>

    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'gym');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Add User
    if (isset($_POST['add_user'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $sql = "INSERT INTO reg (name, age, email, phone, address) VALUES ('$name', '$age', '$email', '$phone', '$address')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('User added successfully'); window.location.href='manage_users.php';</script>";
        }
    }

    // Update User
    if (isset($_POST['update_user'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $sql = "UPDATE reg SET name='$name', age='$age', email='$email', phone='$phone', address='$address' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('User updated successfully'); window.location.href='manage_users.php';</script>";
        }
    }

    // Delete User
    if (isset($_POST['delete_user'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM reg WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('User deleted successfully'); window.location.href='manage_users.php';</script>";
        }
    }

    $conn->close();
    ?>
</body>
</html>

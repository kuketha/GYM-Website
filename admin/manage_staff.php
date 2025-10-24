<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Staff - FitZone Fitness Center</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f3f4f6; color: #333; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .container { max-width: 600px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); }
        h2 { color: #2c3e50; text-align: center; }
        .btn { padding: 10px 15px; margin: 5px; font-size: 16px; border: none; border-radius: 4px; cursor: pointer; }
        .btn-add { background-color: #2ecc71; color: white; }
        .btn-update { background-color: #3498db; color: white; }
        .btn-delete { background-color: #e74c3c; color: white; }
        .form-group { margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #3498db; color: white; }
        .section { display: none; }
    </style>
    <script>
        function showSection(sectionId) {
            document.getElementById('addSection').style.display = 'none';
            document.getElementById('viewSection').style.display = 'none';
            document.getElementById('updateSection').style.display = 'none';
            document.getElementById('deleteSection').style.display = 'none';
            document.getElementById(sectionId).style.display = 'block';
        }
    </script>
</head>
<body>
    <div class="container">
        

        <button class="btn btn-dashboard" onclick="location.href='welcome_admin.html'">Admin Dashboard</button>

        <h2>Manage Staff</h2>

        <!-- Action Buttons -->
        <button class="btn btn-add" onclick="showSection('addSection')">Add Staff</button>
        <button class="btn btn-add" onclick="showSection('viewSection')">View Staff</button>
        <button class="btn btn-update" onclick="showSection('updateSection')">Update Staff</button>
        <button class="btn btn-delete" onclick="showSection('deleteSection')">Delete Staff</button>

        <!-- Add Staff Section -->
        <div id="addSection" class="section">
            <h3>Add New Staff</h3>
            <form action="manage_staff.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
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
                    <label for="type">Type:</label>
                    <select id="type" name="type">
                        <option value="yoga">Yoga</option>
                        <option value="cardio">Cardio</option>
                        <option value="boxing">Boxing</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-add" name="add_staff">Add Staff</button>
            </form>
        </div>

        <!-- View Staff Section -->
        <div id="viewSection" class="section">
            <h3>Staff Members</h3>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Database connection
                    $conn = new mysqli('localhost', 'root', '', 'gym');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch staff members
                    $sql = "SELECT * FROM staff";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['type']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No staff members found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Update Staff Section -->
        <div id="updateSection" class="section">
            <h3>Update Staff</h3>
            <form action="manage_staff.php" method="POST">
                <div class="form-group">
                    <label for="id">Staff ID:</label>
                    <input type="number" id="id" name="id" required>
                </div>
                <div class="form-group">
                    <label for="name">New Name:</label>
                    <input type="text" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">New Email:</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="phone">New Phone:</label>
                    <input type="text" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="type">New Type:</label>
                    <select id="type" name="type">
                        <option value="yoga">Yoga</option>
                        <option value="cardio">Cardio</option>
                        <option value="boxing">Boxing</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-update" name="update_staff">Update Staff</button>
            </form>
        </div>

        <!-- Delete Staff Section -->
        <div id="deleteSection" class="section">
            <h3>Delete Staff</h3>
            <form action="manage_staff.php" method="POST">
                <div class="form-group">
                    <label for="id">Staff ID:</label>
                    <input type="number" id="id" name="id" required>
                </div>
                <button type="submit" class="btn btn-delete" name="delete_staff">Delete Staff</button>
            </form>
        </div>
    </div>

    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'gym');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Add Staff
    if (isset($_POST['add_staff'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $type = $_POST['type'];
        $sql = "INSERT INTO staff (name, email, phone, type) VALUES ('$name', '$email', '$phone', '$type')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Staff member added successfully'); window.location.href='manage_staff.php';</script>";
        }
    }

    // Update Staff
    if (isset($_POST['update_staff'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $type = $_POST['type'];
        $sql = "UPDATE staff SET name='$name', email='$email', phone='$phone', type='$type' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Staff member updated successfully'); window.location.href='manage_staff.php';</script>";
        }
    }

    // Delete Staff
    if (isset($_POST['delete_staff'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM staff WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Staff member deleted successfully'); window.location.href='manage_staff.php';</script>";
        }
    }

    $conn->close();
    ?>
</body>
</html>
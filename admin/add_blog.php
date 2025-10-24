<?php
$conn = new mysqli('localhost', 'root', '', 'gym'); // Adjust as needed for your database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];
    $image = $_FILES['image']['name'];

    // Define the target directory
    $target_dir = "uploads/"; // Ensure this directory exists
    $target_file = $target_dir . basename($image);

    // Attempt to move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO blogs (title, content, category, image) VALUES ('$title', '$content', '$category', '$image')";
        
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php"); // Redirect after successful insertion
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog - FitZone Fitness Center</title>
</head>
<body>
    <h1>Add Blog Content</h1>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea><br><br>

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="Workout Routines">Workout Routines</option>
            <option value="Healthy Recipes and Meal Plans">Healthy Recipes and Meal Plans</option>
            <option value="Success Stories">Success Stories</option>
        </select><br><br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image" required><br><br>

        <button type="submit">Add Blog</button>
    </form>
</body>
</html>

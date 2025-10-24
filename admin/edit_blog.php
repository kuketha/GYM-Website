<?php
$conn = new mysqli('localhost', 'root', '', 'gym');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT id, title FROM blogs");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog - FitZone Fitness Center</title>
</head>
<body>
    <h1>Edit Blog Content</h1>
    <?php if ($result->num_rows > 0): ?>
        <ul>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li><?php echo $row['title']; ?>
                    <a href="edit_blog_form.php?id=<?php echo $row['id']; ?>">Edit</a>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No blogs available to edit.</p>
    <?php endif; ?>
</body>
</html>

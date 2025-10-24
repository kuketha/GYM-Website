<?php
$host = 'localhost';
$db = 'gym';  // Updated to your database name
$user = 'root'; // replace with your WAMP MySQL username if different
$pass = ''; // replace with your WAMP MySQL password if different

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

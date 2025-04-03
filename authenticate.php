<?php
/*
// Simple hardcoded credentials (replace with database logic later)
$valid_username = "admin";
$valid_password = "password123"; // In real applications, store hashed passwords!

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && $password === $valid_password) {
        echo "Login successful! Welcome, " . htmlspecialchars($username);
    } else {
        echo "Invalid credentials. <a href='login.php'>Try again</a>";
    }
}
*/
require 'db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, verify password (not hashed yet)
        $row = $result->fetch_assoc();
        if ($password === $row['password']) {
            echo "Login successful! Welcome, " . htmlspecialchars($username);
        } else {
            echo "Incorrect password. <a href='login.php'>Try again</a>";
        }
    } else {
        echo "User not found. <a href='login.php'>Try again</a>";
    }
    
    $stmt->close();
    $conn->close();
}
?>
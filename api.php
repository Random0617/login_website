<?php
require 'db.php'; // Database connection

header("Content-Type: application/json"); // API returns JSON data

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert input to an integer for safety

    // Query to fetch the user
    $sql = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(["username" => $row['username']]); // Return username as JSON
    } else {
        echo json_encode(["error" => "User not found"]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "No ID provided"]);
}
?>

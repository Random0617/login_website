<?php
require 'db.php'; // Database connection

header("Content-Type: application/json"); // API returns JSON data

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert input to an integer for safety

    // Query to fetch the user
    $sql = "SELECT username FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    /*
    See register.php for more detailed explanations
    Prepares an SQL statement for execution
    */
    $stmt->bind_param("i", $id);
    // Binds variables to a prepared statement as parameters
    $stmt->execute();
    // Executes a prepared statement
    $result = $stmt->get_result();
    // Gets a result set from a prepared statement as a mysqli_result object

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Fetch the next row of a result set as an associative array
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

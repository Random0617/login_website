<?php
$servername = "localhost";
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password (empty)
$database = "login_website_db"; //Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
/*
Open a new connection to the MySQL server
@link https://php.net/manual/en/mysqli.construct.php
*/

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

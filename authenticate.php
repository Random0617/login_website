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
// require is requivalent to #include
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    /*
    Prepares an SQL statement for execution.

    public mysqli::prepare(string $query): mysqli_stmt|false

    query: The query, as a string. It must consist of a single SQL statement.
    mysqli_prepare() returns a statement object or false if an error occurred.

    https://php.net/manual/en/mysqli.prepare.php
    */
    $stmt->bind_param("s", $username);
    /*
    Binds variables to a prepared statement as parameters

    public function bind_param($types, &$var1, &...$_) { }
    string $types
    A string that contains one or more characters which specify the types for the corresponding bind variables:

    mixed &$var1
    The number of variables and length of string types must match the parameters in the statement.

    @return bool — true on success or false on failure.

    @link https://php.net/manual/en/mysqli-stmt.bind-param.php
    */
    $stmt->execute();
    /*
    Executes a prepared statement
    @link https://php.net/manual/en/mysqli-stmt.execute.php
    */
    $result = $stmt->get_result();
    /*
    Gets a result set from a prepared statement as a mysqli_result object
    @link https://php.net/manual/en/mysqli-stmt.get-result.php
    */

    if ($result->num_rows > 0) {
        // User found, verify password (not hashed yet)
        $row = $result->fetch_assoc();
        /*
        Fetch the next row of a result set as an associative array
        @return array|false|null
        an associative array representing the fetched row, where each key in the array represents the name of one of the result set's columns, null if there are no more rows in the result set, or false on failure.

        @link https://php.net/manual/en/mysqli-result.fetch-assoc.php
        */
        if ($password === $row['password']) {
            echo "Login successful! Welcome, " . htmlspecialchars($username);
        } else {
            echo "Incorrect password. <a href='login.php'>Try again</a>";
        }
    } else {
        echo "User not found. <a href='login.php'>Try again</a>";
    }
    
    $stmt->close(); // Closes a prepared statement
    $conn->close(); // Closes a previously opened database connection
}
?>
<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Insert user into the database
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    /*
    Prepares an SQL statement for execution
    @param string $query
    The query, as a string. It must consist of a single SQL statement.

    The SQL statement may contain zero or more parameter markers represented by question mark (?) characters at the appropriate positions.
    @link https://php.net/manual/en/mysqli.prepare.php
    */
    $stmt->bind_param("ss", $username, $password);
    /*
    Binds variables to a prepared statement as parameters
    @param string $types
    A string that contains one or more characters which specify the types for the corresponding bind variables:

    @param mixed &$var1
    The number of variables and length of string types must match the parameters in the statement.

    @link https://php.net/manual/en/mysqli-stmt.bind-param.php
    */

    if ($stmt->execute()) { // Executes a prepared statement
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!-- HTML only, nothing extra to learn here -->
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Register</button>
    </form>
</body>
</html>

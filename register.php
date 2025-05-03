<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];

    // If the username already exists, do not proceed
    $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_row();
    $duplicate_usernames = (int) $row[0];

    // If the email already exists, do not proceed
    $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_row();
    $duplicate_emails = (int) $row[0];

    if ($duplicate_usernames > 0){
        echo "Error: This username already exists.";
    } else if ($duplicate_emails > 0){
        echo "Error: This email already exists.";
    } else if (strcmp($password, $repeat_password) == 0){
        // Insert user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        /*
        Prepares an SQL statement for execution
        @param string $query
        The query, as a string. It must consist of a single SQL statement.

        The SQL statement may contain zero or more parameter markers represented by question mark (?) characters at the appropriate positions.
        @link https://php.net/manual/en/mysqli.prepare.php
        */
        $stmt->bind_param("sss", $username, $email, $password);
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

    } else {
        echo "Error: Password and confirm password must be the same.";
    }
}
?>
<!-- HTML only, nothing extra to learn here -->
<style>
    .form-label {
        display: inline-block;
        width: 130px;
        text-align: left;
        margin-right: 10px;
    }
</style>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <label class="form-label">Username:</label>
        <input type="text" name="username" required><br><br>

        <label class="form-label">Email:</label>
        <input type="text" name="email" required><br><br>
        
        <label class="form-label">Password:</label>
        <input type="password" name="password" required><br><br>

        <label class="form-label">Repeat password:</label>
        <input type="password" name="repeat_password" required><br><br>
        
        <button type="submit">Register</button>
    </form>
    <p>To register an account using Moodle, go to the <a href='login.php'>login page</a> instead.</p>
    <button onclick="location.href='index.php'">
        Back to home page
    </button>
</body>
</html>

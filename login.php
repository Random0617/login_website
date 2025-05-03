<!-- HTML only, nothing extra to learn here -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="authenticate.php" method="POST">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Login normally</button>
    </form>
    <button onclick="location.href=&quot;http://localhost/MyMoodleSite/local/oauth/login.php?client_id=login_website&response_type=code&quot;;">Login using Moodle</button>
    <button onclick="location.href='index.php'">
        Back to home page
    </button>
</body>
</html>


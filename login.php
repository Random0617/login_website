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
    <button onclick="loginMoodle()">Login using Moodle</button>
    <button onclick="location.href='index.php'">
        Back to home page
    </button>
</body>
</html>
<script>
    
    async function loginMoodle() {
        window.location.href = 'http://localhost/MyMoodleSite/local/oauth/login.php?client_id=login_website&response_type=code';
        /*
        const urlParams = new URLSearchParams(window.location.search);
        const code = urlParams.get('code');
        
        try {
            const url = 'http://moodledomain.com/local/oauth/token.php';
            
            const params = new URLSearchParams({
                code: code,
                client_id: 'login_website',
                client_secret: '84f1065ba7b3828cd1eab494b246ce817ea6ff0a099660e4',
                grant_type: 'authorization_code',
                scope: 'user_info'
            });

            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: params
            });

            const data = await response.json();
            alert('OAuth Token Response: ', data);
        } catch (error) {
            alert('Error:', error);
        } 
        */
    }
</script>
<!DOCTYPE html>
<html>
<head>
    <title>Home page</title>
</head>
<body>
    <h3>Welcome to Demo website</h3>
    <h3 id="login_state">You are not currently logged in.</h3>
    <button onclick="location.href='login.php'">
        Log in
    </button>
    <button onclick="location.href='register.php'">
        Register
    </button>
</body>
</html>
<?php
$email = "";
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    echo $code . "\n";

    // Step 3: https://github.com/Random0617/moodle-local_oauth-modified?tab=readme-ov-file#how-to-use
    $token_url = "http://localhost/MyMoodleSite/local/oauth/token.php";

    $data = [
        'code' => $code,
        'client_id' => 'login_website',
        'client_secret' => '84f1065ba7b3828cd1eab494b246ce817ea6ff0a099660e4',
        'grant_type' => 'authorization_code',
        'scope' => 'user_info'
    ];

    $ch = curl_init($token_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        $responseData = json_decode($response, true);
        echo '<pre>';
        echo json_encode($responseData, JSON_PRETTY_PRINT);
        echo '</pre>';
    }
    curl_close($ch);

    // Step 6: https://github.com/Random0617/moodle-local_oauth-modified?tab=readme-ov-file#how-to-use
    $token_url = "http://localhost/MyMoodleSite/local/oauth/user_info.php";

    $data = [
        'access_token' => $responseData["access_token"]
    ];

    $ch = curl_init($token_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        $responseData = json_decode($response, true);
        echo '<pre>';
        echo json_encode($responseData, JSON_PRETTY_PRINT);
        echo '</pre>';
    }
    curl_close($ch);
    
    $email = $responseData["email"];
    
    echo "Email: " . $email;
}
?>
<script>
    const email_string = <?php echo json_encode($email); ?>;
    document.getElementById("login_state") = "Logged in as ".concat(email_string);
</script>
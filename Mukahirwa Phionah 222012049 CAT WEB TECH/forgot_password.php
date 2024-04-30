<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form method="post">
        <label for="email">Enter your email address:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
include('db-connection.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['token'])) {
    // Retrieve token from URL
    $token = $_GET['token'];

    // Check if token exists in the database
    $sql = "SELECT * FROM users WHERE reset_token='$token'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Display password reset form
        echo "<form action='update_password.php' method='post'>
                <input type='hidden' name='token' value='$token'>
                <label for='password'>Enter your new password:</label><br>
                <input type='password' id='password' name='password' required><br><br>
                <input type='submit' value='Reset Password'>
              </form>";
    } else {
        echo "Invalid reset token.";
    }
}
?>

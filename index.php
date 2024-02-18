<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="GlobalCss.css">
    <link rel="stylesheet" href="LoginCss.css">
</head>
<body>
    <div class="login-container">
    <h2>Login</h2>
    <form method="post" action="login-process.php">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="captcha">Captcha:</label><br>
        <input type="text" id="captcha" name="captcha" required><br>
        <img src="captcha.php" alt="CAPTCHA Image"><br>
        <button type="button" onclick="refreshCaptcha()">Refresh CAPTCHA</button><br><br>
        <input type="submit" value="Login">
    </form>

    <script>
        function refreshCaptcha() {
            var img = document.querySelector('img');
            img.src = 'captcha.php?' + new Date().getTime();
        }
    </script>
</body>
</html>

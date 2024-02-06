<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Login.css">
</head>
<body>
    <div class="container">
        <form method="post" action="Login.action.php" class="login-form">
            <div class="form-header">
                <h2>Login</h2>
            </div>
            <div class="form-content">
                <label for="username">Username</label>
                <input type="text" name="username" required>

                <label for="password">Password</label>
                <input type="password" name="password" required>

                <button type="submit" class="btn-login">Login</button>
            </div>
        </form>

        <div class="signup-section">
            <h2>Don't have an account?</h2><br>
            <div class="btn-container">
                <a href="register.html" class="btn-signup">Sign Up</a>
                <a href="register.html" class="btn-signup">Sign Up</a>
            </div>
        </div>
    </div>
</body>
</html>

<?php

include '../includes/config.php';
require_once('../classes/login.php');
require_once('../classes/users.php');
$error = '';

if (isset($_POST['login'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = 'Both email and password are required.';
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email format.';
        } else {
            $login = new Login($email, $password);

            if ($login->validateLogin()) {
                // Set session variables
                session_start();
                $_SESSION['user_email'] = $email;
                $user = new Users();
                $userData = $user->getUserByEmail($_SESSION['user_email']);
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['firstname'] = $userData['firstname'];
                $_SESSION['lastname'] = $userData['lastname'];
                $_SESSION['username'] = $userData['username'];
                $_SESSION['is_admin'] = $userData['is_admin'];
                $_SESSION['loggedin'] = true;

                // Successful login but no redirection
                $successMessage = 'Login successful! You are now logged in.';
            } else {
                $error = 'Invalid email or password.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login / Register</title>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <h1>Welcome to the Website</h1>
        </div>
    </header>

    <!-- Login Section -->
    <?php if (!empty($error)) { ?>
        <div class="error-message">
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        </div>
    <?php } elseif (!empty($successMessage)) { ?>
        <div class="success-message">
            <p class="success"><?php echo htmlspecialchars($successMessage); ?></p>
        </div>
    <?php } ?>

    <div class="content"><h2>Login</h2></div>
    <section class="form-section">
        <div class="form-container">
            <form id="loginForm" name="loginForm" action="login.php" method="post" onsubmit="return validateLogin()">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button name="login" type="submit">Login</button>
            </form>
        </div>
        <p>Or create a <a href="register.php">new account here</a></p>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-container">
            <p>&copy; <?php echo date('Y'); ?> Your Website. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

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
                
                
                $_SESSION['user_email'] = $email;
                $user = new Users();
                $userData = $user->getUserByEmail($_SESSION['user_email']);
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['firstname'] = $userData['firstname'];
                $_SESSION['lastname'] = $userData['lastname'];
                $_SESSION['username'] = $userData['username'];
                $_SESSION['is_admin'] = $userData['is_admin'];
                $_SESSION['loggedin'] = true;

                header ("Location: ../dashboard.php");
                

                
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
    <link rel="stylesheet" href="../style.css">
    <title>Login</title>
</head>
<body>
    <div class="page-container">
       
        <?php include('../helpers/header.php'); ?>

        <div class="login-container">
            <div class="form-box">
                <h2>Login</h2>
                <?php if (!empty($error)) { ?>
                    <div class="error-message">
                        <p class="error"><?php echo htmlspecialchars($error); ?></p>
                    </div>
                <?php } elseif (!empty($successMessage)) { ?>
                    <div class="success-message">
                        <p class="success"><?php echo htmlspecialchars($successMessage); ?></p>
                    </div>
                <?php } ?>
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    <button class="btn" name="login" type="submit">Login</button>
                    <p>Don't have an account? <a href="register.php">Register here</a></p>
                </form>
            </div>
        </div>

       
        <?php include('../helpers/footer.php'); ?>
    </div>
</body>
</html>

<?php
include '../includes/config.php';
require_once('../classes/users.php');
$error = '';

if (isset($_POST['save'])) {
    $name = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    
    if (empty($name) || empty($lastname) || empty($username) || empty($email) || empty($password)) {
        $error = 'Please fill in all the required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
        $users = new Users();
        if (!$users->userExists($username, $email)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $users->setFirstname($name);
            $users->setLastname($lastname);
            $users->setUsername($username);
            $users->setEmail($email);
            $users->setPassword($passwordHash);

            $users->setUser(); 
        } else {
            $error = 'Username or Email already exists.';
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
    <title>Register</title>
</head>
<body>
    <div class="page-container">
        <!-- Include Header -->
        <?php include('../helpers/header.html'); ?>

        <!-- Registration Form -->
        <div class="register-container">
            <div class="form-box">
                <h2>Register</h2>
                <?php if (!empty($error)) { ?>
                    <div class="error-message">
                        <p class="error"><?php echo htmlspecialchars($error); ?></p>
                    </div>
                <?php } ?>
                <form action="register.php" method="post">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" placeholder="Enter your first name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" placeholder="Enter your last name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Choose a username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Create a password" required>
                    </div>
                    <button class="btn" name="save" type="submit">Register</button>
                    <p>Already have an account? <a href="login.html">Login here</a></p>
                </form>
            </div>
        </div>

        <!-- Include Footer -->
        <?php include('../helpers/footer.html'); ?>
    </div>
</body>
</html>



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
   
    <?php include('../helpers/header.html'); ?>

   
    <?php if (!empty($error)) { ?>
        <div class="error-message">
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        </div>
    <?php } ?>

    
    <div class="content">
        <h2>Register</h2>
    </div>
    <section class="form-section">
        <div class="form-container">
            <form action="register.php" method="post" id="registerForm" name="registerForm">
                <input type="text" name="firstname" placeholder="First Name" required>
                <input type="text" name="lastname" placeholder="Last Name" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button name="save" type="submit">Register</button>
            </form>
        </div>
        <p>Already registered? <a href="login.html">Login here</a></p>
    </section>

    <?php include('../helpers/footer.html'); ?>
</body>
</html>


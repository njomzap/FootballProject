<?php
include 'includes/config.php';
require_once('classes/users.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="page-container">
       
        <header>
            <h1>Dashboard</h1>
        </header>

        
        <main>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                $username = $_SESSION['username'];
                $is_admin = $_SESSION['is_admin'];

                echo "<h2>Welcome, $username!</h2>";

                if ($is_admin == 1) {
                    echo "<p>Welcome, Admin! You have full access to the system.</p>";
                }

                echo '<a href="classes/logout.php">Logout</a>';
                echo '<br>';
                echo 'Current directory: ' . __DIR__; 
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
        </main>

        
        <footer>
            <p>&copy; <?php echo date('Y'); ?> Football Project. All Rights Reserved.</p>
        </footer>
    </div>
</body>
</html>


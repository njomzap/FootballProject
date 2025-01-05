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
<body class="home-page">

    <?php include('helpers/header.php'); ?> 

    <div class="page-container">

        <main class="main-content">
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                $username = $_SESSION['username'];
                $is_admin = $_SESSION['is_admin'];

                echo "<h2>Hello, $username! Here are your posts:</h2>";

                echo "<div id='user-posts'>";
                echo "<p>No posts available yet.</p>"; 
                echo "</div>";

                if ($is_admin == 1) {
                    echo "<p>Welcome, Admin! You have full access to the system.</p>";
                }

                echo '<a href="classes/logout.php">Logout</a>';
            } else {
                echo '<a href="login.php">Login</a>';
            }
            ?>
        </main>

        <?php include('helpers/footer.php'); ?> 

    </div>
    <script src="script.js"></script> 
</body>
</html>








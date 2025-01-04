<?php
    include 'includes/config.php';
    require_once('classes/users.php');


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $username = $_SESSION['username'];
    $is_admin = $_SESSION['is_admin'];

  
    echo "<h2>Welcome, $username!</h2>";

    
    if ($is_admin == 1) {
        echo "<p>Welcome, Admin! You have full access to the system.</p>";
    }
    
 
    echo '<a href="classes/logout.php">Logout</a>';
echo '<br>';
echo 'Current directory: ' . __DIR__;  // This will print the current directory of dashboard.php


} else {
   
    echo '<a href="login.php">Login</a>';
}
?>

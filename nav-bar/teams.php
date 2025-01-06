<?php
require_once('../includes/db_config.php');
require_once('../classes/teams.php');
include('../helpers/header.php');


$teams = new Teams();
$allTeams = $teams->getAllTeams();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teams</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="page-container">
        <div class="main-content">
            <h1>Teams in Superliga</h1>
            </div>
    
        <?php include('../helpers/footer.php'); ?>
    
    <script src="../script.js"></script>
</body>
</html>



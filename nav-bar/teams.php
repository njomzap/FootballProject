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
            
            <a href="../add_team.php">Add New Team</a>
            
            <?php if (!empty($allTeams)) : ?>
                <table class="teams-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Stadium</th>
                            <th>City</th>
                            <th>Founded</th>
                            <th>Manager</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allTeams as $team) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($team['name']); ?></td>
                                <td><?php echo htmlspecialchars($team['stadium']); ?></td>
                                <td><?php echo htmlspecialchars($team['city']); ?></td>
                                <td><?php echo htmlspecialchars($team['founded']); ?></td>
                                <td><?php echo htmlspecialchars($team['manager']); ?></td>
                                <td><?php echo htmlspecialchars($team['country']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>No teams found in the database.</p>
            <?php endif; ?>
        </div>
    
        <?php include('../helpers/footer.php'); ?>
    </div>
    <script src="../script.js"></script>
</body>
</html>



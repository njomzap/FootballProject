<?php 
include('../includes/db_config.php'); 
include('../helpers/header.php'); 

require_once('../classes/matches.php');
$matches = new Matches();

$upcoming_matches = $matches->getMatchesByStatus('scheduled');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matches</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>
    <div class="page-container">
        <div class="main-content">
            <h1>Upcoming Matches</h1>

            <?php if (count($upcoming_matches) > 0): ?>
                <div id="upcoming-matches">
                    <?php foreach ($upcoming_matches as $match): ?>
                        <div class="match-card">
                            <div class="team">
                                <strong><?php echo htmlspecialchars($match['home_team']); ?></strong> vs 
                                <strong><?php echo htmlspecialchars($match['away_team']); ?></strong>
                            </div>
                            <div class="date-time">
                                <?php echo htmlspecialchars($match['match_date']); ?> at <?php echo htmlspecialchars($match['match_time']); ?>
                            </div>
                            <div class="venue">
                                <?php echo htmlspecialchars($match['venue']); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No upcoming matches at the moment.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include('../helpers/footer.php'); ?> 
    <script src="../script.js"></script> 
</body>
</html>


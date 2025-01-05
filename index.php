<?php
include 'includes/config.php';
require_once('classes/Matches.php');

$matches = new Matches();

$upcomingMatches = $matches->getMatchesByStatus('scheduled');

$recentResults = $matches->getMatchesByStatus('completed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superliga e Kosovës</title>

    <link rel="stylesheet" href="style.css">
</head>
<body class="home-page">
    <div class="page-container">
       
        <?php include('helpers/header.php'); ?>

        <div class="main-content">
            <h1>Superliga e Kosovës</h1>
            <p>Live Results, Standings, and Updates</p>
        </div>
        
        <div class="navigation-controls">
            <button id="prev" class="arrow">❮</button>
            <button id="next" class="arrow">❯</button>
        </div>

        <section id="recent-results" class="table-wrapper">
            <h2>Recent Results</h2>
            <?php if (!empty($recentResults)): ?>
                <?php foreach ($recentResults as $result): ?>
                    <div class="match-result">
                        <p><?php echo htmlspecialchars($result['home_team']); ?> <strong><?php echo htmlspecialchars($result['home_score']); ?></strong> - <strong><?php echo htmlspecialchars($result['away_score']); ?></strong> <?php echo htmlspecialchars($result['away_team']); ?></p>
                        <p>Date: <?php echo htmlspecialchars($result['match_date']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No recent results available.</p>
            <?php endif; ?>
        </section>

        <section id="upcoming-matches" class="table-wrapper">
            <h2>Upcoming Matches</h2>
            <?php if (!empty($upcomingMatches)): ?>
                <?php foreach ($upcomingMatches as $match): ?>
                    <div class="match">
                        <p><?php echo htmlspecialchars($match['home_team']); ?> vs <?php echo htmlspecialchars($match['away_team']); ?></p>
                        <p>Date: <?php echo htmlspecialchars($match['match_date']); ?> | Time: <?php echo htmlspecialchars($match['match_time']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No upcoming matches available.</p>
            <?php endif; ?>
        </section>
        
        <section id="league-standings" class="table-wrapper">
            <h2>League Standings</h2>
            <table>
                <thead>
                    <tr>
                        <th>Team</th>
                        <th>Points</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Team A</td>
                        <td>45</td>
                    </tr>
                    <tr>
                        <td>Team C</td>
                        <td>42</td>
                    </tr>
                    <tr>
                        <td>Team G</td>
                        <td>40</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <?php include('helpers/footer.php'); ?>
    </div>

    <script src="script.js"></script>
</body>
</html>



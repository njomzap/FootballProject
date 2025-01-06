<?php
include 'includes/config.php';

$api_key = "199e1bac9e0c00c017eaaa2ca3478b9f";
$base_url = "https://v3.football.api-sports.io";

function fetchApiData($endpoint, $api_key, $base_url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $base_url . $endpoint);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "x-apisports-key: $api_key"
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        die('Error fetching data from the API.');
    }

    return json_decode($response, true);
}

$recentMatchesData = fetchApiData('/fixtures?league=664&season=2023&status=FT', $api_key, $base_url);
$recentResults = array_slice($recentMatchesData['response'], 0, 5);

$standingsData = fetchApiData('/standings?league=664&season=2023', $api_key, $base_url);
$leagueStandings = $standingsData['response'][0]['league']['standings'][0];
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
                        <p><?php echo htmlspecialchars($result['teams']['home']['name']); ?> 
                        <strong><?php echo htmlspecialchars($result['goals']['home']); ?></strong> - 
                        <strong><?php echo htmlspecialchars($result['goals']['away']); ?></strong> 
                        <?php echo htmlspecialchars($result['teams']['away']['name']); ?></p>
                        <p>Date: <?php echo htmlspecialchars(date('Y-m-d', strtotime($result['fixture']['date']))); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No recent results available.</p>
            <?php endif; ?>
        </section>

        <section id="league-standings" class="table-wrapper">
            <h2>League Standings</h2>
            <?php if (!empty($leagueStandings)): ?>
                <div class="standings">
                    <table>
                        <thead>
                            <tr>
                                <th>Team</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($leagueStandings as $team): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($team['team']['name']); ?></td>
                                    <td><?php echo htmlspecialchars($team['points']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p>No standings available.</p>
            <?php endif; ?>
        </section>

        <?php include('helpers/footer.php'); ?>
    </div>

    <script src="script.js"></script>
</body>
</html>

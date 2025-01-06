<?php include('../includes/config.php'); ?> 
<?php
include('../includes/db_config.php');
include('../helpers/header.php'); 
 

$api_key = "199e1bac9e0c00c017eaaa2ca3478b9f"; 
$base_url = "https://v3.football.api-sports.io/";

$league_id = 664; 
$season = 2023;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "$base_url/teams?league=$league_id&season=$season");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "x-apisports-key: $api_key"
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($response === false || $http_status !== 200) {
    die('Error fetching data from API. HTTP Status Code: ' . $http_status);
}

$data = json_decode($response, true);
$teams = $data['response'] ?? [];
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
            <h1>Teams</h1>
            <?php if (count($teams) > 0): ?>
                <table id="teams-table">
                    <thead>
                        <tr>
                            <th>Team Name</th>
                            <th>Founded</th>
                            <th>Country</th>
                            <th>Logo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($teams as $team): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($team['team']['name']); ?></td>
                                <td><?php echo htmlspecialchars($team['team']['founded'] ?? 'N/A'); ?></td>
                                <td><?php echo htmlspecialchars($team['team']['country']); ?></td>
                                <td>
                                    <?php if (isset($team['team']['logo'])): ?>
                                        <img src="<?php echo htmlspecialchars($team['team']['logo']); ?>" alt="<?php echo htmlspecialchars($team['team']['name']); ?>" style="width: 50px; height: auto;">
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No teams available for the selected league and season.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include('../helpers/footer.php'); ?>

</body>
</html>




<?php include('../includes/config.php'); ?> 
<?php  
include('../includes/db_config.php'); 
include('../helpers/header.php'); 
include_once('../classes/matches.php');


$api_key = "e87b42d711888053dfa597e20cab2cd4"; 
$base_url = "https://v3.football.api-sports.io";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $base_url . "/fixtures?league=664&season=2023");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "x-apisports-key: $api_key"
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

$matches = [];

if ($response === false) {
    die('Error occurred while fetching data from the API.');
}

$data = json_decode($response, true); 
$matches = $data['response'] ?? []; 

usort($matches, function ($a, $b) {
    return strtotime($a['fixture']['date']) - strtotime($b['fixture']['date']);
});

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
            <h1>Matches</h1>

            <?php if (count($matches) > 0): ?>
                <div id="matches-list">
                    <?php 
                    $current_date = '';
                    foreach ($matches as $match): 
                        $match_date = date('Y-m-d', strtotime($match['fixture']['date']));
                        $match_time = date('H:i', strtotime($match['fixture']['date']));
                        
                        if ($current_date !== $match_date): 
                            $current_date = $match_date; 
                    ?>
                        <div class="match-date"><?php echo htmlspecialchars($current_date); ?></div>
                    <?php endif; ?>
                        <div class="match-card">
                            <div class="team">
                                <strong><?php echo htmlspecialchars($match['teams']['home']['name']); ?></strong> vs 
                                <strong><?php echo htmlspecialchars($match['teams']['away']['name']); ?></strong>
                            </div>
                            <div class="score">
                                <?php 
                                    $match_status = $match['fixture']['status']['long'];
                                    if ($match_status === 'Match Finished') {
                                        echo htmlspecialchars($match['goals']['home']) . " - " . htmlspecialchars($match['goals']['away']);
                                    } elseif ($match_status === 'Not Started') {
                                        echo "Upcoming";  
                                    } else {
                                        echo htmlspecialchars($match_status);
                                    }
                                ?>
                            </div>
                            <div class="date-time">
                                <?php echo htmlspecialchars($match_time); ?>
                            </div>
                            <div class="venue">
                                <?php echo htmlspecialchars($match['fixture']['venue']['name'] ?? 'Unknown Venue'); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No matches available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php include('../helpers/footer.php'); ?> 
</body>
</html>








<?php
require_once('includes/db_config.php');
require_once('classes/teams.php');
include('helpers/header.php'); 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teams = new Teams();

    $teams->setName($_POST['name']);
    $teams->setStadium($_POST['stadium']);
    $teams->setCity($_POST['city']);
    $teams->setFounded($_POST['founded']);
    $teams->setManager($_POST['manager']);
    $teams->setCountry($_POST['country']);

    try {

        $teams->addTeam();

        header("Location: teams.php");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<link rel="stylesheet" href="style.css">
<div class="teams-form-container">
    <div class="teams-form-box">
        <h3>Add New Team</h3>
        <form method="POST" action="">
            <div class="teams-form-group">
                <label for="name">Team Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="teams-form-group">
                <label for="stadium">Stadium</label>
                <input type="text" id="stadium" name="stadium" required>
            </div>

            <div class="teams-form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required>
            </div>

            <div class="teams-form-group">
                <label for="founded">Founded Year</label>
                <input type="text" id="founded" name="founded" required>
            </div>

            <div class="teams-form-group">
                <label for="manager">Manager</label>
                <input type="text" id="manager" name="manager" required>
            </div>

            <div class="teams-form-group">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" required>
            </div>

            <button type="submit" class="teams-form-btn">Add Team</button>
        </form>
    </div>
</div>
<?php include('helpers/footer.php'); ?> 
<script src="script.js"></script>


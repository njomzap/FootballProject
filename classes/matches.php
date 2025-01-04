<?php
require_once('../includes/db_config.php'); // Include the database connection

class Matches extends dbConnect {
    private $match_id;
    private $home_team_id;
    private $away_team_id;
    private $match_date;
    private $home_team_score;
    private $away_team_score;
    private $status;
    private $venue;

    public function __construct($home_team_id = null, $away_team_id = null, $match_date = null, $home_team_score = null, $away_team_score = null, $status = 'scheduled', $venue = null) {
        $this->home_team_id = $home_team_id;
        $this->away_team_id = $away_team_id;
        $this->match_date = $match_date;
        $this->home_team_score = $home_team_score;
        $this->away_team_score = $away_team_score;
        $this->status = $status;
        $this->venue = $venue;
    }

    public function addMatch() {
        $sql = "INSERT INTO matches (home_team_id, away_team_id, match_date, home_team_score, away_team_score, status, venue) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            $this->home_team_id,
            $this->away_team_id,
            $this->match_date,
            $this->home_team_score,
            $this->away_team_score,
            $this->status,
            $this->venue
        ]);
        
        return $this->connect()->lastInsertId(); 
    }

    public function getMatchById($match_id) {
        $sql = "SELECT * FROM matches WHERE match_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$match_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllMatches() {
        $sql = "SELECT * FROM matches";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function updateMatchScores($match_id, $home_team_score, $away_team_score, $status = 'completed') {
        $sql = "UPDATE matches SET home_team_score = ?, away_team_score = ?, status = ? WHERE match_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$home_team_score, $away_team_score, $status, $match_id]);
    }

    
    public function getMatchesByStatus($status) {
        $sql = "SELECT * FROM matches WHERE status = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

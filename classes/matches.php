<?php
require_once(__DIR__ . '/../includes/db_config.php');

class Matches extends dbConnect {
    private $match_id;
    private $team_a;
    private $team_b;
    private $match_date;
    private $match_time;
    private $score_a;
    private $score_b;
    private $status;
    private $venue;

    public function __construct($team_a = null, $team_b = null, $match_date = null, $match_time = null, $score_a = null, $score_b = null, $status = 'scheduled', $venue = null) {
        $this->team_a = $team_a;
        $this->team_b = $team_b;
        $this->match_date = $match_date;
        $this->match_time = $match_time;
        $this->score_a = $score_a;
        $this->score_b = $score_b;
        $this->status = $status;
        $this->venue = $venue;
    }

    public function addMatch() {
        $sql = "INSERT INTO matches (team_a, team_b, match_date, match_time, score_a, score_b, status, venue) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([
            $this->team_a,
            $this->team_b,
            $this->match_date,
            $this->match_time,
            $this->score_a,
            $this->score_b,
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

    public function updateMatchScores($match_id, $score_a, $score_b, $status = 'completed') {
        $sql = "UPDATE matches SET score_a = ?, score_b = ?, status = ? WHERE match_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$score_a, $score_b, $status, $match_id]);
    }

    public function getMatchesByStatus($status) {
        $sql = "SELECT * FROM matches WHERE status = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>


<?php
require_once(__DIR__ . '/../includes/db_config.php');

class Teams extends dbConnect {
    private $id;
    private $name;
    private $stadium;
    private $city;
    private $founded;
    private $manager;
    private $country;

    public function __construct($name = null, $stadium = null, $city = null, $founded = null, $manager = null, $country = null) {
        $this->name = $name;
        $this->stadium = $stadium;
        $this->city = $city;
        $this->founded = $founded;
        $this->manager = $manager;
        $this->country = $country;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setStadium($stadium) {
        $this->stadium = $stadium;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function setFounded($founded) {
        $this->founded = $founded;
    }

    public function setManager($manager) {
        $this->manager = $manager;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function addTeam() {
        if ($this->validateTeamData()) {
            $sql = "INSERT INTO teams (name, stadium, city, founded, manager, country) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([
                $this->name,
                $this->stadium,
                $this->city,
                $this->founded,
                $this->manager,
                $this->country
            ]);

            return $this->connect()->lastInsertId(); 
        } else {
            throw new Exception("Missing or invalid data.");
        }
    }

    public function getAllTeams() {
        $sql = "SELECT * FROM teams";
        $stmt = $this->connect()->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function validateTeamData() {
        return !empty($this->name) && !empty($this->stadium) && !empty($this->city) && !empty($this->manager) && !empty($this->country);
    }
}
?>



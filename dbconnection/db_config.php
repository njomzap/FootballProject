<?php
class dbConnect {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbName = "furnituredb";
    private $conn =null;

    public function connect() {
        try {
            $this->conn = new PDO( 'mysql:host=' . $this->host . ';dbname=' . $this->dbName, $this->username, $this->password );
            $this->conn->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed : " . $e->getMessage();
        }
        return $this->conn;
    }
}

$db = new dbConnect();
$conn = $db->connect();

if ($conn) {
    echo "Connected successfully to the database!";
} else {
    echo "Connection failed.";
}
?>
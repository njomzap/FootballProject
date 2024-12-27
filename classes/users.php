<?php

require_once '../includes/db_config.php';
class Users extends dbConnect {
    private $id;
    private $firstname;
    private $lastname;
    private $username;
    private $email;
    private $password;
    private $is_admin;
    protected $dbconn;

    public function __construct($id = null, $firstname = '', $lastname = '', $username = '', $email = '', $password = '', $is_admin = 0){
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->is_admin = $is_admin;
        $this->dbconn = $this->connect();
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getFirstname() {
        return $this->firstname;
    }
    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }
    public function getLastname() {
        return $this->lastname;
    }
    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }
    public function getUsername() {
        return $this->username;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getIs_Admin() {
        return $this->is_admin;
    }
    public function setIs_Admin($is_admin) {
        $this->is_admin = $is_admin;
    }
    public function setUser() {
        $sql = "INSERT INTO users (firstname, lastname, username, email, password, is_admin) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$this->firstname, $this->lastname, $this->username, $this->email, $this->password, $this->is_admin]);

        return $this->dbconn->lastInsertId();
    }
    public function getUserByEmail($email) {
        $sql = 'SELECT * FROM users WHERE email = :email';
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function userExists($username, $email) {
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$username, $email]);
        return $stmt->rowCount() > 0;
    }
    public function updateUser($id) {
        $sql = "UPDATE users SET firstname = ?, lastname = ?, username = ?, email = ?, pwd = ? WHERE id = ?";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$this->firstname, $this->lastname, $this->username, $this->email, $this->password, $id]);
        return $stmt->rowCount() > 0;
    }
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount() > 0;
    }
    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->dbconn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
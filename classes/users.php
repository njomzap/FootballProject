<?php

require_once './includes/db_config.php';
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
}
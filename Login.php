<?php

require_once 'Database.php';

class Login {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function authenticate($username, $password) {
        $username = $this->db->escapeString($username);
        $password = $this->db->escapeString($password);
        
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $this->db->query($query);

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            return $user;
        } else {
            return false;
        }
    }
}

?>
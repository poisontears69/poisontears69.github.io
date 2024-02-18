<?php

class Database {
    private $db;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->db = new mysqli("localhost", "root", "", "user_auth");

        if($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function query($sql){
        if ($this->db->ping()) {
            return $this->db->query($sql);
        } else {
            $this->connect();
            return $this->db->query($sql);
        }
    }

    public function escapeString($string) {
        return $this->db->real_escape_string($string);
    }

    public function close() {
        if ($this->db) {
            $this->db->close();
        }
    }
}
?>
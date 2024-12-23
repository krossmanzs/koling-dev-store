<?php
require_once '../system/Database.php';

class AuthModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function checkLogin($username, $password) {
        $query = "SELECT * FROM users WHERE username = :username";
        $result = $this->db->query($query, ['username' => $username]);
        if (!empty($result) && password_verify($password, $result[0]['password'])) {
            return $result[0];
        }
        return false;
    }

    public function registerUser($name, $email, $username, $password) {
        $query = "INSERT INTO users (name, email, username, password, role) VALUES (:name, :email, :username, :password, 'member')";
        try {
            $this->db->query($query, [
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => $password,
            ]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

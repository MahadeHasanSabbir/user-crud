<?php
require_once('../config/db_config.php');

class Auth {
    private $connect;

    public function __construct() {
        $db = new DBConfig();
        $this->connect = $db->getConnection();
    }

    public function login($email, $password) {
        $query = $this->connect->prepare("SELECT ID, password FROM users WHERE email = ?");
        $query->bindParam(1, $email, PDO::PARAM_STR);
        $query->execute();

        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['ID'];
            return ['message' => 'Login successful', 'status' => 'true'];
        }
        return ['error' => 'Incorrect email or password', 'status' => 'false'];
    }

    public function logout() {
        session_unset();
        session_destroy();
        return ['message' => 'Logged out successfully', 'status' => 'true'];
    }

    public function isAuthenticated() {
        return isset($_SESSION['id']);
    }
}
?>
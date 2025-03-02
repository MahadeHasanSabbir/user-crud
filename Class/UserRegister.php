<?php
include_once('./config/db_config.php');

class Register {
    private $connect;

    public function __construct() {
        $db = new DBConfig();
        $this->connect = $db->getConnection();
    }

    public function register($name, $email, $address, $password) {
        try {
            $query = $this->connect->prepare("SELECT * FROM users WHERE email = ?");
            $query->bindParam(1, $email, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return ['error' => 'Email already registered', 'status' => 'false'];
            }

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $query = $this->connect->prepare("INSERT INTO users (name, password, email, address) VALUES (?, ?, ?, ?)");
            $query->bindParam(1, $name, PDO::PARAM_STR);
            $query->bindParam(2, $hashedPassword, PDO::PARAM_STR);
            $query->bindParam(3, $email, PDO::PARAM_STR);
            $query->bindParam(4, $address, PDO::PARAM_STR);
            $query->execute();

            $this->connect = null;
            return ['message' => 'User registered successfully', 'status' => 'true'];
        } catch (PDOException $e) {
            return ['error' => 'An error occurred: ' . $e->getMessage(), 'status' => 'false'];
        }
    }
}
?>

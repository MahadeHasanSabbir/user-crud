<?php
require_once('./config/db_config.php');

class UserUpdate {
    private $connect;

    public function __construct() {
        $db = new DBConfig();
        $this->connect = $db->getConnection();
    }

    public function passUpdate($userId, $oldpass, $newpass) {
        $newpassHashed = password_hash($newpass, PASSWORD_BCRYPT);

        $query = $this->connect->prepare("SELECT password FROM users WHERE ID = ?");
        $query->bindParam(1, $userId, PDO::PARAM_INT);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($oldpass, $row['password'])) {
            $query = $this->connect->prepare("UPDATE users SET password = ? WHERE ID = ?");
            $query->bindParam(1, $newpassHashed);
            $query->bindParam(2, $userId);
            $query->execute();
            $this->connect = null;

            return ['message' => 'Password updated successfully', 'status' => 'true'];
        } else {
            return ['error' => 'Incorrect old password', 'status' => 'false'];
        }
    }

    public function infoUpdate($userId, $name, $email, $address) {
        $query = $this->connect->prepare("UPDATE users SET name = ?, email = ?, address = ? WHERE ID = ?");
        $query->bindParam(1, $name, PDO::PARAM_STR);
        $query->bindParam(2, $email, PDO::PARAM_STR);
        $query->bindParam(3, $address, PDO::PARAM_STR);
        $query->bindParam(4, $userId, PDO::PARAM_INT);
        $query->execute();
        $this->connect = null;

        return ['message' => 'User information updated successfully', 'status' => 'true'];
    }

    public function userDelete($userId) {
        $query = $this->connect->prepare("DELETE FROM users WHERE ID = ?");
        $query->bindParam(1, $userId, PDO::PARAM_INT);
        $query->execute();
        $this->connect = null;

        return ['message' => 'User deleted successfully', 'status' => 'true'];
    }
}
?>

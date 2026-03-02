<?php
require_once('../config/db_config.php');

class Admin
{
    private $connect;

    public function __construct()
    {
        $db = new DBConfig();
        $this->connect = $db->getConnection();
    }

    public function deleteUser($id)
    {
        try {
            $query = $this->connect->prepare("DELETE FROM users WHERE ID = ? AND role != 'admin'");
            $query->bindParam(1, $id, PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) {
            error_log("Admin deleteUser failed: " . $e->getMessage());
            return false;
        }
    }

    public function toggleStatus($id, $currentStatus)
    {
        try {
            $newStatus = ($currentStatus === 'active') ? 'inactive' : 'active';
            $query = $this->connect->prepare("UPDATE users SET status = ? WHERE ID = ? AND role != 'admin'");
            $query->bindParam(1, $newStatus, PDO::PARAM_STR);
            $query->bindParam(2, $id, PDO::PARAM_INT);
            return $query->execute();
        } catch (PDOException $e) {
            error_log("Admin toggleStatus failed: " . $e->getMessage());
            return false;
        }
    }

    public function getStats()
    {
        $stats = ['total_users' => 0, 'active_users' => 0, 'admins' => 0];

        try {
            $query = $this->connect->prepare("SELECT COUNT(*) as total FROM users");
            $query->execute();
            $stats['total_users'] = $query->fetch(PDO::FETCH_ASSOC)['total'];

            $query = $this->connect->prepare("SELECT COUNT(*) as active FROM users WHERE status = 'active'");
            $query->execute();
            $stats['active_users'] = $query->fetch(PDO::FETCH_ASSOC)['active'];

            $query = $this->connect->prepare("SELECT COUNT(*) as admins FROM users WHERE role = 'admin'");
            $query->execute();
            $stats['admins'] = $query->fetch(PDO::FETCH_ASSOC)['admins'];
        } catch (PDOException $e) {
            error_log("Admin getStats failed: " . $e->getMessage());
        }

        return $stats;
    }
}
?>
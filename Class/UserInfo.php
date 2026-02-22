<?php
require_once('../config/db_config.php');

class UserInfo
{
	private $connect;

	public function __construct()
	{
		$db = new DBConfig();
		$this->connect = $db->getConnection();
	}

	public function profileView()
	{
		try {
			$query = $this->connect->prepare("SELECT ID, name, email, address, role, status, created_at FROM users WHERE ID = ?");
			$query->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
			$query->execute();

			$result = $query->fetch(PDO::FETCH_ASSOC);
			$this->connect = null;
			return $result;
		} catch (PDOException $e) {
			error_log("UserInfo profileView failed: " . $e->getMessage());
			return null;
		}
	}

	public function userView()
	{
		try {
			$query = $this->connect->prepare("SELECT ID, name, email, address, role, status, created_at FROM users ORDER BY created_at DESC");
			$query->execute();

			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			$this->connect = null;
			return $result;
		} catch (PDOException $e) {
			error_log("UserInfo userView failed: " . $e->getMessage());
			return [];
		}
	}
}
?>
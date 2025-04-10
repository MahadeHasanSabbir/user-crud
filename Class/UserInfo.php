<?php
	require_once('../config/db_config.php');

	class UserInfo{
		private $connect;

		public function __construct(){
			$db = new DBConfig();
			$this->connect = $db->getConnection();
		}

		public function profileView(){
			$query = $this->connect->prepare("SELECT ID, name, email, address FROM users WHERE ID = ?");
			$query->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
			$query->execute();
			
			$result = $query->fetch(PDO::FETCH_ASSOC);
			$this->connect = null;

			return $result;
		}

		public function userView(){
			$query = $this->connect->prepare("SELECT ID, name, email, address FROM users");
			$query->execute();

			$result = $query->fetchAll(PDO::FETCH_ASSOC);
			$this->connect = null;

			return $result;
		}
	}
?>
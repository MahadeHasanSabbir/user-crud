<?php
    include_once('../config/db_config.php');
	
	class Register{
		private $connect;

		public function __construct() {
			$db = new DBConfig();
			$this->connect = $db->getConnection();
		}

		public function register(){
			$name = $_POST['name'];
			$email = $_POST['email'];
			$address = $_POST['address'];
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

			try {
				$query = $this->connect->prepare("INSERT INTO users (name, password, email, address) VALUES (?, ?, ?, ?)");
				$query->bindParam(1, $name, PDO::PARAM_STR);
				$query->bindParam(2, $password, PDO::PARAM_STR);
				$query->bindParam(3, $email, PDO::PARAM_STR);
				$query->bindParam(4, $address, PDO::PARAM_STR);
				$query->execute();

				$this->connect = null;

				header("location:../Views/log.php");
				exit;
			} catch (PDOException $e) {
				echo "Error: " . $e->getMessage();
				exit;
			}
		}
	}
	
?>
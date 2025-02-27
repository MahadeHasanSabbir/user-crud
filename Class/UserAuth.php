<?php
	require_once('../config/db_config.php');

	class Auth{
		private $connect;

		public function __construct(){
			$db = new DBConfig();
			$this->connect = $db->getConnection();
		}
		public function need(){
			if (!isset($_SESSION['id'])) {
				$_SESSION['error'] = "Authentication required";
				header('location:../Views/log.php');
				exit;
			}
		}
		public function login(){
			if(isset($_POST['email']) && isset($_POST['password'])) {
				$email = $_POST['email'];
				$password = $_POST['password'];

				$query = $this->connect->prepare("SELECT ID, password FROM users WHERE email = ?");
				try {
					$query->bindParam(1, $email, PDO::PARAM_STR);
					$query->execute();
					
					$row = $query->fetch(PDO::FETCH_ASSOC);

					if($row) {
						if(password_verify($password, $row['password'])) {
							$_SESSION['id'] = $row['ID'];
							$this->connect = null;
							header('location:../Views/profile.php');
							exit;
						} else {
							$_SESSION['error'] = 'Incorrect password';
							$this->connect = null;
							header('location:../Views/log.php');
							exit;
						}
					} else {
						$_SESSION['error'] = 'User not found';
					}	
				} catch (PDOException $e) {
					$_SESSION['error'] = 'An error occurred while processing your request. Please try again.';
				}
				
					$this->connect = null;
					header('location:../Views/log.php');
					exit;
			} else {
				$this->connect = null;
				$_SESSION['error'] = 'Please enter both email and password';
				header('location:../Views/log.php');
				exit;
			}			
		}

		public function logout() {
			session_unset();
			session_destroy();
			
			session_start();
			$_SESSION['success'] = "You have logged out successfully.";
	
			header('Location: ../Views/log.php');
			exit();
		}
	}


?>

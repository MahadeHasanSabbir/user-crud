<?php
    require_once('../config/db_config.php');

	class UserUpdate{
        private $connect;

		public function __construct(){
			$db = new DBConfig();
			$this->connect = $db->getConnection();
		}

        public function passUpdate(){
            $oldpass = $_POST['oldpass'];
            $newpass = password_hash($_POST['newpass'], PASSWORD_BCRYPT);

            $query = $this->connect->prepare("SELECT password FROM users WHERE ID = ?");
            $query->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
            $query->execute();
            $row = $query->fetch(PDO::FETCH_ASSOC);

            if (password_verify($oldpass, $row['password'])) {
                $query = $this->connect->prepare("UPDATE users SET password = ? WHERE ID = ?");
                $query->bindParam(1, $newpass);
                $query->bindParam(2, $_SESSION['id']);
                $query->execute();
                $this->connect = null;

                $_SESSION['success'] = "Password updated successfully!";
                header("location:../Views/update.php");
                exit;
                exit;
            } else {
                $_SESSION['error'] = "Incorrect old password";
                $this->connect = null;
                header("location:../Views/update.php");
                exit;
            }
        }

        public function infoUpdate(){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $address = $_POST['address'];

            $query = $this->connect->prepare("UPDATE users SET name = ?, email = ?, address = ? WHERE ID = ?");
            $query->bindParam(1, $name, PDO::PARAM_STR);
            $query->bindParam(2, $email, PDO::PARAM_STR);
            $query->bindParam(3, $address, PDO::PARAM_STR);
            $query->bindParam(4, $_SESSION['id'], PDO::PARAM_INT);
            $query->execute();
            $this->connect = null;

            $_SESSION['success'] = "Information updated successfully!";
            header("location:../Views/update.php");
            exit;
        }

        public function userDelete($id){
            $query = $this->connect->prepare("DELETE FROM users WHERE ID = ?");
            $query->bindParam(1, $id, PDO::PARAM_INT);
            $query->execute();

            $this->connect = null;
            header('location:../Views/users.php');
            exit;
        }
    }
?>
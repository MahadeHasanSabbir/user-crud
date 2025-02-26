<?php
	session_start();
	require_once('../config/dbconfig.php');

	if(isset($_POST['email']) && isset($_POST['password'])) {
		$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		$password = mysqli_real_escape_string($mysqli, $_POST['password']);

		$sql = "SELECT password FROM users WHERE email = '$email'";

		$result = mysqli_query($mysqli, $sql);

		$row = mysqli_fetch_assoc($result);

		if($row) {
			if(password_verify($password, $row['password'])) {
				$query = "SELECT ID FROM users WHERE email = '$email'";
				$userdata = mysqli_query($mysqli, $query);
				$user = mysqli_fetch_assoc($userdata);
				$_SESSION['id'] = $user['ID'];
				mysqli_close($mysqli);
				header('location:../Views/Profile.php');
				exit;
			} else {
				$_SESSION['error'] = 'Incorrect password';
				mysqli_close($mysqli);
				header('location:../Views/log.php');
				exit;
			}
		} else {
			$_SESSION['error'] = 'User not found';
			mysqli_close($mysqli);
			header('location:../Views/log.php');
			exit;
		}
	} else {
		mysqli_close($mysqli);
		echo "error";
		/* header('location:./');
		exit; */
	}
?>

<?php
    require_once('../config/dbconfig.php');

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$name = mysqli_real_escape_string($mysqli, $_POST['name']);
		$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		$address = mysqli_real_escape_string($mysqli, $_POST['address']);
		$password = password_hash(mysqli_real_escape_string($mysqli, $_POST['password']), PASSWORD_BCRYPT);

		$sqlquery = "INSERT INTO users (name, password, email, address) VALUES ('$name', '$password', '$email', '$address')";

		mysqli_query($mysqli, $sqlquery) or die("Failed to upload data!");
		mysqli_close($mysqli);

		header("location:../Views/log.php");
	}
	else{
        mysqli_close($mysqli);
		header("location:./");
		exit;
	}
?>
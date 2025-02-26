<?php
    session_start();
    require_once('../config/dbconfig.php');

	
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['newpass'])) {
        $oldpass = mysqli_real_escape_string($mysqli, $_POST['oldpass']);
        $newpass = password_hash(mysqli_real_escape_string($mysqli, $_POST['newpass']), PASSWORD_BCRYPT);

        $query = "SELECT password FROM users WHERE ID = '$_SESSION[id]'";
		$result = mysqli_query($mysqli, $query);
		$row = mysqli_fetch_assoc($result);

        if(password_verify($oldpass, $row['password'])) {
            $query = "UPDATE users SET password = '$newpass' WHERE ID = '$_SESSION[id]'";
            mysqli_query($mysqli, $query) or die("Failed to update data!");
            mysqli_close($mysqli);
            header("location:../Views/profile.php");
            exit;
        } else {
            $_SESSION['error'] = 'Incorrect password';
            mysqli_close($mysqli);
            header("location:../Views/profile.php");
            exit;
        }
    }
    elseif($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		$name = mysqli_real_escape_string($mysqli, $_POST['name']);
		$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		$address = mysqli_real_escape_string($mysqli, $_POST['address']);

		$query = "UPDATE users SET name = '$name', email = '$email', address = '$address' WHERE ID = '$_SESSION[id]'";

		mysqli_query($mysqli, $query) or die("Failed to update data!");
		mysqli_close($mysqli);

		header("location:../Views/profile.php");
        exit;
	}
	else{
        mysqli_close($mysqli);
		$_SESSION['error'] = "Authentication required";
        header('location:../Views/log.php');
        exit;
	}
?>
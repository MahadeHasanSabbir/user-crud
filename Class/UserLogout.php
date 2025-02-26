<?php
	session_start();
	if(isset($_SESSION)){

		$_SESSION[] = array();
		session_destroy();

		header("location:../Views/log.php");
		exit;
	}
	else{
		$_SESSION['error'] = "Authentication required";
        header('location:../Views/log.php');
		exit;
	}
?>
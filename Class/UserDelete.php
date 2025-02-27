<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        $_SESSION['error'] = "Authentication required";
        header('location:../Views/log.php');
        exit;
    }
    require_once('../config/dbconfig.php');

    $query = $connect->prepare("DELETE FROM users WHERE ID = ?");
    $query->bindParam(1, $_GET['id'], PDO::PARAM_INT);
    $query->execute();

    $connect = null;
    header('location:../Views/users.php');
    exit;
?>
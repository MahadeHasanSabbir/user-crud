<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        $_SESSION['error'] = "Authentication required";
        header('location:../Views/log.php');
        exit;
    }
    require_once('../config/dbconfig.php');

    $query = "DELETE FROM users WHERE ID = '$_GET[id]'";
    mysqli_query($mysqli, $query);

    header('location:../Views/users.php');
    exit;
?>
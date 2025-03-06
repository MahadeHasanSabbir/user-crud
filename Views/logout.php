<?php
    session_start();
    require_once('../Class/UserAuth.php');

    $auth = new Auth();

    $auth->need();

    $auth->logout();
    
?>

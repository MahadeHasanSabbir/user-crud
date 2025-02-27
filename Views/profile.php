<?php
    session_start();
    require_once('../Class/UserAuth.php');
    require_once('../Class/UserInfo.php');
    $auth = new Auth();
    $auth->need();
    $userinfo = new UserInfo();
    $user = $userinfo->profileView();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $user['name'];?> | Profile</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include 'header.php';?>
        <div style="padding: 5px; margin-top:10px;">
            <b>User ID</b>: <span><?php echo $user['ID'];?></span><br><hr>
            <b>User Name</b>: <span><?php echo $user['name'];?></span><br><hr>
            <b>User Email</b>: <span><?php echo $user['email'];?></span><br><hr>
            <b>User Address</b>: <span><?php echo $user['address'];?></span><br><hr>
            <b>Action</b>: <button type="button"><a href="./update.php">Update</a></button>
        </div>
    </body>
</html>

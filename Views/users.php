<?php
    session_start();
    require_once('../Class/UserAuth.php');
    require_once('../Class/UserInfo.php');
    require_once('../Class/UserUpdate.php');
    $auth = new Auth();
    $auth->need();
    $userInfo = new UserInfo();
    $userdata = $userInfo->userView();
    $update = new UserUpdate();
    if (isset($_POST['delete_id'])) {
        $update->userDelete($_POST['delete_user_id']);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Profile</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include 'header.php';?>
        <div>
            <?php
                if (count($userdata) > 0) {
            ?>
                <table border="1" cellpadding="10" cellspacing="0" style="width: 80%; margin: 20px auto; border-collapse: collapse;">
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            <?php
                    foreach ($userdata as $user) {
                        echo '<tr>';
                        echo '<td>' . $user['ID'] . '</td>';
                        echo '<td>' . $user['name'] . '</td>';
                        echo '<td>' . $user['email'] . '</td>';
                        echo '<td>' . $user['address'] . '</td>';
                        if($user['ID'] == $_SESSION['id']){
                            echo '<td>Yourself</td>';
                        }
                        else{
                            echo '<td>';
                            echo '<form method="POST" action="./users.php">';
                            echo '<input type="hidden" name="delete_id" value="' . $user['ID'] . '">';
                            echo '<button type="submit">Delete</button>';
                            echo '</form>';
                            echo '</td>';
                        }
                        
                        echo '</tr>';
                    }
                    echo '</table>';
                }
            ?>
        </div>
    </body>
</html>
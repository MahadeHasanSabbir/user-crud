<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        $_SESSION['error'] = "Authentication required";
        header('location:../Views/log.php');
        exit;
    }
    require_once('../config/dbconfig.php');
    $query = "SELECT * FROM users";
	$userdata = mysqli_query($mysqli, $query);
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
                if (mysqli_num_rows($userdata) > 0) {
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
                    while ($user = mysqli_fetch_assoc($userdata)) {
                        echo '<tr>';
                        echo '<td>' . $user['ID'] . '</td>';
                        echo '<td>' . $user['name'] . '</td>';
                        echo '<td>' . $user['email'] . '</td>';
                        echo '<td>' . $user['address'] . '</td>';
                        if($user['ID'] == $_SESSION['id']){
                            echo '<td>Your self</td>';
                        }
                        else{
                            echo '<td><button><a href="../Class/UserDelete.php?id='. $user['ID'] .'">Delete</a></button></td>';
                        }
                        
                        echo '</tr>';
                    }
                    echo '</table>';
                }
            ?>
        </div>
    </body>
</html>
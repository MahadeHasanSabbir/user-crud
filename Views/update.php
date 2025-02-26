<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        $_SESSION['error'] = "Authentication required";
        header('location:../Views/log.php');
        exit;
    }
    require_once('../config/dbconfig.php');
    $query = "SELECT * FROM users WHERE ID = '$_SESSION[id]'";
	$userdata = mysqli_query($mysqli, $query);
	$user = mysqli_fetch_assoc($userdata);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User registration</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include 'header.php'?>
        <div style="display: grid;align-content: center;justify-items: center;justify-content: center;min-height: 90vh;">
            <div>
                <h3>User information</h3>
                <form action="../Class/UserUpdate.php" method="post">
                    <input type="text" name="name" id="name" placeholder="Name" value="<?php echo $user['name'];?>" required><br>
                    <input type="email" name="email" id="email" placeholder="Email" value="<?php echo $user['email'];?>" required><br>
                    <input type="text" name="address" id="address" placeholder="Address" value="<?php echo $user['address'];?>" required><br>
                    <button type="submit">Update</button>
                </form>
                
            </div>
            <?php
                if(isset($_SESSION['error'])){
                    echo "<div style='color: red;'>".$_SESSION['error']."</div>";
                }
            ?>
            <div>
                <h3>User password</h3>
                <form action="../Class/UserUpdate.php" method="post">
                    <input type="password" name="oldpass" id="oldpass" placeholder="Old password" required><br>
                    <input type="password" name="newpass" id="newpass" placeholder="New password" required><br>
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </body>
</html>

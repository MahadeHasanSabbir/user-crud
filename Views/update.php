<?php
    session_start();
    require_once('../Class/UserAuth.php');
    require_once('../Class/UserInfo.php');
    require_once('../Class/UserUpdate.php');
    $auth = new Auth();
    $auth->need();
    $userInfo = new UserInfo();
    $user = $userInfo->profileView();
    $update = new UserUpdate();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['newpass'])) {
        $update->passUpdate();
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $update->infoUpdate();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $user['name'];?> | Profile Update</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include 'header.php'?>
        <div style="display: grid;align-content: center;justify-items: center;justify-content: center;min-height: 90vh;">
            <?php
                if(isset($_SESSION['success'])){
                    echo "<div style='color: green;'>".$_SESSION['success']."</div>";
                    unset($_SESSION['success']);
                }
            ?>
            <div>
                <h3>User information</h3>
                <form action="./update.php" method="post">
                    <input type="text" name="name" id="name" placeholder="Name" value="<?php echo $user['name'];?>" required><br>
                    <input type="email" name="email" id="email" placeholder="Email" value="<?php echo $user['email'];?>" required><br>
                    <input type="text" name="address" id="address" placeholder="Address" value="<?php echo $user['address'];?>" required><br>
                    <button type="submit">Update</button>
                </form>
                
            </div>
            <?php
                if(isset($_SESSION['error'])){
                    echo "<div style='color: red;'>".$_SESSION['error']."</div>";
                    unset($_SESSION['error']);
                }
            ?>
            <div>
                <h3>User password</h3>
                <form action="./update.php" method="post">
                    <input type="password" name="oldpass" id="oldpass" placeholder="Old password" required><br>
                    <input type="password" name="newpass" id="newpass" placeholder="New password" required><br>
                    <button type="submit">Update</button>
                </form>
            </div>
        </div>
    </body>
</html>

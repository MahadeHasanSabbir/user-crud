<?php
    session_start();
    require_once('../Class/UserAuth.php');

    $auth = new Auth();

    $auth->has();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $auth->login();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User log in</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include 'header.php' ?>
        <div style="display: grid;align-content: center;justify-items: center;justify-content: center;min-height: 90vh;">
            <?php
                if(isset($_SESSION['error'])){
                    echo "<div style='color: red;'>".$_SESSION['error']."</div>";
                    unset($_SESSION['error']);
                }
                if(isset($_SESSION['success'])){
                    echo "<div style='color: green;'>".$_SESSION['success']."</div>";
                    unset($_SESSION['success']);
                }
            ?>
            <h3>Log in</h3>
            
            <form action="log.php" method="post">
                <input type="email" name="email" id="email" placeholder="Email" required><br><br>
                <input type="password" name="password" id="password" placeholder="Password" required><br><br>
                <button type="submit">log-in</button>
            </form>
        </div>
    </body>
</html>

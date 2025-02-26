<?php
    session_start();
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
            <h3>Log in</h3>
            <?php
                if(isset($_SESSION['error'])){
                    echo "<div style='color: red;'>".$_SESSION['error']."</div>";
                }
                if(isset($_SESSION['success'])){
                    echo "<div style='color: green;'>".$_SESSION['success']."</div>";
                }
                $_SESSION[] = array();
                session_destroy();
            ?>
            <!-- User Register Form -->
            <form action="../Class/UserLogin.php" method="post">
                <input type="email" name="email" id="email" placeholder="Email" required><br>
                <input type="password" name="password" id="password" placeholder="Password" required><br>
                <button type="submit">log-in</button>
            </form>
        </div>
    </body>
</html>

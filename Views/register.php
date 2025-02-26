<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User registration</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php include 'header.php' ?>
        <div style="display: grid;align-content: center;justify-items: center;justify-content: center;min-height: 90vh;">
            <h3>User Registration</h3>
            
            <!-- User Register Form -->
            <form action="../Class/UserRegister.php" method="post">
                <input type="text" name="name" id="name" placeholder="Name" required><br>
                <input type="email" name="email" id="email" placeholder="Email" required><br>
                <input type="text" name="address" id="address" placeholder="Address" required><br>
                <input type="password" name="password" id="password" placeholder="Password" required><br>
                <button type="submit">Register</button>
            </form>
        </div>
    </body>
</html>

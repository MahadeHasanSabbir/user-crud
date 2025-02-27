<nav>
    <ul class="navbar">
        <?php
            if (isset($_SESSION['id'])) {
        ?>
        <li><a href="./profile.php" class="<?php basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>">Dashboard</a></li>
        <li><a href="./users.php" class="<?php basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : ''; ?>">Users</a></li>
        <li style="float:right"><a href="./logout.php" class="<?php basename($_SERVER['PHP_SELF']) == 'UserLogout.php' ? 'active' : ''; ?>">Log out</a></li>
        <?php
            }
            else {
        ?>
        <li><a href="./index.php" class="<?php basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a></li>
        <li style="float:right"><a href="./log.php" class="<?php basename($_SERVER['PHP_SELF']) == 'log.php' ? 'active' : ''; ?>">Log in</a></li>
        <li style="float:right"><a href="./register.php" class="<?php basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active' : ''; ?>">Register</a></li>
        <?php
            }
        ?>
    </ul>
</nav>

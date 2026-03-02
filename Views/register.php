<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../Class/UserRegister.php');
require_once('../Class/UserAuth.php');

$auth = new Auth();
$auth->has();

$register = new Register();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $register->register();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | UserFlow</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include 'header.php' ?>

    <main class="container auth-container">
        <div class="glass-card auth-card animate-fade-in" style="max-width: 520px;">
            <header class="auth-header">
                <h1 class="stagger-1">Join Community</h1>
                <p class="stagger-2">Create your account and start managing with style</p>
            </header>

            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" class="form-input" placeholder="Ex: John Doe" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-input" placeholder="name@domain.com"
                        required>
                </div>
                <div class="form-group">
                    <label for="address">Location / Address</label>
                    <input type="text" name="address" id="address" class="form-input" placeholder="City, Country"
                        required>
                </div>
                <div class="form-group" style="margin-bottom: 2.5rem;">
                    <label for="password">Secure Password</label>
                    <input type="password" name="password" id="password" class="form-input" placeholder="••••••••"
                        required>
                </div>
                <button type="submit" class="btn btn-primary"
                    style="width: 100%; padding: 1.1rem; font-size: 1rem;">Create Account</button>
            </form>

            <footer style="text-align: center; margin-top: 2.5rem; color: var(--text-secondary); font-size: 0.95rem;">
                Already have an account? <a href="log.php"
                    style="color: var(--primary); text-decoration: none; font-weight: 700;">Sign in</a>
            </footer>
        </div>
    </main>
</body>

</html>
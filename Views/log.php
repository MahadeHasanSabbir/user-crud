<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../Class/UserAuth.php');
$auth = new Auth();
$auth->has();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auth->login();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | UserFlow</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include 'header.php' ?>

    <main class="container auth-container">
        <div class="glass-card auth-card animate-fade-in">
            <header class="auth-header">
                <h1 class="stagger-1">Welcome Back</h1>
                <p class="stagger-2">Enter your credentials to access your dashboard</p>
            </header>

            <?php if (isset($_SESSION['error'])): ?>
                <div
                    style="background: rgba(239, 68, 68, 0.1); border: 1px solid var(--danger); color: var(--danger); padding: 1rem; border-radius: var(--radius-md); margin-bottom: 2rem; text-align: center; font-size: 0.9rem;">
                    <?php echo $_SESSION['error'];
                    unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div
                    style="background: rgba(0, 242, 145, 0.1); border: 1px solid var(--success); color: var(--success); padding: 1rem; border-radius: var(--radius-md); margin-bottom: 2rem; text-align: center; font-size: 0.9rem;">
                    <?php echo $_SESSION['success'];
                    unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <form action="log.php" method="post">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" class="form-input" placeholder="name@company.com"
                        required>
                </div>
                <div class="form-group" style="margin-bottom: 2.5rem;">
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.6rem;">
                        <label for="password" style="margin-bottom: 0;">Password</label>
                        <a href="#" style="color: var(--primary); font-size: 0.8rem; text-decoration: none;">Forgot
                            password?</a>
                    </div>
                    <input type="password" name="password" id="password" class="form-input" placeholder="••••••••"
                        required>
                </div>
                <button type="submit" class="btn btn-primary"
                    style="width: 100%; padding: 1.1rem; font-size: 1rem;">Sign In</button>
            </form>

            <footer style="text-align: center; margin-top: 2.5rem; color: var(--text-secondary); font-size: 0.95rem;">
                New to UserFlow? <a href="register.php"
                    style="color: var(--primary); text-decoration: none; font-weight: 700;">Join now</a>
            </footer>
        </div>
    </main>
</body>

</html>
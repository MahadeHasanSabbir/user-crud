<?php
require_once('../Class/UserAuth.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$auth = new Auth();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserFlow | Modern User Management</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include 'header.php' ?>

    <main class="container">
        <section class="animate-fade-in" style="text-align: center; margin-top: 8rem; padding-bottom: 5rem;">
            <div class="animate-float"
                style="display: inline-block; padding: 0.5rem 1.2rem; background: var(--glass-bg); border: 1px solid var(--glass-border); border-radius: 100px; color: var(--primary); font-size: 0.85rem; font-weight: 600; margin-bottom: 2rem;">
                🚀 Experience the Future of Management
            </div>
            <h1 class="stagger-1"
                style="font-size: 4.5rem; font-weight: 800; margin-bottom: 2rem; line-height: 1.1; letter-spacing: -2px;">
                Master Your Data with <br>
                <span
                    style="background: var(--brand-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Premium
                    UserFlow</span>
            </h1>
            <p class="stagger-2"
                style="color: var(--text-secondary); font-size: 1.3rem; max-width: 800px; margin: 0 auto 3.5rem; line-height: 1.6;">
                A sophisticated, state-of-the-art user management ecosystem. Built for security, designed for elegance,
                and optimized for performance.
            </p>

            <div class="stagger-3" style="display: flex; gap: 1.5rem; justify-content: center; align-items: center;">
                <?php if (!isset($_SESSION['id'])): ?>
                    <a href="register.php" class="btn btn-primary"
                        style="font-size: 1.1rem; padding: 1.25rem 3rem; border-radius: 100px;">Get Started Free</a>
                    <a href="log.php" class="btn btn-outline"
                        style="font-size: 1.1rem; padding: 1.25rem 3rem; border-radius: 100px;">Sign In Now</a>
                <?php else: ?>
                    <a href="<?php echo $_SESSION['role'] === 'admin' ? 'admin_dashboard.php' : 'profile.php'; ?>"
                        class="btn btn-primary" style="font-size: 1.1rem; padding: 1.25rem 3rem; border-radius: 100px;">
                        Return to Dashboard
                    </a>
                <?php endif; ?>
            </div>

            <div class="stagger-4"
                style="margin-top: 6rem; display: flex; justify-content: center; gap: 4rem; opacity: 0.5;">
                <div style="text-align: center;">
                    <div style="font-size: 1.5rem; font-weight: 700;">Secure</div>
                    <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">AES-256</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 1.5rem; font-weight: 700;">Fast</div>
                    <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">&lt; 50ms</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 1.5rem; font-weight: 700;">Elegant</div>
                    <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Modern UI</div>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
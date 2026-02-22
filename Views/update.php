<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $update->infoUpdate();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | UserFlow</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include 'header.php' ?>

    <main class="container" style="max-width: 1000px;">
        <header style="margin-bottom: 3.5rem;">
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.75rem;">
                <a href="profile.php" style="color: var(--primary); text-decoration: none; font-size: 0.9rem;">← Back to
                    Profile</a>
            </div>
            <h1 style="font-size: 3rem; font-weight: 800; letter-spacing: -1.5px;">Account Settings</h1>
            <p style="color: var(--text-secondary); font-size: 1.1rem;">Customize your profile presence and system
                security</p>
        </header>

        <div style="display: grid; grid-template-columns: 1.4fr 1fr; gap: 2.5rem; align-items: start;">
            <!-- Profile Info Card -->
            <div class="glass-card animate-fade-in" style="padding: 3.5rem;">
                <h3 style="margin-bottom: 2.5rem; font-size: 1.5rem; font-weight: 700;">Identity Details</h3>

                <?php if (isset($_SESSION['success']) && !isset($_POST['newpass'])): ?>
                    <div
                        style="background: rgba(0, 242, 145, 0.1); border: 1px solid var(--success); color: var(--success); padding: 1.25rem; border-radius: var(--radius-md); margin-bottom: 2.5rem; font-size: 0.9rem;">
                        ✨ Profile updated successfully.
                        <?php unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <form action="./update.php" method="post">
                    <div class="form-group">
                        <label for="name">Preferred Display Name</label>
                        <input type="text" name="name" id="name" class="form-input" value="<?php echo $user['name']; ?>"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="email">Account Communication Email</label>
                        <input type="email" name="email" id="email" class="form-input"
                            value="<?php echo $user['email']; ?>" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 2.5rem;">
                        <label for="address">Primary Physical Address</label>
                        <input type="text" name="address" id="address" class="form-input"
                            value="<?php echo $user['address']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary"
                        style="width: 100%; padding: 1rem; border-radius: 100px;">Commit Changes</button>
                </form>
            </div>

            <!-- Security Card -->
            <div class="glass-card animate-fade-in"
                style="animation-delay: 0.1s; padding: 3.5rem; background: rgba(0,0,0,0.2);">
                <h3 style="margin-bottom: 2.5rem; font-size: 1.5rem; font-weight: 700;">Security Core</h3>

                <?php if (isset($_SESSION['error'])): ?>
                    <div
                        style="background: rgba(255, 77, 77, 0.1); border: 1px solid var(--danger); color: var(--danger); padding: 1.25rem; border-radius: var(--radius-md); margin-bottom: 2.5rem; font-size: 0.9rem;">
                        ⚠️ <?php echo $_SESSION['error'];
                        unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['success']) && isset($_POST['newpass'])): ?>
                    <div
                        style="background: rgba(0, 242, 145, 0.1); border: 1px solid var(--success); color: var(--success); padding: 1.25rem; border-radius: var(--radius-md); margin-bottom: 2.5rem; font-size: 0.9rem;">
                        🔒 Password hardened successfully.
                        <?php unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <form action="./update.php" method="post">
                    <div class="form-group">
                        <label for="oldpass">Current Access Key</label>
                        <input type="password" name="oldpass" id="oldpass" class="form-input" placeholder="••••••••"
                            required>
                    </div>
                    <div class="form-group" style="margin-bottom: 2.5rem;">
                        <label for="newpass">New Secure Key</label>
                        <input type="password" name="newpass" id="newpass" class="form-input" placeholder="••••••••"
                            required>
                    </div>
                    <button type="submit" class="btn btn-outline"
                        style="width: 100%; padding: 1rem; border-radius: 100px; border-color: var(--primary); color: var(--primary);">Rotate
                        Access Key</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('../Class/UserAuth.php');
require_once('../Class/UserInfo.php');
$auth = new Auth();
$auth->need();
$userinfo = new UserInfo();
$user = $userinfo->profileView();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $user['name']; ?> | Portfolio</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include 'header.php'; ?>

    <main class="container">
        <div class="glass-card animate-fade-in" style="max-width: 900px; margin: 2rem auto; padding: 4rem;">
            <div
                style="display: flex; flex-direction: column; align-items: center; text-align: center; margin-bottom: 4rem;">
                <div class="animate-float"
                    style="width: 140px; height: 140px; border-radius: 40px; background: linear-gradient(135deg, var(--primary) 0%, #c084fc 100%); display: flex; align-items: center; justify-content: center; font-size: 4rem; font-weight: 800; color: var(--text-primary); box-shadow: 0 20px 40px var(--primary-glow); margin-bottom: 2rem; transform: rotate(-5deg);">
                    <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                </div>
                <h1 class="stagger-1"
                    style="font-size: 3.5rem; font-weight: 800; letter-spacing: -2px; margin-bottom: 0.5rem;">
                    <?php echo $user['name']; ?>
                </h1>
                <p class="stagger-2" style="color: var(--text-secondary); font-size: 1.1rem; margin-bottom: 1.5rem;">
                    <?php echo $user['email']; ?>
                </p>
                <div class="stagger-3" style="display: flex; gap: 0.75rem; margin-bottom: 2.5rem;">
                    <span class="badge badge-<?php echo $user['role']; ?>"
                        style="padding: 0.6rem 1.2rem; font-size: 0.8rem;"><?php echo $user['role']; ?> Role</span>
                    <span class="badge badge-<?php echo $user['status']; ?>"
                        style="padding: 0.6rem 1.2rem; font-size: 0.8rem;">Status: <?php echo $user['status']; ?></span>
                </div>
                <div style="display: flex; gap: 1rem;">
                    <a href="update.php" class="btn btn-primary"
                        style="padding: 0.8rem 2.5rem; border-radius: 100px;">Optimize Settings</a>
                    <a href="users.php" class="btn btn-outline"
                        style="padding: 0.8rem 2.5rem; border-radius: 100px;">Explore People</a>
                </div>
            </div>

            <div
                style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; border-top: 1px solid var(--glass-border); padding-top: 3rem;">
                <div
                    style="background: var(--glass-bg); padding: 2rem; border-radius: var(--radius-lg); text-align: center; border: 1px solid var(--glass-border);">
                    <div
                        style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.75rem;">
                        Member Since</div>
                    <div style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary);">
                        <?php echo date('M Y', strtotime($user['created_at'])); ?>
                    </div>
                </div>
                <div
                    style="background: var(--glass-bg); padding: 2rem; border-radius: var(--radius-lg); text-align: center; border: 1px solid var(--glass-border);">
                    <div
                        style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.75rem;">
                        Current Location</div>
                    <div style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary);">
                        <?php echo $user['address']; ?>
                    </div>
                </div>
                <div
                    style="background: var(--glass-bg); padding: 2rem; border-radius: var(--radius-lg); text-align: center; border: 1px solid var(--glass-border);">
                    <div
                        style="font-size: 0.8rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.75rem;">
                        Global Token</div>
                    <div style="font-size: 1.25rem; font-weight: 700; color: var(--text-primary);">
                        #UF-<?php echo str_pad($user['ID'], 4, '0', STR_PAD_LEFT); ?></div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
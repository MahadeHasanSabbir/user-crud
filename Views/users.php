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
$userdata = $userInfo->userView();
$update = new UserUpdate();
if (isset($_POST['delete_id'])) {
    $update->userDelete($_POST['delete_id']); // Fixed the key name from 'delete_user_id' to 'delete_id'
    header("Location: users.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Directory | UserFlow</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include 'header.php'; ?>

    <main class="container">
        <header style="margin-bottom: 3.5rem; text-align: center;">
            <div
                style="display: inline-block; padding: 0.4rem 1rem; background: var(--glass-bg); border: 1px solid var(--glass-border); border-radius: 100px; color: var(--text-muted); font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1.5rem;">
                Collective Registry
            </div>
            <h1 style="font-size: 3rem; font-weight: 800; letter-spacing: -1.5px; margin-bottom: 1rem;">Community Index
            </h1>
            <p style="color: var(--text-secondary); font-size: 1.15rem; max-width: 600px; margin: 0 auto;">Connect with
                members across the entire UserFlow network.</p>
        </header>

        <section class="data-table-container animate-fade-in">
            <?php if (count($userdata) > 0): ?>
                <div style="overflow-x: auto;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Identity</th>
                                <th>Primary Location</th>
                                <th>Registered</th>
                                <th>State</th>
                                <th style="text-align: right;">Presence</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($userdata as $user): ?>
                                <tr>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 1.25rem;">
                                            <div
                                                style="width: 44px; height: 44px; border-radius: 14px; background: var(--glass-bg); display: flex; align-items: center; justify-content: center; font-weight: 700; border: 1px solid var(--glass-border); color: var(--primary);">
                                                <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                                            </div>
                                            <div>
                                                <div style="font-weight: 700; color: var(--text-primary); font-size: 1.05rem;">
                                                    <?php echo $user['name']; ?>
                                                </div>
                                                <div style="font-size: 0.8rem; color: var(--text-muted);">
                                                    <?php echo $user['email']; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="color: var(--text-secondary); font-size: 0.9rem;"><?php echo $user['address']; ?>
                                    </td>
                                    <td style="color: var(--text-muted); font-size: 0.9rem;">
                                        <?php echo date('M d, Y', strtotime($user['created_at'])); ?>
                                    </td>
                                    <td><span class="badge badge-<?php echo $user['status']; ?>"
                                            style="font-size: 0.65rem;"><?php echo $user['status']; ?></span></td>
                                    <td style="text-align: right;">
                                        <?php if ($user['ID'] == $_SESSION['id']): ?>
                                            <div
                                                style="background: var(--primary-glow); color: var(--primary); padding: 0.4rem 1rem; border-radius: 100px; display: inline-block; font-size: 0.75rem; font-weight: 800; border: 1px solid rgba(99, 102, 241, 0.2);">
                                                YOUR SESSION</div>
                                        <?php else: ?>
                                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                                                <form method="POST" action="./users.php" style="display: inline;"
                                                    onsubmit="return confirm('Terminate this user index?')">
                                                    <input type="hidden" name="delete_id" value="<?php echo $user['ID']; ?>">
                                                    <button type="submit" class="btn btn-danger"
                                                        style="padding: 0.5rem 1.2rem; font-size: 0.75rem; border-radius: 100px;">Revoke</button>
                                                </form>
                                            <?php else: ?>
                                                <div style="color: var(--text-muted); font-size: 0.8rem; font-weight: 500;">Active
                                                    Member</div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div style="text-align: center; padding: 4rem; color: var(--text-muted);">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">📭</div>
                    No registered identities discovered.
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>

</html>
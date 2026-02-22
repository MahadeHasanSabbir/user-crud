<?php
require_once('../Class/UserAuth.php');
require_once('../Class/UserInfo.php');
require_once('../Class/Admin.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$auth = new Auth();
$auth->protectAdmin();

$admin = new Admin();
$user_info = new UserInfo();
$stats = $admin->getStats();
$users = $user_info->userView();

// Handle status toggle
if (isset($_GET['toggle']) && isset($_GET['status'])) {
    $admin->toggleStatus($_GET['toggle'], $_GET['status']);
    header("Location: admin_dashboard.php");
    exit;
}

// Handle delete
if (isset($_GET['delete'])) {
    $admin->deleteUser($_GET['delete']);
    header("Location: admin_dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | UserFlow</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include 'header.php' ?>

    <main class="container">
        <header style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: flex-end;">
            <div>
                <nav
                    style="position: static; transform: none; background: none; backdrop-filter: none; border: none; padding: 0; box-shadow: none; margin-bottom: 0.5rem; width: auto;">
                    <span style="color: var(--text-muted); font-size: 0.85rem;">Admin / Dashboard</span>
                </nav>
                <h1 style="font-size: 2.8rem; font-weight: 800; letter-spacing: -1px;">System Overview</h1>
            </div>
            <div class="btn-group" style="display: flex; gap: 0.75rem;">
                <button class="btn btn-outline" style="padding: 0.7rem 1.4rem;">Export CSV</button>
                <button class="btn btn-primary" style="padding: 0.7rem 1.4rem;">+ New Member</button>
            </div>
        </header>

        <section class="stats-grid animate-fade-in">
            <div class="stat-item stagger-1">
                <h3>Total Users</h3>
                <p><?php echo number_format($stats['total_users']); ?></p>
                <div style="font-size: 0.75rem; color: var(--success); margin-top: 0.5rem;">↑ 4.2% from last month</div>
            </div>
            <div class="stat-item stagger-2">
                <h3>Active Today</h3>
                <p><?php echo number_format($stats['active_users']); ?></p>
                <div style="font-size: 0.75rem; color: var(--success); margin-top: 0.5rem;">↑ 1.5% from last month</div>
            </div>
            <div class="stat-item stagger-3">
                <h3>Privileged Users</h3>
                <p><?php echo number_format($stats['admins']); ?></p>
                <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 0.5rem;">Admin role access</div>
            </div>
            <div class="stat-item stagger-4"
                style="background: linear-gradient(135deg, var(--surface) 0%, rgba(99, 102, 241, 0.05) 100%);">
                <h3>System Health</h3>
                <p>99.9%</p>
                <div style="font-size: 0.75rem; color: var(--success); margin-top: 0.5rem;">● All services operational
                </div>
            </div>
        </section>

        <section class="data-table-container animate-fade-in" style="animation-delay: 0.2s;">
            <div
                style="padding: 1.5rem 2rem; border-bottom: 1px solid var(--glass-border); display: flex; justify-content: space-between; align-items: center; background: var(--glass-bg);">
                <h2 style="font-size: 1.25rem; font-weight: 700;">User Registry</h2>
                <div style="position: relative;">
                    <input type="text" placeholder="Quick search..."
                        style="background: var(--input-bg); border: 1px solid var(--glass-border); border-radius: 100px; padding: 0.5rem 1rem 0.5rem 2.5rem; color: var(--text-primary); font-size: 0.85rem; width: 240px;">
                    <div style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); opacity: 0.4;">🔍
                    </div>
                </div>
            </div>
            <div style="overflow-x: auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Member</th>
                            <th>Permission</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th style="text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <div
                                            style="width: 42px; height: 42px; border-radius: 12px; background: linear-gradient(135deg, var(--primary) 0%, #c084fc 100%); display: flex; align-items: center; justify-content: center; font-weight: 800; color: var(--text-primary); box-shadow: 0 4px 12px var(--primary-glow);">
                                            <?php echo strtoupper(substr($user['name'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <div style="font-weight: 600; color: var(--text-primary);">
                                                <?php echo $user['name']; ?>
                                            </div>
                                            <div style="font-size: 0.8rem; color: var(--text-muted);">
                                                <?php echo $user['email']; ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge badge-<?php echo $user['role']; ?>">
                                        <?php echo $user['role']; ?>
                                    </span></td>
                                <td><span class="badge badge-<?php echo $user['status']; ?>">
                                        <?php echo $user['status']; ?>
                                    </span></td>
                                <td style="color: var(--text-secondary); font-size: 0.85rem;">
                                    <?php echo date('M d, Y', strtotime($user['created_at'])); ?>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                        <a href="?toggle=<?php echo $user['ID']; ?>&status=<?php echo $user['status']; ?>"
                                            class="btn btn-outline"
                                            style="padding: 0.4rem 1rem; font-size: 0.8rem; border-radius: 8px;">
                                            <?php echo $user['status'] === 'active' ? 'Suspend' : 'Activate'; ?>
                                        </a>
                                        <a href="?delete=<?php echo $user['ID']; ?>" class="btn btn-danger"
                                            style="padding: 0.4rem 1rem; font-size: 0.8rem; border-radius: 8px;"
                                            onclick="return confirm('Archive this user session?')">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div
                style="padding: 1.25rem 2rem; background: var(--glass-bg); display: flex; justify-content: space-between; align-items: center; font-size: 0.85rem; color: var(--text-muted);">
                Showing <?php echo count($users); ?> active members
                <div style="display: flex; gap: 0.5rem;">
                    <button class="btn btn-outline"
                        style="padding: 0.3rem 0.8rem; font-size: 0.75rem;">Previous</button>
                    <button class="btn btn-outline" style="padding: 0.3rem 0.8rem; font-size: 0.75rem;">Next</button>
                </div>
            </div>
        </section>
    </main>
</body>

</html>
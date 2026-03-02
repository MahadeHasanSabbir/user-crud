<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<script>
    (function() {
        const theme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', theme);
    })();
</script>
<nav class="navbar">

    <a href="index.php" class="brand">UserFlow</a>
    <ul>
        <li><a href="index.php"
                class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a></li>
        <?php if (isset($_SESSION['id'])): ?>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <li><a href="admin_dashboard.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php' ? 'active' : ''; ?>">Admin</a>
                </li>
            <?php else: ?>
                <li><a href="profile.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>">Profile</a></li>
            <?php endif; ?>
            <li><a href="users.php"
                    class="<?php echo basename($_SERVER['PHP_SELF']) == 'users.php' ? 'active' : ''; ?>">Users</a></li>
        <?php endif; ?>
    </ul>
    <div class="nav-actions">
        <button onclick="toggleTheme()" class="theme-toggle" title="Toggle Theme" aria-label="Toggle Theme">
            <svg class="sun-icon" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="5"></circle>
                <line x1="12" y1="1" x2="12" y2="3"></line>
                <line x1="12" y2="21" x2="12" y2="23"></line>
                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                <line x1="1" y1="12" x2="3" y2="12"></line>
                <line x1="21" y1="12" x2="23" y2="12"></line>
                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
            </svg>
            <svg class="moon-icon" viewBox="0 0 24 24">
                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
            </svg>
        </button>
        <?php if (isset($_SESSION['id'])): ?>
            <a href="logout.php" class="btn btn-outline"
                style="padding: 0.5rem 1.2rem; font-size: 0.85rem; border-radius: 100px;">Logout</a>
        <?php else: ?>
            <a href="log.php" class="btn btn-outline" style="border: none; padding: 0.5rem 1rem;">Login</a>
            <a href="register.php" class="btn btn-primary"
                style="padding: 0.5rem 1.5rem; border-radius: 100px; font-size: 0.85rem;">Join Free</a>
        <?php endif; ?>
    </div>
</nav>
<script src="theme.js"></script>
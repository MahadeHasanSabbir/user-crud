<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once('Class/UserAuth.php');

$auth = new Auth();

echo "<h1>RBAC Verification Script</h1>";

// Test 1: Check if admin protection works
echo "<h2>Test 1: Admin Protection</h2>";
if ($auth->isAdmin()) {
    echo "<p style='color: green;'>PASS: User is an admin.</p>";
} else {
    echo "<p style='color: orange;'>INFO: User is not an admin (Current role: " . ($_SESSION['role'] ?? 'None') . ").</p>";
}

// Test 2: Database connectivity and schema
require_once('config/db_config.php');
$db = new DBConfig();
$conn = $db->getConnection();

echo "<h2>Test 2: Database Schema Check</h2>";
try {
    $result = $conn->query("DESCRIBE users");
    $columns = $result->fetchAll(PDO::FETCH_COLUMN);
    $required = ['role', 'status', 'created_at', 'updated_at'];
    $missing = array_diff($required, $columns);

    if (empty($missing)) {
        echo "<p style='color: green;'>PASS: All required columns exist in 'users' table.</p>";
    } else {
        echo "<p style='color: red;'>FAIL: Missing columns: " . implode(', ', $missing) . "</p>";
    }
} catch (PDOException $e) {
    echo "<p style='color: red;'>FAIL: Could not query database. " . $e->getMessage() . "</p>";
}

echo "<h2>Test 3: Admin User Check</h2>";
try {
    $query = $conn->prepare("SELECT * FROM users WHERE role = 'admin' LIMIT 1");
    $query->execute();
    $admin = $query->fetch();

    if ($admin) {
        echo "<p style='color: green;'>PASS: At least one admin user found (" . $admin['email'] . ").</p>";
    } else {
        echo "<p style='color: red;'>FAIL: No admin user found. Please run: <code>UPDATE users SET role = 'admin' WHERE id = (your_id);</code></p>";
    }
} catch (PDOException $e) {
    echo "<p style='color: red;'>FAIL: Error checking admin user. " . $e->getMessage() . "</p>";
}

echo "<hr><p><a href='Views/index.php'>Return to Home</a></p>";
?>
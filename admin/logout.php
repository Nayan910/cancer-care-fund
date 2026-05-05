<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Log the logout
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $session_id = $_SESSION['session_id'] ?? '';
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
    
    query("UPDATE admin_login_logs SET status = 'failed', login_time = NOW() 
          WHERE admin_id = ? AND session_id = ? AND status = 'success' 
          ORDER BY login_time DESC LIMIT 1", 
        [$admin_id, $session_id]);
}

// Destroy session
session_destroy();

// Redirect to login
header('Location: login.php');
exit();

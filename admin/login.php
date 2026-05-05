<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Session security - regenerate ID on login
session_regenerate_id(true);
$session_id = session_id();

// If already logged in, redirect to dashboard
if (isset($_SESSION['admin_id'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username && $password) {
        $result = query("SELECT * FROM admin_users WHERE username = ? AND is_active = 1", [$username]);
        $admin = $result->fetch_assoc();
        
        if ($admin && password_verify($password, $admin['password'])) {
            // Set session variables
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['full_name'] ?? $admin['username'];
            $_SESSION['admin_role'] = $admin['role'];
            $_SESSION['session_id'] = session_id(); // Track session ID
            $_SESSION['login_time'] = time();
            
            // Log the login with session ID
            $ip = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
            $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
            query("INSERT INTO admin_login_logs (admin_id, ip_address, user_agent, session_id, status) VALUES (?, ?, ?, ?, 'success')",
                [$admin['id'], $ip, substr($user_agent, 0, 255), session_id()]);
            
            // Update last login
            query("UPDATE admin_users SET last_login = NOW() WHERE id = ?", [$admin['id']]);
            
            header('Location: dashboard.php');
            exit();
        } else {
            $error = 'Invalid username or password';
        }
    } else {
        $error = 'Please enter both username and password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Cancer Care Funding</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body style="background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    
    <div style="width: 100%; max-width: 400px; padding: 20px;">
        <div style="background: white; padding: 3rem; border-radius: 12px; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
            
            <div style="text-align: center; margin-bottom: 2rem;">
                <h1 style="color: var(--primary); margin-bottom: 0.5rem;">Admin Login</h1>
                <p style="color: var(--text-light); font-size: 0.95rem;">Cancer Care Funding Platform</p>
            </div>
            
            <?php if ($error): ?>
                <div style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; font-size: 0.9rem;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required autofocus>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
            
            <div style="text-align: center; margin-top: 2rem; font-size: 0.85rem; color: var(--text-light);">
                <a href="/public/index.php" style="color: var(--primary);">← Back to Website</a>
            </div>
            
        </div>
        
        <div style="text-align: center; color: white; margin-top: 2rem; font-size: 0.9rem;">
            <p>Default credentials: admin / admin123</p>
            <p style="font-size: 0.8rem; opacity: 0.8; margin-top: 0.5rem;">Please change password after first login</p>
        </div>
    </div>
    
</body>
</html>

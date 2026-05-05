<?php
session_start();
require_once __DIR__ . '/../includes/functions.php';

if (!isLoggedIn()) {
    redirect('login.php');
}

// Show session info for debugging (can be removed in production)
$current_session_id = $_SESSION['session_id'] ?? 'N/A';
$login_time = isset($_SESSION['login_time']) ? date('Y-m-d H:i:s', $_SESSION['login_time']) : 'N/A';

$stats = getFundingStats();
$recentDonations = getRecentDonations(10);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Cancer Care Funding</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    
    <!-- Admin Header -->
    <header style="background: var(--text-dark); color: white; padding: 1rem 0;">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2 style="color: white;">Admin Dashboard</h2>
                <div style="display: flex; gap: 2rem; align-items: center;">
                    <span>Welcome, <?php echo clean($_SESSION['admin_name']); ?></span>
                    <a href="/public/index.php" style="color: white; opacity: 0.8;">View Website</a>
                    <a href="logout.php" style="color: white; opacity: 0.8;">Logout</a>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <div style="padding: 3rem 0; background: var(--gray-50); min-height: calc(100vh - 80px);">
        <div class="container">
            
            <!-- Stats Overview -->
            <div style="margin-bottom: 3rem;">
                <h3 style="margin-bottom: 1.5rem;">Overview</h3>
                <div class="stats-grid">
                    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <div style="color: var(--text-light); margin-bottom: 0.5rem;">Total Required</div>
                        <div style="font-size: 2rem; font-weight: 600; color: var(--primary);">
                            <?php echo formatAmount($stats['total_required']); ?>
                        </div>
                    </div>
                    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <div style="color: var(--text-light); margin-bottom: 0.5rem;">Total Collected</div>
                        <div style="font-size: 2rem; font-weight: 600; color: var(--success);">
                            <?php echo formatAmount($stats['total_collected']); ?>
                        </div>
                    </div>
                    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <div style="color: var(--text-light); margin-bottom: 0.5rem;">Completed Rooms</div>
                        <div style="font-size: 2rem; font-weight: 600; color: var(--text-dark);">
                            <?php echo $stats['completed_rooms']; ?> / <?php echo $stats['total_rooms']; ?>
                        </div>
                    </div>
                    <div style="background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                        <div style="color: var(--text-light); margin-bottom: 0.5rem;">Progress</div>
                        <div style="font-size: 2rem; font-weight: 600; color: var(--accent);">
                            <?php echo calculatePercentage($stats['total_collected'], $stats['total_required']); ?>%
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div style="margin-bottom: 3rem;">
                <h3 style="margin-bottom: 1.5rem;">Quick Actions</h3>
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    <a href="manage_rooms.php" class="btn btn-primary">Manage Rooms</a>
                    <a href="add_room.php" class="btn btn-secondary">Add New Room</a>
                    <a href="donations.php" class="btn btn-secondary">View All Donations</a>
                    <a href="settings.php" class="btn btn-secondary">Settings</a>
                </div>
            </div>
            
            <!-- Recent Donations -->
            <div>
                <h3 style="margin-bottom: 1.5rem;">Recent Donations</h3>
                <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <?php if (empty($recentDonations)): ?>
                        <div style="padding: 3rem; text-align: center; color: var(--text-light);">
                            No donations yet
                        </div>
                    <?php else: ?>
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background: var(--gray-50); border-bottom: 2px solid var(--border);">
                                    <th style="padding: 1rem; text-align: left;">Donor</th>
                                    <th style="padding: 1rem; text-align: left;">Room</th>
                                    <th style="padding: 1rem; text-align: right;">Amount</th>
                                    <th style="padding: 1rem; text-align: left;">Date</th>
                                    <th style="padding: 1rem; text-align: center;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentDonations as $donation): ?>
                                    <tr style="border-bottom: 1px solid var(--border);">
                                        <td style="padding: 1rem;">
                                            <?php 
                                            echo $donation['is_anonymous'] 
                                                ? '<em>Anonymous</em>' 
                                                : clean($donation['donor_name']); 
                                            ?>
                                        </td>
                                        <td style="padding: 1rem;">
                                            <?php echo $donation['room_name'] ? clean($donation['room_name']) : '<em>General Fund</em>'; ?>
                                        </td>
                                        <td style="padding: 1rem; text-align: right; font-weight: 600;">
                                            <?php echo formatAmount($donation['amount']); ?>
                                        </td>
                                        <td style="padding: 1rem;">
                                            <?php echo date('M d, Y', strtotime($donation['created_at'])); ?>
                                        </td>
                                        <td style="padding: 1rem; text-align: center;">
                                            <?php 
                                            if ($donation['payment_status'] === 'completed') {
                                                echo '<span class="badge badge-green">Completed</span>';
                                            } else {
                                                echo '<span class="badge badge-gray">Pending</span>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
    </div>
    
</body>
</html>

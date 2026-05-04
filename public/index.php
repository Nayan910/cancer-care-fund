<?php
$pageTitle = 'Home - Cancer Care Funding';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/header.php';

$stats = getFundingStats();
$recentDonations = getRecentDonations(5);
$featuredRooms = array_slice(getAllRooms(), 0, 6);
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <h1>Support Cancer Care Through Room Sponsorship</h1>
        <p>Every room you fund brings hope, dignity, and quality care to cancer patients in need.</p>
        <a href="donate.php" class="btn btn-primary" style="background: white; color: var(--primary); font-size: 1.1rem; padding: 0.8rem 2rem;">Donate Now</a>
    </div>
</section>

<!-- Stats Section -->
<section style="padding: 4rem 0;">
    <div class="container">
        <div class="stats">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3><?php echo formatAmount($stats['total_required']); ?></h3>
                    <p>Total Goal</p>
                </div>
                <div class="stat-item">
                    <h3><?php echo formatAmount($stats['total_collected']); ?></h3>
                    <p>Raised So Far</p>
                </div>
                <div class="stat-item">
                    <h3><?php echo $stats['total_rooms']; ?></h3>
                    <p>Total Rooms</p>
                </div>
                <div class="stat-item">
                    <h3><?php echo $stats['completed_rooms']; ?></h3>
                    <p>Fully Funded</p>
                </div>
            </div>
            
            <div class="progress-container">
                <?php 
                $overallPercentage = calculatePercentage($stats['total_collected'], $stats['total_required']);
                ?>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo $overallPercentage; ?>%">
                        <?php echo $overallPercentage; ?>%
                    </div>
                </div>
                <div class="progress-info">
                    <span>Collected: <?php echo formatAmount($stats['total_collected']); ?></span>
                    <span>Remaining: <?php echo formatAmount($stats['total_required'] - $stats['total_collected']); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section style="padding: 3rem 0; background: white;">
    <div class="container">
        <div class="section-title">
            <h2>About Our Mission</h2>
            <p>Building a world-class palliative care center for cancer patients in Rajkot</p>
        </div>
        <div style="max-width: 800px; margin: 0 auto; text-align: center; line-height: 1.8;">
            <p>The Cancer Care Foundation Rajkot is establishing a comprehensive Palliative Cancer Care Center - a beacon of hope for patients facing cancer. This center will provide free, quality, and compassionate care to those in need, combining modern medical facilities with traditional healing practices.</p>
            <p style="margin-top: 1rem;">Starting with 75 beds, the center will serve patients of all religions, communities, and backgrounds, treating each individual with dignity, respect, and the care they deserve.</p>
            <div style="margin-top: 2rem;">
                <a href="rooms.php" class="btn btn-primary">Browse All Rooms</a>
                <a href="about.php" class="btn btn-secondary" style="margin-left: 1rem;">Learn More</a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Rooms -->
<section class="rooms-section">
    <div class="container">
        <div class="section-title">
            <h2>Featured Rooms Needing Funding</h2>
            <p>Help us complete these essential facilities</p>
        </div>
        
        <div class="rooms-grid">
            <?php foreach ($featuredRooms as $room): ?>
                <?php 
                $percentage = calculatePercentage($room['collected_amount'], $room['required_amount']);
                $status = getRoomStatus($room['collected_amount'], $room['required_amount']);
                ?>
                <div class="room-card">
                    <div class="room-header">
                        <div class="room-category"><?php echo clean($room['category']); ?></div>
                        <h3 class="room-name"><?php echo clean($room['name_en']); ?></h3>
                        <div class="room-floor"><?php echo clean($room['floor']); ?></div>
                    </div>
                    
                    <div class="room-body">
                        <div class="room-amounts">
                            <div>
                                <div class="amount-label">Required</div>
                                <div class="amount-value"><?php echo formatAmount($room['required_amount']); ?></div>
                            </div>
                            <div style="text-align: right;">
                                <div class="amount-label">Raised</div>
                                <div class="amount-value"><?php echo formatAmount($room['collected_amount']); ?></div>
                            </div>
                        </div>
                        
                        <div class="progress-bar" style="height: 8px;">
                            <div class="progress-fill" style="width: <?php echo $percentage; ?>%"></div>
                        </div>
                        <div style="text-align: center; margin-top: 0.5rem; font-size: 0.9rem; color: var(--text-light);">
                            <?php echo $percentage; ?>% funded
                        </div>
                    </div>
                    
                    <div class="room-footer">
                        <?php echo getStatusBadge($status); ?>
                        <a href="room.php?id=<?php echo $room['id']; ?>" class="btn btn-secondary" style="font-size: 0.9rem; padding: 0.5rem 1rem;">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center">
            <a href="rooms.php" class="btn btn-primary">View All Rooms</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

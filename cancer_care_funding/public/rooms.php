<?php
$pageTitle = 'All Rooms - Cancer Care Funding';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/header.php';

// Get filter parameters
$categoryFilter = $_GET['category'] ?? null;
$floorFilter = $_GET['floor'] ?? null;
$statusFilter = $_GET['status'] ?? null;

// Get all rooms with filters
$rooms = getAllRooms($categoryFilter, $floorFilter);

// Apply status filter if needed
if ($statusFilter) {
    $rooms = array_filter($rooms, function($room) use ($statusFilter) {
        $status = getRoomStatus($room['collected_amount'], $room['required_amount']);
        return $status === $statusFilter;
    });
}

$categories = getCategories();
$floors = getFloors();
?>

<section style="padding: 3rem 0;">
    <div class="container">
        <div class="section-title">
            <h2>All Hospital Rooms & Areas</h2>
            <p>Browse and sponsor the rooms that will serve cancer patients</p>
        </div>
        
        <!-- Filters -->
        <form method="GET" class="filters">
            <div class="filter-group">
                <label>Category</label>
                <select name="category" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat; ?>" <?php echo $categoryFilter === $cat ? 'selected' : ''; ?>>
                            <?php echo clean($cat); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="filter-group">
                <label>Floor</label>
                <select name="floor" onchange="this.form.submit()">
                    <option value="">All Floors</option>
                    <?php foreach ($floors as $floor): ?>
                        <option value="<?php echo $floor; ?>" <?php echo $floorFilter === $floor ? 'selected' : ''; ?>>
                            <?php echo clean($floor); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="filter-group">
                <label>Status</label>
                <select name="status" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="not_started" <?php echo $statusFilter === 'not_started' ? 'selected' : ''; ?>>Not Started</option>
                    <option value="partial" <?php echo $statusFilter === 'partial' ? 'selected' : ''; ?>>In Progress</option>
                    <option value="completed" <?php echo $statusFilter === 'completed' ? 'selected' : ''; ?>>Fully Funded</option>
                </select>
            </div>
            
            <?php if ($categoryFilter || $floorFilter || $statusFilter): ?>
                <div class="filter-group" style="display: flex; align-items: flex-end;">
                    <a href="rooms.php" class="btn btn-secondary">Clear Filters</a>
                </div>
            <?php endif; ?>
        </form>
        
        <!-- Results Count -->
        <div style="margin-bottom: 2rem; color: var(--text-light);">
            Showing <?php echo count($rooms); ?> room<?php echo count($rooms) !== 1 ? 's' : ''; ?>
        </div>
        
        <!-- Rooms Grid -->
        <?php if (empty($rooms)): ?>
            <div style="text-align: center; padding: 4rem 0;">
                <h3>No rooms found with the selected filters</h3>
                <p style="color: var(--text-light); margin-top: 1rem;">Try adjusting your search criteria</p>
                <a href="rooms.php" class="btn btn-primary" style="margin-top: 2rem;">View All Rooms</a>
            </div>
        <?php else: ?>
            <div class="rooms-grid">
                <?php foreach ($rooms as $room): ?>
                    <?php 
                    $percentage = calculatePercentage($room['collected_amount'], $room['required_amount']);
                    $status = getRoomStatus($room['collected_amount'], $room['required_amount']);
                    ?>
                    <div class="room-card">
                        <div class="room-header">
                            <div class="room-category"><?php echo clean($room['category']); ?></div>
                            <h3 class="room-name"><?php echo clean($room['name_en']); ?></h3>
                            <?php if ($room['name_gu']): ?>
                                <div style="font-size: 0.9rem; color: var(--text-light); margin-top: 0.25rem;">
                                    <?php echo clean($room['name_gu']); ?>
                                </div>
                            <?php endif; ?>
                            <div class="room-floor"><?php echo clean($room['floor']); ?></div>
                        </div>
                        
                        <div class="room-body">
                            <?php if ($room['description']): ?>
                                <p style="font-size: 0.9rem; color: var(--text-light); margin-bottom: 1rem;">
                                    <?php echo clean($room['description']); ?>
                                </p>
                            <?php endif; ?>
                            
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
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

<?php
require_once __DIR__ . '/../config/database.php';

/**
 * Format amount in Indian currency format
 */
function formatAmount($amount) {
    return '₹' . number_format($amount, 0, '.', ',');
}

/**
 * Calculate percentage funded
 */
function calculatePercentage($collected, $required) {
    if ($required == 0) return 0;
    return min(100, round(($collected / $required) * 100, 2));
}

/**
 * Get room status
 */
function getRoomStatus($collected, $required) {
    $percentage = calculatePercentage($collected, $required);
    
    if ($percentage >= 100) {
        return 'completed';
    } elseif ($percentage > 0) {
        return 'partial';
    }
    return 'not_started';
}

/**
 * Get all rooms with optional filters
 */
function getAllRooms($category = null, $floor = null) {
    $sql = "SELECT * FROM rooms WHERE is_active = 1";
    $params = [];
    
    if ($category) {
        $sql .= " AND category = ?";
        $params[] = $category;
    }
    
    if ($floor) {
        $sql .= " AND floor = ?";
        $params[] = $floor;
    }
    
    $sql .= " ORDER BY display_order ASC, name_en ASC";
    
    $result = query($sql, $params);
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Get single room by ID
 */
function getRoomById($id) {
    $result = query("SELECT * FROM rooms WHERE id = ? AND is_active = 1", [$id]);
    return $result->fetch_assoc();
}

/**
 * Get total funding statistics
 */
function getFundingStats() {
    $result = query("
        SELECT 
            COUNT(*) as total_rooms,
            SUM(required_amount) as total_required,
            SUM(collected_amount) as total_collected,
            SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_rooms,
            SUM(CASE WHEN status = 'partial' THEN 1 ELSE 0 END) as partial_rooms,
            SUM(CASE WHEN status = 'not_started' THEN 1 ELSE 0 END) as not_started_rooms
        FROM rooms 
        WHERE is_active = 1
    ");
    return $result->fetch_assoc();
}

/**
 * Get all unique categories
 */
function getCategories() {
    $result = query("SELECT DISTINCT category FROM rooms WHERE is_active = 1 ORDER BY category");
    return array_column($result->fetch_all(MYSQLI_ASSOC), 'category');
}

/**
 * Get all unique floors
 */
function getFloors() {
    $result = query("SELECT DISTINCT floor FROM rooms WHERE is_active = 1 ORDER BY 
        CASE 
            WHEN floor = 'Ground Floor' THEN 0
            WHEN floor = 'First Floor' THEN 1
            WHEN floor = 'Second Floor' THEN 2
            WHEN floor = 'Third Floor' THEN 3
            WHEN floor = 'Fourth Floor' THEN 4
            ELSE 5
        END
    ");
    return array_column($result->fetch_all(MYSQLI_ASSOC), 'floor');
}

/**
 * Get recent donations
 */
function getRecentDonations($limit = 10) {
    $result = query("
        SELECT d.*, r.name_en as room_name 
        FROM donations d
        LEFT JOIN rooms r ON d.room_id = r.id
        WHERE d.payment_status = 'completed'
        ORDER BY d.created_at DESC
        LIMIT ?
    ", [$limit]);
    return $result->fetch_all(MYSQLI_ASSOC);
}

/**
 * Sanitize input
 */
function clean($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Check if user is logged in (admin)
 */
function isLoggedIn() {
    session_start();
    
    // Check session variables exist
    if (!isset($_SESSION['admin_id']) || !isset($_SESSION['session_id'])) {
        return false;
    }
    
    // Verify session ID matches (prevents session fixation)
    if ($_SESSION['session_id'] !== session_id()) {
        // Session might be hijacked - destroy it
        session_destroy();
        return false;
    }
    
    // Check session timeout (30 minutes)
    if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time']) > 1800) {
        session_destroy();
        return false;
    }
    
    return true;
}

/**
 * Get current admin ID
 */
function getCurrentAdminId() {
    return $_SESSION['admin_id'] ?? null;
}

/**
 * Get current admin name
 */
function getCurrentAdminName() {
    return $_SESSION['admin_name'] ?? 'Unknown';
}

/**
 * Redirect helper
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Get status badge HTML
 */
function getStatusBadge($status) {
    $badges = [
        'not_started' => '<span class="badge badge-gray">Not Started</span>',
        'partial' => '<span class="badge badge-blue">In Progress</span>',
        'completed' => '<span class="badge badge-green">Fully Funded</span>'
    ];
    return $badges[$status] ?? '';
}

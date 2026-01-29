<?php
require_once __DIR__ . '/../includes/functions.php';

$roomId = $_GET['id'] ?? null;

if (!$roomId) {
    redirect('rooms.php');
}

$room = getRoomById($roomId);

if (!$room) {
    redirect('rooms.php');
}

$percentage = calculatePercentage($room['collected_amount'], $room['required_amount']);
$status = getRoomStatus($room['collected_amount'], $room['required_amount']);
$remaining = $room['required_amount'] - $room['collected_amount'];

$pageTitle = $room['name_en'] . ' - Cancer Care Funding';
require_once __DIR__ . '/../includes/header.php';
?>

<section style="padding: 3rem 0;">
    <div class="container">
        <div style="max-width: 900px; margin: 0 auto;">
            
            <!-- Breadcrumb -->
            <div style="margin-bottom: 2rem;">
                <a href="rooms.php" style="color: var(--text-light); text-decoration: none;">← Back to All Rooms</a>
            </div>
            
            <!-- Room Header -->
            <div style="background: white; padding: 2rem; border-radius: 12px; margin-bottom: 2rem;">
                <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                    <div>
                        <div style="font-size: 0.9rem; color: var(--text-light); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">
                            <?php echo clean($room['category']); ?> • <?php echo clean($room['floor']); ?>
                        </div>
                        <h1 style="font-size: 2rem; margin-bottom: 0.5rem;"><?php echo clean($room['name_en']); ?></h1>
                        <?php if ($room['name_gu']): ?>
                            <div style="font-size: 1.2rem; color: var(--text-light);">
                                <?php echo clean($room['name_gu']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php echo getStatusBadge($status); ?>
                </div>
                
                <?php if ($room['description']): ?>
                    <p style="color: var(--text-dark); line-height: 1.8; margin-top: 1.5rem;">
                        <?php echo clean($room['description']); ?>
                    </p>
                <?php endif; ?>
            </div>
            
            <!-- Funding Progress -->
            <div style="background: white; padding: 2rem; border-radius: 12px; margin-bottom: 2rem;">
                <h2 style="margin-bottom: 1.5rem; font-size: 1.5rem;">Funding Progress</h2>
                
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-bottom: 2rem;">
                    <div>
                        <div style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;">Required Amount</div>
                        <div style="font-size: 1.5rem; font-weight: 600; color: var(--primary);">
                            <?php echo formatAmount($room['required_amount']); ?>
                        </div>
                    </div>
                    <div>
                        <div style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;">Amount Raised</div>
                        <div style="font-size: 1.5rem; font-weight: 600; color: var(--success);">
                            <?php echo formatAmount($room['collected_amount']); ?>
                        </div>
                    </div>
                    <div>
                        <div style="color: var(--text-light); font-size: 0.9rem; margin-bottom: 0.5rem;">Remaining</div>
                        <div style="font-size: 1.5rem; font-weight: 600; color: var(--text-dark);">
                            <?php echo formatAmount($remaining); ?>
                        </div>
                    </div>
                </div>
                
                <div class="progress-bar" style="height: 32px; margin-bottom: 1rem;">
                    <div class="progress-fill" style="width: <?php echo $percentage; ?>%; font-size: 1rem;">
                        <?php echo $percentage; ?>%
                    </div>
                </div>
                
                <?php if ($status === 'completed'): ?>
                    <div style="text-align: center; padding: 1.5rem; background: #d4edda; border-radius: 8px; color: #155724; font-weight: 500;">
                        🎉 This room is fully funded! Thank you to all donors.
                    </div>
                <?php else: ?>
                    <div style="text-align: center; margin-top: 2rem;">
                        <a href="donate.php?room=<?php echo $room['id']; ?>" class="btn btn-primary" style="font-size: 1.1rem; padding: 0.8rem 2.5rem;">
                            Donate to This Room
                        </a>
                        <div style="margin-top: 1rem; color: var(--text-light); font-size: 0.9rem;">
                            or <a href="donate.php" style="color: var(--primary);">donate to general fund</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Why This Room Matters -->
            <div style="background: var(--secondary); padding: 2rem; border-radius: 12px; margin-bottom: 2rem;">
                <h2 style="margin-bottom: 1rem; font-size: 1.5rem;">Why This Room Matters</h2>
                <p style="line-height: 1.8;">
                    Each room in our palliative care center plays a vital role in providing comfort, dignity, and quality care to cancer patients. Your contribution to the <strong><?php echo clean($room['name_en']); ?></strong> will directly impact the lives of patients and their families during their most challenging moments.
                </p>
                <p style="line-height: 1.8; margin-top: 1rem;">
                    This facility will offer free, compassionate care to those who need it most, ensuring that every patient receives the dignity and respect they deserve regardless of their financial situation.
                </p>
            </div>
            
            <!-- Other Rooms -->
            <div>
                <h2 style="margin-bottom: 1.5rem; font-size: 1.5rem;">Other Rooms in <?php echo clean($room['category']); ?></h2>
                <?php 
                $relatedRooms = array_filter(getAllRooms($room['category']), function($r) use ($room) {
                    return $r['id'] !== $room['id'];
                });
                $relatedRooms = array_slice($relatedRooms, 0, 3);
                ?>
                
                <?php if (empty($relatedRooms)): ?>
                    <p style="color: var(--text-light);">No other rooms in this category</p>
                <?php else: ?>
                    <div style="display: grid; gap: 1rem;">
                        <?php foreach ($relatedRooms as $related): ?>
                            <?php $relPercentage = calculatePercentage($related['collected_amount'], $related['required_amount']); ?>
                            <a href="room.php?id=<?php echo $related['id']; ?>" 
                               style="display: flex; justify-content: space-between; align-items: center; padding: 1.5rem; background: white; border-radius: 8px; text-decoration: none; color: inherit; transition: all 0.3s;"
                               onmouseover="this.style.boxShadow='0 4px 12px rgba(0,0,0,0.1)'"
                               onmouseout="this.style.boxShadow='none'">
                                <div>
                                    <div style="font-weight: 600; margin-bottom: 0.25rem;"><?php echo clean($related['name_en']); ?></div>
                                    <div style="font-size: 0.9rem; color: var(--text-light);">
                                        <?php echo formatAmount($related['collected_amount']); ?> of <?php echo formatAmount($related['required_amount']); ?>
                                    </div>
                                </div>
                                <div style="min-width: 80px;">
                                    <div class="progress-bar" style="height: 6px;">
                                        <div class="progress-fill" style="width: <?php echo $relPercentage; ?>%"></div>
                                    </div>
                                    <div style="text-align: center; font-size: 0.85rem; color: var(--text-light); margin-top: 0.25rem;">
                                        <?php echo $relPercentage; ?>%
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

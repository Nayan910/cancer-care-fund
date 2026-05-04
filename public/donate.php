<?php
$pageTitle = 'Make a Donation - Cancer Care Funding';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/header.php';

$selectedRoomId = $_GET['room'] ?? null;
$selectedRoom = null;

if ($selectedRoomId) {
    $selectedRoom = getRoomById($selectedRoomId);
}

$allRooms = getAllRooms();
?>

<section style="padding: 3rem 0;">
    <div class="container">
        <div style="max-width: 700px; margin: 0 auto;">
            
            <div class="section-title">
                <h1>Make a Donation</h1>
                <p>Your contribution will directly support cancer patients in need</p>
            </div>
            
            <div style="background: white; padding: 2.5rem; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08);">
                
                <form method="POST" action="process_donation.php" id="donationForm">
                    
                    <!-- Room Selection -->
                    <div class="form-group">
                        <label>Select Room to Sponsor (Optional)</label>
                        <select name="room_id" class="form-control" id="roomSelect">
                            <option value="">General Fund (Hospital Overall)</option>
                            <?php 
                            // Group rooms by category
                            $roomsByCategory = [];
                            foreach ($allRooms as $room) {
                                $roomsByCategory[$room['category']][] = $room;
                            }
                            
                            foreach ($roomsByCategory as $category => $rooms):
                            ?>
                                <optgroup label="<?php echo clean($category); ?>">
                                    <?php foreach ($rooms as $room): ?>
                                        <option value="<?php echo $room['id']; ?>" 
                                                <?php echo ($selectedRoom && $selectedRoom['id'] == $room['id']) ? 'selected' : ''; ?>
                                                data-required="<?php echo $room['required_amount']; ?>"
                                                data-collected="<?php echo $room['collected_amount']; ?>">
                                            <?php echo clean($room['name_en']); ?> 
                                            (<?php echo formatAmount($room['required_amount'] - $room['collected_amount']); ?> needed)
                                        </option>
                                    <?php endforeach; ?>
                                </optgroup>
                            <?php endforeach; ?>
                        </select>
                        <div style="font-size: 0.85rem; color: var(--text-light); margin-top: 0.5rem;">
                            Leave as "General Fund" to support the entire hospital project
                        </div>
                    </div>
                    
                    <!-- Room Info Display -->
                    <div id="roomInfo" style="display: none; background: var(--secondary); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                        <div style="font-weight: 600; margin-bottom: 0.5rem;" id="roomName"></div>
                        <div style="font-size: 0.9rem; color: var(--text-dark);">
                            <span id="roomCollected"></span> raised of <span id="roomRequired"></span>
                        </div>
                        <div class="progress-bar" style="height: 6px; margin-top: 0.5rem;">
                            <div class="progress-fill" id="roomProgress" style="width: 0%"></div>
                        </div>
                    </div>
                    
                    <!-- Amount -->
                    <div class="form-group">
                        <label>Donation Amount *</label>
                        <input type="number" name="amount" class="form-control" required min="1" placeholder="Enter amount in ₹" step="1">
                        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem; margin-top: 0.75rem;">
                            <button type="button" class="btn btn-secondary quick-amount" data-amount="1000">₹1,000</button>
                            <button type="button" class="btn btn-secondary quick-amount" data-amount="5000">₹5,000</button>
                            <button type="button" class="btn btn-secondary quick-amount" data-amount="10000">₹10,000</button>
                            <button type="button" class="btn btn-secondary quick-amount" data-amount="25000">₹25,000</button>
                        </div>
                    </div>
                    
                    <!-- Donor Information -->
                    <div style="margin: 2rem 0; padding: 1.5rem 0; border-top: 2px solid var(--border); border-bottom: 2px solid var(--border);">
                        <h3 style="margin-bottom: 1.5rem; font-size: 1.2rem;">Your Information</h3>
                        
                        <div class="form-group">
                            <label>Full Name *</label>
                            <input type="text" name="donor_name" class="form-control" required placeholder="Enter your full name">
                        </div>
                        
                        <div class="form-group">
                            <label>Email Address *</label>
                            <input type="email" name="donor_email" class="form-control" required placeholder="your@email.com">
                            <div style="font-size: 0.85rem; color: var(--text-light); margin-top: 0.5rem;">
                                We'll send donation receipt and updates to this email
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" name="donor_phone" class="form-control" placeholder="Your phone number (optional)">
                        </div>
                        
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_anonymous" value="1" style="margin-right: 0.5rem;">
                                Make my donation anonymous
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <label>Message (Optional)</label>
                            <textarea name="message" class="form-control" placeholder="Share why you're donating or a message of support"></textarea>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" style="font-size: 1.1rem; padding: 0.8rem;">
                            Proceed to Payment
                        </button>
                    </div>
                    
                    <div style="text-align: center; font-size: 0.85rem; color: var(--text-light); margin-top: 1rem;">
                        Your donation is secure and will be processed through Razorpay
                    </div>
                    
                </form>
                
            </div>
            
            <!-- Trust Indicators -->
            <div style="margin-top: 3rem; text-align: center;">
                <h3 style="margin-bottom: 1rem;">Why Donate?</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-top: 2rem;">
                    <div>
                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">💝</div>
                        <div style="font-weight: 600; margin-bottom: 0.25rem;">100% Transparent</div>
                        <div style="font-size: 0.9rem; color: var(--text-light);">Every rupee tracked and reported</div>
                    </div>
                    <div>
                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">🏥</div>
                        <div style="font-weight: 600; margin-bottom: 0.25rem;">Direct Impact</div>
                        <div style="font-size: 0.9rem; color: var(--text-light);">Funds go directly to hospital construction</div>
                    </div>
                    <div>
                        <div style="font-size: 2rem; margin-bottom: 0.5rem;">📧</div>
                        <div style="font-weight: 600; margin-bottom: 0.25rem;">Tax Receipt</div>
                        <div style="font-size: 0.9rem; color: var(--text-light);">Instant receipt for tax purposes</div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<script>
// Quick amount buttons
document.querySelectorAll('.quick-amount').forEach(button => {
    button.addEventListener('click', function() {
        const amount = this.getAttribute('data-amount');
        document.querySelector('input[name="amount"]').value = amount;
    });
});

// Room selection handler
const roomSelect = document.getElementById('roomSelect');
const roomInfo = document.getElementById('roomInfo');

roomSelect.addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    
    if (this.value) {
        const required = parseFloat(selectedOption.getAttribute('data-required'));
        const collected = parseFloat(selectedOption.getAttribute('data-collected'));
        const percentage = Math.round((collected / required) * 100);
        
        document.getElementById('roomName').textContent = selectedOption.text.split('(')[0].trim();
        document.getElementById('roomRequired').textContent = '₹' + required.toLocaleString('en-IN');
        document.getElementById('roomCollected').textContent = '₹' + collected.toLocaleString('en-IN');
        document.getElementById('roomProgress').style.width = percentage + '%';
        
        roomInfo.style.display = 'block';
    } else {
        roomInfo.style.display = 'none';
    }
});

// Trigger on page load if room is pre-selected
if (roomSelect.value) {
    roomSelect.dispatchEvent(new Event('change'));
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

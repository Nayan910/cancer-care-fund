# Cancer Care Funding Platform - Requirements Document

## Project Overview

A transparent, room-based crowdfunding platform for the Cancer Care Foundation Rajkot's Palliative Care Center. The platform allows donors to sponsor specific hospital rooms/areas while tracking real-time funding progress.

---

## 1. Functional Requirements

### 1.1 Public Website

#### 1.1.1 Homepage
- Display overall funding statistics (total goal, raised amount, progress percentage)
- Show featured rooms needing funding
- Call-to-action buttons for donation
- About section with mission statement
- Recent activity/donation feed

#### 1.1.2 Room Listing Page
- Display all 75+ rooms in card/grid format
- Filter by:
  - Category (Medical, Support, Therapy, etc.)
  - Floor (Ground, First, Second, Third, Fourth, Campus)
  - Status (Not Started, In Progress, Fully Funded)
- Each card shows:
  - Room name (English + Gujarati)
  - Category and floor
  - Required amount
  - Collected amount
  - Progress bar with percentage
  - Status badge
  - "View Details" button

#### 1.1.3 Single Room Page
- Detailed room information
- Full funding progress breakdown
- Description of room's purpose
- Donate button (specific to this room)
- Related rooms suggestions
- Why this room matters section

#### 1.1.4 Donation Page
- Room selection dropdown (organized by category)
- Quick amount buttons (₹1,000, ₹5,000, ₹10,000, ₹25,000)
- Custom amount input
- Donor information form:
  - Full name (required)
  - Email (required)
  - Phone (optional)
  - Anonymous donation checkbox
  - Message/note (optional)
- Payment gateway integration (Razorpay)
- Security indicators

#### 1.1.5 About Page
- Mission and vision
- What is palliative care
- Statistics and need
- Facility descriptions
- Call to action

### 1.2 Admin Panel

#### 1.2.1 Authentication
- Secure login system
- Session management
- Role-based access (admin, manager)
- Password encryption

#### 1.2.2 Dashboard
- Overall statistics overview
- Total required vs collected
- Completed rooms count
- Progress percentage
- Recent donations table
- Quick action buttons

#### 1.2.3 Room Management
- View all rooms
- Add new room
- Edit room details:
  - Name (English/Gujarati)
  - Category
  - Floor
  - Description
  - Required amount
  - Current collected amount (manual or auto-update)
  - Status
  - Display order
  - Active/inactive toggle
- Delete/archive rooms
- Bulk actions

#### 1.2.4 Donation Management
- View all donations
- Filter by:
  - Date range
  - Room
  - Payment status
  - Amount range
- Export to CSV/Excel
- Manual donation entry (for offline donations)
- Mark receipt as sent
- Refund management

#### 1.2.5 Settings
- Site configuration:
  - Site name
  - Contact email
  - Contact phone
  - Overall funding goal
- Payment gateway settings:
  - Razorpay Key ID
  - Razorpay Secret
- Email settings (SMTP)
- Notification preferences

#### 1.2.6 Activity Log
- Track admin actions
- View login history
- Audit trail

---

## 2. Technical Requirements

### 2.1 Technology Stack

**Backend:**
- PHP 7.4+
- MySQL 5.7+
- Native PHP (no framework) for simplicity

**Frontend:**
- HTML5
- CSS3 (custom, no frameworks)
- Vanilla JavaScript
- Google Fonts (Inter)

**Payment:**
- Razorpay Payment Gateway

**Server:**
- Apache/Nginx
- mod_rewrite enabled
- PHP extensions: mysqli, mbstring, json

### 2.2 Database Structure

**Tables:**
1. `rooms` - Hospital rooms/areas
2. `donations` - Donation records
3. `admin_users` - Admin accounts
4. `settings` - Site configuration
5. `activity_log` - Admin action tracking

**Key Features:**
- Foreign key relationships
- Indexes on frequently queried columns
- UTF-8 encoding support (for Gujarati text)
- Automatic timestamp tracking

### 2.3 Security Requirements

- SQL injection prevention (prepared statements)
- XSS protection (input sanitization)
- CSRF protection for forms
- Secure password hashing (bcrypt)
- Session security (httponly, secure flags)
- Input validation (server-side)
- File upload restrictions
- Rate limiting on sensitive actions
- HTTPS enforcement (production)

### 2.4 Performance Requirements

- Page load time < 2 seconds
- Database queries optimized with indexes
- Image optimization
- CSS/JS minification (production)
- Browser caching headers
- Gzip compression
- Responsive on 3G connection

---

## 3. Data Requirements

### 3.1 Room Data (75+ entries)

**Categories:**
- Administration
- Medical
- Patient Ward
- Special Care
- Critical Care
- Premium Care
- Support
- Therapy
- Wellness
- Spiritual
- Campus

**Floors:**
- Ground Floor
- First Floor
- Second Floor
- Third Floor
- Fourth Floor
- Campus

**Required Fields:**
- Name (English) - required
- Name (Gujarati) - optional
- Category - required
- Floor - required
- Description - optional
- Required Amount - required
- Collected Amount - default 0
- Status - auto-calculated
- Display Order - for sorting
- Active/Inactive flag

### 3.2 Donation Data

**Required Information:**
- Room ID (null for general fund)
- Donor name
- Donor email
- Donor phone (optional)
- Amount
- Payment ID (from gateway)
- Payment method
- Payment status
- Anonymous flag
- Donor message (optional)
- Receipt sent flag
- Timestamp

---

## 4. User Interface Requirements

### 4.1 Design Principles

**Theme: "Hope & Dignity"**
- Calm, peaceful color palette
- Clean, minimal layout
- Compassionate tone
- Trust-building elements
- No aggressive CTAs

**Colors:**
- Primary: Soft Teal (#2d7a6e) - healing, calm
- Secondary: Light Beige (#e8f4f2) - peaceful
- Accent: Warm Gold (#f4a261) - hope
- Success: Green (#28a745)
- Text: Dark Gray (#2c3e50)

### 4.2 Responsive Design

**Breakpoints:**
- Desktop: 1200px+
- Laptop: 992px - 1199px
- Tablet: 768px - 991px
- Mobile: < 768px

**Mobile Optimizations:**
- Touch-friendly buttons (44px min)
- Simplified navigation
- Stacked layouts
- Optimized images
- Reduced animations

### 4.3 Accessibility

- Semantic HTML5
- ARIA labels where needed
- Keyboard navigation
- Screen reader friendly
- Sufficient color contrast (WCAG AA)
- Alt text for images
- Form label associations

---

## 5. Payment Integration Requirements

### 5.1 Razorpay Integration

**Features Needed:**
- Standard checkout
- UPI support
- Card payments
- Net banking
- Wallets
- EMI options (for large amounts)

**Implementation:**
- Webhook for payment verification
- Secure key storage
- Order ID generation
- Payment receipt/confirmation
- Failed payment handling
- Refund capability

### 5.2 Payment Flow

1. User fills donation form
2. System validates input
3. Creates Razorpay order
4. Redirects to payment page
5. User completes payment
6. Razorpay sends webhook
7. System verifies payment
8. Updates donation record
9. Updates room funding
10. Sends receipt email
11. Shows thank you page

---

## 6. Email Requirements

### 6.1 Automated Emails

**To Donors:**
- Payment receipt (immediate)
- Tax certificate (if applicable)
- Quarterly updates on funded room
- Milestone notifications

**To Admins:**
- New donation alert
- Daily summary report
- Weekly funding report
- Room fully funded notification

### 6.2 Email Templates

- Professional, branded design
- Responsive HTML
- Plain text fallback
- Unsubscribe option
- Contact information

---

## 7. Reporting Requirements

### 7.1 Public Reports

- Overall funding progress
- Rooms funded list
- Recent donations (anonymous option)
- Milestone achievements

### 7.2 Admin Reports

- Daily donation summary
- Weekly funding report
- Monthly financial report
- Room-wise breakdown
- Donor analytics
- Payment gateway reconciliation
- Export to CSV/Excel/PDF

---

## 8. Content Requirements

### 8.1 Static Pages

- Homepage
- About Us
- FAQ (optional but recommended)
- Privacy Policy
- Terms of Service
- Contact Us

### 8.2 Dynamic Content

- Room descriptions (75+)
- Donor testimonials (future)
- News/updates (future)
- Photo gallery (future)

---

## 9. Browser Support

**Required:**
- Chrome/Edge (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Mobile Safari (iOS 12+)
- Chrome Mobile (Android 8+)

**Not Required:**
- Internet Explorer

---

## 10. Hosting Requirements

### 10.1 Minimum Server Specs

- PHP 7.4+
- MySQL 5.7+
- 1GB RAM
- 10GB storage
- SSL certificate
- Daily backups

### 10.2 Recommended Services

- Shared hosting: Hostinger, SiteGround
- VPS: DigitalOcean, Linode
- Domain: Any registrar
- SSL: Let's Encrypt (free)

---

## 11. Maintenance Requirements

### 11.1 Regular Tasks

- Daily: Backup database
- Weekly: Check payment reconciliation
- Monthly: Generate reports
- Quarterly: Security audit
- Yearly: Renew SSL, domain

### 11.2 Monitoring

- Uptime monitoring
- Error logging
- Payment gateway status
- Database performance
- Disk space usage

---

## 12. Future Enhancements (Phase 2)

- SMS notifications
- Mobile app
- Recurring donations
- Donor dashboard/portal
- Social media integration
- Photo uploads of rooms
- Video testimonials
- Multilingual support (full Gujarati)
- Donor leaderboard (optional)
- Fundraising campaigns
- Sponsor certificates
- Wall of fame
- QR code donations
- Offline kiosk mode

---

## 13. Success Metrics

### 13.1 Key Performance Indicators (KPIs)

- Total donations received
- Number of unique donors
- Average donation amount
- Rooms fully funded
- Website traffic
- Conversion rate (visitors to donors)
- Mobile vs desktop donations
- Repeat donor rate

### 13.2 Goals (Year 1)

- Raise ₹12.5 Crores
- Fund all 75+ rooms
- Reach 10,000+ donors
- 100% transparency maintained
- Zero payment failures
- < 1% refund rate

---

## 14. Testing Requirements

### 14.1 Testing Types

- Unit testing (core functions)
- Integration testing (payment flow)
- User acceptance testing
- Security testing
- Performance testing
- Cross-browser testing
- Mobile device testing

### 14.2 Test Scenarios

- Successful donation (all payment methods)
- Failed payment handling
- Anonymous donation
- General fund donation
- Room-specific donation
- Fully funded room behavior
- Admin room management
- Report generation
- Email delivery
- Form validation
- Mobile responsiveness

---

## 15. Documentation Requirements

- Setup/installation guide ✓
- User manual (donors)
- Admin manual
- API documentation (if any)
- Database schema documentation
- Deployment guide
- Troubleshooting guide
- FAQ for donors

---

## 16. Compliance Requirements

### 16.1 Legal

- Privacy policy
- Terms of service
- Refund policy
- Data protection (GDPR-aware if international donors)
- Tax compliance
- NGO registration verification

### 16.2 Financial

- Proper accounting
- Donation receipts
- Audit trail
- Financial transparency reports
- Tax deduction certificates (if applicable)

---

## Appendix A: Room List Summary

Total Rooms: 75+

**By Floor:**
- Ground Floor: 14 rooms
- First Floor: 9 rooms
- Second Floor: 9 rooms
- Third Floor: 14 rooms
- Fourth Floor: 10 rooms
- Campus: 6 areas

**By Category:**
- Administration: 7
- Medical: 12
- Patient Ward: 12
- Special Care: 6
- Critical Care: 3
- Premium Care: 10
- Support: 15
- Therapy: 4
- Wellness: 2
- Spiritual: 2
- Campus: 2

**Funding Range:**
- Small rooms: ₹11,00,000
- Medium rooms: ₹21,00,000 - ₹51,00,000
- Large wards: ₹1,00,00,000
- Total Goal: ₹12,50,00,000

---

## Document Version

- Version: 1.0
- Date: January 28, 2026
- Author: Development Team
- Status: Final

---

**END OF REQUIREMENTS DOCUMENT**

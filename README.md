# Cancer Care Funding Platform

A PHP/MySQL-based crowdfunding platform specifically designed for the Cancer Care Foundation Rajkot's Palliative Care Center. This system allows transparent tracking of room-wise funding needs and donations.

## 🎯 Features

- **Room-Based Funding**: Each hospital room/area is a separate fundable unit
- **Real-time Progress Tracking**: Visual progress bars showing funding status
- **Category & Floor Filtering**: Easy navigation through 75+ rooms
- **Donation Management**: Secure donation processing (Razorpay ready)
- **Admin Dashboard**: Complete control panel for managing rooms and donations
- **Responsive Design**: Works perfectly on mobile, tablet, and desktop
- **Transparent Reporting**: Full visibility into funding progress

## 📁 Project Structure

```
cancer_care_funding/
├── config/
│   └── database.php          # Database configuration
├── includes/
│   ├── functions.php          # Helper functions
│   ├── header.php             # Site header
│   └── footer.php             # Site footer
├── public/
│   ├── index.php              # Homepage
│   ├── rooms.php              # All rooms listing
│   ├── room.php               # Single room detail
│   ├── donate.php             # Donation form
│   └── about.php              # About the project
├── admin/
│   ├── login.php              # Admin login
│   ├── dashboard.php          # Admin dashboard
│   └── logout.php             # Logout script
├── assets/
│   ├── css/
│   │   └── style.css          # Main stylesheet
│   ├── js/                    # JavaScript files
│   └── images/                # Images
├── database_schema.sql        # Database structure
├── rooms_data.sql            # All 75+ rooms pre-loaded
└── README.md                 # This file
```

## 🚀 Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- XAMPP/WAMP (for local development)

### Step 1: Setup Project

1. Download/clone this project
2. Place in your web server directory:
   - XAMPP: `C:/xampp/htdocs/cancer_care_funding`
   - WAMP: `C:/wamp64/www/cancer_care_funding`

### Step 2: Create Database

1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Import `database_schema.sql` - this creates all tables
3. Import `rooms_data.sql` - this loads all 75+ rooms

Or use command line:
```bash
mysql -u root -p < database_schema.sql
mysql -u root -p cancer_care_fund < rooms_data.sql
```

### Step 3: Configure Database Connection

Edit `config/database.php`:
```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');           // Your MySQL username
define('DB_PASS', '');               // Your MySQL password
define('DB_NAME', 'cancer_care_fund');
```

### Step 4: Set Permissions (Linux/Mac)

```bash
chmod -R 755 cancer_care_funding
chmod -R 777 cancer_care_funding/assets/images
```

### Step 5: Access the Site

- **Website**: http://localhost/cancer_care_funding/public/index.php
- **Admin Panel**: http://localhost/cancer_care_funding/admin/login.php

## 🔐 Default Admin Credentials

```
Username: admin
Password: admin123
```

**⚠️ IMPORTANT: Change this password immediately after first login!**

## 📊 Database Details

### Tables Created

1. **rooms** - All hospital rooms/areas with funding details
2. **donations** - All donation records
3. **admin_users** - Admin login accounts
4. **settings** - Site configuration
5. **activity_log** - Admin action tracking

### Pre-loaded Data

The system comes with **75+ rooms** already configured:
- Ground Floor: OPD, Consultation, Administrative
- First Floor: Patient Wards (Male/Female/Children)
- Second Floor: Additional Wards
- Third Floor: Premium Rooms, ICU, Deluxe
- Fourth Floor: Therapy, Support Areas
- Campus: Dining, Spiritual, Wellness facilities

Total funding goal: ₹12.5 Crores

## 🎨 Customization

### Change Colors

Edit `assets/css/style.css`:
```css
:root {
    --primary: #2d7a6e;        /* Main brand color */
    --primary-dark: #1f5449;   /* Darker shade */
    --accent: #f4a261;         /* Highlight color */
}
```

### Update Site Information

Edit `includes/footer.php` for contact details and footer content.

### Add/Modify Rooms

Use the admin dashboard or directly edit database through phpMyAdmin.

## 💳 Payment Integration (Razorpay)

### Setup Razorpay

1. Sign up at https://razorpay.com
2. Get your API keys (Key ID and Secret)
3. Update in admin settings or directly in database:

```sql
UPDATE settings SET setting_value = 'your_key_id' WHERE setting_key = 'razorpay_key_id';
UPDATE settings SET setting_value = 'your_key_secret' WHERE setting_key = 'razorpay_key_secret';
```

4. Create `public/process_donation.php` with Razorpay integration

## 🛠️ Next Steps to Complete

### 1. Payment Processing
Create `public/process_donation.php` to handle actual payments via Razorpay.

### 2. Admin Features
Add these admin pages:
- `admin/manage_rooms.php` - Edit room details
- `admin/donations.php` - Full donation history
- `admin/settings.php` - Site settings

### 3. Email Notifications
Configure email sending for donation receipts.

### 4. Additional Features
- Export donation reports
- Donor certificates
- Social sharing
- Search functionality

## 📱 Responsive Design

The site is fully responsive and tested on:
- Desktop (1920px+)
- Laptop (1366px)
- Tablet (768px)
- Mobile (375px)

## 🔒 Security Features

- SQL injection protection (prepared statements)
- XSS protection (input sanitization)
- Password hashing (bcrypt)
- Session management
- Admin authentication

## 📈 Performance

- Optimized queries with indexes
- Minimal external dependencies
- Clean, efficient PHP code
- Progressive enhancement

## 🐛 Troubleshooting

### Database Connection Error
- Check `config/database.php` credentials
- Ensure MySQL is running
- Verify database exists

### Pages Not Loading
- Check file paths in includes
- Verify .htaccess if using Apache
- Check PHP error logs

### Styling Issues
- Clear browser cache
- Check CSS file path in header.php
- Verify assets folder permissions

## 📞 Support

For issues or questions:
- Email: contact@cancercare.org
- Phone: 98248 10036

## 📄 License

This project is created for the Cancer Care Foundation Rajkot.

## 🙏 Credits

Built with ❤️ for supporting cancer patients in need.

---

## Quick Start Checklist

- [ ] Download/extract project
- [ ] Create MySQL database
- [ ] Import database_schema.sql
- [ ] Import rooms_data.sql
- [ ] Update config/database.php
- [ ] Test website at /public/index.php
- [ ] Login to admin at /admin/login.php
- [ ] Change default admin password
- [ ] Configure Razorpay for payments
- [ ] Customize colors and content
- [ ] Test donation flow
- [ ] Launch! 🚀

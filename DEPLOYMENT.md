# PANDUAN DEPLOYMENT - AD COLLECTION

## 📋 Daftar Isi
1. [Hosting Online](#hosting-online)
2. [Hosting Gratis](#hosting-gratis)
3. [Setup Production](#setup-production)
4. [Security Checklist](#security-checklist)

---

## 🌐 Hosting Online

### Option 1: Niagahoster (Recommended)

#### Step 1: Beli Hosting
- Go to https://www.niagahoster.co.id
- Pilih paket (Basic cukup untuk project ini)
- Setup dengan PHP 8.0+

#### Step 2: Setup Database
1. Login ke cPanel
2. Buka phpMyAdmin
3. Create database: `ad_collection_prod`
4. Import `database_setup.sql`

#### Step 3: Upload Files
1. Go to File Manager di cPanel
2. Navigate ke `public_html`
3. Create folder: `uas-pw1`
4. Upload semua file project

#### Step 4: Configure Database
Edit `config/database.php`:
```php
$conn = mysqli_connect(
    'localhost',
    'niagauser_proddb',  // username dari cPanel
    'securepassword123', // password dari cPanel
    'niagauser_adcollection'  // database name
);
```

#### Step 5: Set Permissions
Via cPanel File Manager:
- `assets/img/uploads/` → 755
- `config/` → 644

#### Step 6: Test
Visit: `https://yourdomain.com/uas-pw1/`

---

### Option 2: Hostinger

#### Step 1: Setup
- Create hosting account
- Choose PHP 8.0+ plan
- Create FTP account

#### Step 2: Database
1. Go to hosting panel
2. Create MySQL database
3. Create MySQL user with password
4. Import `database_setup.sql`

#### Step 3: Upload via FTP
```
Using FileZilla or WinSCP:
- Host: ftp.yourdomain.com
- Username: ftp_username
- Password: ftp_password
- Upload to: public_html/uas-pw1/
```

#### Step 4: Configure
Edit `config/database.php` dengan credentials FTP

#### Step 5: Done
Visit: `https://yourdomain.com/uas-pw1/`

---

### Option 3: Railway.app (Modern Alternative)

#### Step 1: Create Account
- Go to https://railway.app
- Sign up dengan GitHub account

#### Step 2: Create New Project
1. Click "Create New Project"
2. Select "Deploy from GitHub"
3. Connect repository

#### Step 3: Setup Environment
1. Add MySQL service
2. Set environment variables:
```
DB_HOST=mysql
DB_USER=root
DB_PASSWORD=yourpassword
DB_NAME=ad_collection
```

#### Step 4: Deploy
- Railway akan auto-deploy setiap push ke GitHub
- Get domain dari Railway dashboard

#### Step 5: Setup Database
```bash
# Via SSH atau railway cli
mysql -h $DB_HOST -u $DB_USER -p $DB_PASSWORD < database_setup.sql
```

---

## 🆓 Hosting Gratis

### Option 1: Infinity Free Hosting

#### Advantages
- Forever free (no expiration)
- Unlimited disk & bandwidth
- PHP 7.4 - 8.0 support

#### Setup
1. Go to https://www.infinityfree.net
2. Create account
3. Upload via File Manager
4. Import database via phpMyAdmin

#### Limitations
- Limited CPU resources
- Limited concurrent connections
- Slower performance

### Option 2: Github Pages (Frontend Only)

Tidak cocok karena:
- Tidak support PHP
- Tidak support MySQL
Hanya bisa untuk static HTML/CSS/JS

### Option 3: Replit (Dev & Demo)

#### Setup
1. Go to https://replit.com
2. Create new project
3. Select "PHP"
4. Clone repository
5. Run `php -S localhost:8000`

#### Pros
- Instant deployment
- Free MySQL database
- Easy to share demo link

#### Cons
- Slow server response
- Limited for production

---

## 🔒 Setup Production

### Database Security

#### 1. Change Default Password
```bash
# Via phpMyAdmin atau terminal
ALTER USER 'admin'@'localhost' IDENTIFIED BY 'ComplexPassword123!@#';
FLUSH PRIVILEGES;
```

#### 2. Remove Anonymous Users
```bash
DELETE FROM mysql.user WHERE User='';
FLUSH PRIVILEGES;
```

#### 3. Create Production User
```bash
# Create new user for application
CREATE USER 'adcollection_user'@'localhost' IDENTIFIED BY 'SecurePassword123!@#';
GRANT SELECT, INSERT, UPDATE, DELETE ON ad_collection.* TO 'adcollection_user'@'localhost';
FLUSH PRIVILEGES;
```

### Application Security

#### 1. Update config/database.php
```php
<?php
// Production credentials
$host = 'localhost';
$user = 'adcollection_user';  // Non-root user
$pass = 'SecurePassword123!@#';
$db = 'ad_collection';

// Enable error reporting (for development only)
error_reporting(E_ALL);
ini_set('display_errors', 0); // Don't show errors to users
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error.log');

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, 'utf8mb4');
?>
```

#### 2. Enable HTTPS
- Get SSL certificate (Let's Encrypt = free)
- Force redirect from HTTP to HTTPS
- Update links in code

#### 3. Update .htaccess
Create `.htaccess` di root:
```apache
# Force HTTPS
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# Prevent directory listing
Options -Indexes

# Protect sensitive files
<FilesMatch "\.env$">
    Order allow,deny
    Deny from all
</FilesMatch>
```

#### 4. Environment Variables (Optional)
Jika menggunakan .env file:
```
DB_HOST=localhost
DB_USER=adcollection_user
DB_PASS=SecurePassword123!@#
DB_NAME=ad_collection
APP_ENV=production
```

Update config/database.php:
```php
<?php
// Load from .env if exists
if (file_exists('.env')) {
    $env = parse_ini_file('.env');
    $host = $env['DB_HOST'];
    $user = $env['DB_USER'];
    $pass = $env['DB_PASS'];
    $db = $env['DB_NAME'];
}
// ...
?>
```

### File Permissions (Linux/Unix)

```bash
# From terminal/SSH
chmod 755 /
chmod 755 assets/
chmod 755 assets/img/
chmod 755 assets/img/uploads/
chmod 644 *.php
chmod 644 includes/*.php
chmod 644 config/database.php
chmod 644 lib/*.php
```

### Session Security

Update `includes/header.php`:
```php
<?php
// Secure session configuration
session_start([
    'cookie_secure' => true,  // HTTPS only
    'cookie_httponly' => true, // No JavaScript access
    'cookie_samesite' => 'Strict', // CSRF protection
    'gc_maxlifetime' => 3600, // 1 hour
]);

// Regenerate session ID untuk security
if (!isset($_SESSION['init'])) {
    session_regenerate_id(true);
    $_SESSION['init'] = true;
}
?>
```

---

## ✅ Security Checklist

### Database
- ✅ Change default MySQL password
- ✅ Remove anonymous users
- ✅ Create separate DB user (non-root)
- ✅ Limit user privileges (SELECT, INSERT, UPDATE, DELETE only)

### Application
- ✅ Use prepared statements (MySQLi)
- ✅ Validate all inputs
- ✅ Sanitize outputs
- ✅ Hash passwords with BCRYPT
- ✅ Implement CSRF tokens (future)
- ✅ Use HTTPS/SSL
- ✅ Set secure session cookies

### Files & Folders
- ✅ Set proper file permissions (644 for files, 755 for folders)
- ✅ Protect sensitive files (.env, config)
- ✅ Disable directory listing
- ✅ Remove debug/test files
- ✅ Backup regularly

### Error Handling
- ✅ Don't show database errors to users
- ✅ Log errors to file instead
- ✅ Use generic error messages
- ✅ Monitor error logs regularly

---

## 🚀 Deployment Checklist

### Before Going Live

#### Code
- [ ] Remove all debug print statements
- [ ] Remove test data comments
- [ ] Check all links are correct
- [ ] Verify responsive design
- [ ] Test all features

#### Database
- [ ] Backup database
- [ ] Verify all tables created
- [ ] Insert sample data
- [ ] Test queries

#### Server
- [ ] Configure PHP settings
- [ ] Set file permissions
- [ ] Enable HTTPS
- [ ] Setup error logging
- [ ] Configure backups

#### Testing
- [ ] Test login/register
- [ ] Test CRUD operations
- [ ] Test exports (PDF, Excel)
- [ ] Test mobile responsiveness
- [ ] Test all browsers

### After Deployment

- [ ] Monitor error logs
- [ ] Check server resources
- [ ] Test application daily
- [ ] Backup database regularly
- [ ] Monitor server uptime
- [ ] Update dependencies
- [ ] Plan disaster recovery

---

## 📊 Performance Optimization

### Database
```php
// Add indexes untuk query yang sering digunakan
ALTER TABLE orders ADD INDEX (status);
ALTER TABLE orders ADD INDEX (tanggal);
ALTER TABLE order_items ADD INDEX (order_id);
ALTER TABLE products ADD INDEX (kategori);
```

### PHP
```php
// Enable opcode cache (PHP 5.5+)
// Biasanya sudah enabled di hosting

// Use persistent connections (if safe)
// $conn = mysqli_connect('p:localhost', $user, $pass, $db);
```

### Server
- Use CDN untuk static files
- Enable Gzip compression
- Cache static files browser
- Monitor database queries

---

## 📞 Support & Help

**Issues:**
- Check error logs
- Verify database connection
- Test with sample data
- Check file permissions

**Resources:**
- [PHP MySQLi Documentation](https://www.php.net/manual/en/book.mysqli.php)
- [Bootstrap Documentation](https://getbootstrap.com/docs)
- [MySQL Reference](https://dev.mysql.com/doc/)

---

## 📝 Important Notes

1. **Always backup database** sebelum update
2. **Test di localhost dulu** sebelum production
3. **Use strong passwords** untuk database
4. **Monitor logs regularly** untuk security issues
5. **Update dependencies** secara berkala

---

**Last Updated:** January 24, 2026
**Status:** ✅ Ready for Deployment

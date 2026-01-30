# AD COLLECTION - Fashion E-Commerce Management System

**Sistem Manajemen Fashion All-in-One untuk TikTok Shop & Shopee**

![Version](https://img.shields.io/badge/version-1.0-blue)
![License](https://img.shields.io/badge/license-MIT-green)
![PHP](https://img.shields.io/badge/PHP-8.0+-purple)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-blue)

---

## 📋 Daftar Isi

1. [Informasi Project](#-informasi-project)
2. [Persyaratan Soal](#-persyaratan-soal)
3. [Fitur Utama](#-fitur-utama)
4. [Teknologi](#-teknologi)
5. [Instalasi](#-instalasi--setup)
6. [Panduan Penggunaan](#-panduan-penggunaan)
7. [Struktur Database](#-struktur-database)
8. [Panduan Deployment](#-panduan-deployment)
9. [Screenshot & Demo](#-screenshot--demo)
10. [Kontributor](#-kontributor)

---

## 📌 Informasi Project

| Aspek | Keterangan |
|-------|-----------|
| **Nama Mata Kuliah** | Pemrograman Web 1 (3 SKS) |
| **Dosen Pengampu** | Nova Agustina, S.T., M.Kom. |
| **Tipe Ujian** | Take Home (1 Minggu) |
| **Universitas** | Universitas Teknologi Bandung (UTB) |
| **Departemen** | Departemen Bisnis Digital |
| **Semester** | Akhir (UAS) |
| **Kelas** | TIF 23 RP CMS C |
| **Mahasiswa** | Nazwa Khoerunnisa (23552011093) |
| **Repository** | https://github.com/username/UAS-PW1_AD-COLLECTION |
| **Status** | Selesai & Teruji ✅ |

---

## ✅ Persyaratan Soal

**a. ✅ Backend & Frontend Terintegrasi**
- Menggunakan PHP 8+ dengan MySQLi
- Bootstrap 5 CDN untuk responsive UI
- Custom CSS untuk tema consistent

**b. ✅ Dashboard sebagai Pusat Pengelolaan**
- Statistik penjualan harian
- Monitoring pesanan (pending, proses, dikirim, selesai)
- Produk terlaris dengan foto
- Breakdown penjualan per platform (TikTok, Shopee)

**c. ✅ Fitur Register & Login**
- Validasi input lengkap
- Password hashing menggunakan BCRYPT
- Session-based authentication
- Responsive design untuk mobile

**d. ✅ Laporan (Export) PDF & Excel**
- Export PDF untuk laporan penjualan
- Export Excel (CSV) untuk data penjualan
- Filter berdasarkan bulan, tahun, platform
- Hanya menampilkan pesanan yang selesai

**e. ✅ Fungsi CRUD Lengkap**
- **Products**: Create, Read, Update, Delete
- **Orders**: Create, Read, Update, Delete
- **Users**: Create, Read, Update (via Register & Profile)

**f. ✅ Session/Cookies Management**
- Session untuk autentikasi user
- Auto-redirect ke login jika belum login
- Logout dengan session destruction

**g. ✅ Studi Kasus Nyata**
- Fashion E-Commerce (Blouse Collection)
- Multi-platform (TikTok Shop, Shopee, Manual)
- Inventory tracking per variasi warna
- Real order flow management

**h. 🟡 Hosting Online**
- Persiapan: Kompatibel dengan shared hosting
- Panduan deployment disertakan

**i. ✅ Footer Copyright**
- Format: © Copyright by Nazwa Khoerunnisa (23552011093) - TIF RP 23 CNS C
- Ada di semua halaman aplikasi

**j. ✅ Link GitHub & Repository**
- Repository link: https://github.com/username/UAS-PW1_AD-COLLECTION
- Documentation lengkap di README

**k. ✅ Screenshot & Video Project**
- Multiple screenshots disertakan
- Video demo tersedia

**l. ✅ Topik Berbeda**
- Fashion E-Commerce Management System
- Multi-platform inventory management
- Bukan template generic

---

## 🎯 Fitur Utama

### 1. **Autentikasi & User Management**
- Register dengan validasi email & username
- Login dengan username atau email
- Password hashing secure (BCRYPT)
- Profile management
- Logout dengan session cleanup

### 2. **Dashboard**
- Statistik penjualan harian
- Monitoring pesanan by status
- Produk terlaris dengan grafik
- Breakdown penjualan per platform
- Real-time data updates

### 3. **Manajemen Produk**
- Create/Edit/Delete produk
- SKU unique identification
- Kategorisasi produk
- Harga beli & jual tracking
- Stock management per variasi
- 6 product variants (warna): Hitam, Denim, Burgundy, Olive, Cream, Mustard
- 6 produk blouse: Kanaya, Alesya, Arini, Friska, Nadlyne, Safana
- Foto produk upload & display

### 4. **Manajemen Pesanan**
- Create order dengan item details
- Multi-item per order
- Platform selection (TikTok, Shopee, Manual)
- Status tracking: Pending → Proses → Dikirim → Selesai/Batal
- Customer info management
- Order notes & remarks

### 5. **Laporan & Export**
- Sales report dengan filter
- Export to PDF
- Export to Excel (CSV)
- Periode filtering (bulan, tahun)
- Platform filtering
- Summary statistik

### 6. **Responsive Design**
- Mobile-first approach
- Hamburger menu on mobile
- Touch-friendly buttons
- Optimized untuk semua ukuran layar
- Landing page dengan animasi

### 7. **Landing Page**
- Hero section dengan background image
- Feature showcase
- Stats display
- CTA (Call-to-Action)
- Footer dengan copyright
- Smooth animations

---

## 🛠️ Teknologi

### Backend
- **PHP 8.0+** - Server-side scripting
- **MySQLi** - Database management (prepared statements)
- **Session** - User authentication

### Frontend
- **Bootstrap 5.3** - Responsive framework
- **Bootstrap Icons** - Icon library
- **Custom CSS3** - Styling & animations
- **Playfair Display** - Typography (serif)
- **Montserrat** - Body font

### Database
- **MySQL 8.0+** - Relational database
- **Tables**: users, products, product_variations, orders, order_items, activity_logs

### Tools
- **XAMPP/Laragon** - Local development
- **phpMyAdmin** - Database management
- **Git** - Version control

---

## 💾 Instalasi & Setup

### Prerequisites
- PHP 8.0+
- MySQL 8.0+
- Web server (Apache/Nginx)
- Composer (optional)

### Langkah Instalasi

#### 1. Clone Repository
```bash
git clone https://github.com/username/UAS-PW1_AD-COLLECTION.git
cd UAS-PW1_AD-COLLECTION
```

#### 2. Setup Database
```bash
# Buka phpMyAdmin
# Create database: ad_collection

# Import database_setup.sql
mysql -u root ad_collection < database_setup.sql
```

#### 3. Konfigurasi Database
Edit `config/database.php`:
```php
$conn = mysqli_connect('localhost', 'root', '', 'ad_collection');
```

#### 4. Jalankan Server
```bash
# Jika menggunakan Laragon
# Cukup start Laragon, buka: http://localhost/UAS-PW1_AD-COLLECTION

# Atau menggunakan PHP Built-in Server
php -S localhost:8000
```

#### 5. Login ke Sistem
```
URL: http://localhost/UAS-PW1_AD-COLLECTION
Username: admin
Password: password
```

---

## 📖 Panduan Penggunaan

### 1. **Login**
- Masuk dengan username: `admin` atau email: `admin@adcollection.com`
- Password: `password`

### 2. **Dashboard**
- Lihat statistik penjualan harian
- Monitor pesanan by status
- Lihat produk terlaris
- Breakdown penjualan per platform

### 3. **Manajemen Produk**
- Menu → Produk
- Tambah produk baru dengan SKU unik
- Edit harga, stok, deskripsi
- Delete produk (hati-hati!)

### 4. **Manajemen Pesanan**
- Menu → Pesanan
- Buat pesanan baru
- Edit status pesanan
- Lihat detail order items
- Delete pesanan

### 5. **Laporan**
- Menu → Laporan
- Filter by bulan, tahun, platform
- Lihat summary statistik
- Export to PDF atau Excel

### 6. **Logout**
- Klik menu → Logout
- Akan redirect ke landing page

---

## 📊 Struktur Database

### Tabel Users
```sql
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nama_lengkap VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  username VARCHAR(50) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin', 'user') DEFAULT 'admin',
  nomor_telepon VARCHAR(20),
  alamat TEXT,
  foto_profil VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Tabel Products
```sql
CREATE TABLE products (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nama_produk VARCHAR(100) NOT NULL,
  sku VARCHAR(50) UNIQUE NOT NULL,
  kategori VARCHAR(50) NOT NULL,
  deskripsi TEXT,
  harga_beli DECIMAL(10, 2) NOT NULL,
  harga_jual DECIMAL(10, 2) NOT NULL,
  stok INT DEFAULT 0,
  foto_produk VARCHAR(255),
  platform ENUM('tiktok', 'shopee', 'manual') DEFAULT 'manual',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### Tabel Product Variations
```sql
CREATE TABLE product_variations (
  id INT PRIMARY KEY AUTO_INCREMENT,
  product_id INT NOT NULL,
  nama_variasi VARCHAR(100) NOT NULL,
  nilai_variasi VARCHAR(100) NOT NULL,
  stok INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (product_id) REFERENCES products(id)
);
```

### Tabel Orders
```sql
CREATE TABLE orders (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nomor_pesanan VARCHAR(50) UNIQUE NOT NULL,
  user_id INT NOT NULL,
  nama_pembeli VARCHAR(100) NOT NULL,
  email_pembeli VARCHAR(100),
  nomor_telepon VARCHAR(20) NOT NULL,
  alamat_pengiriman TEXT NOT NULL,
  platform ENUM('tiktok', 'shopee', 'manual') DEFAULT 'manual',
  status ENUM('pending', 'proses', 'dikirim', 'selesai', 'batal') DEFAULT 'pending',
  total DECIMAL(12, 2) NOT NULL,
  tanggal DATETIME DEFAULT CURRENT_TIMESTAMP,
  catatan TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### Tabel Order Items
```sql
CREATE TABLE order_items (
  id INT PRIMARY KEY AUTO_INCREMENT,
  order_id INT NOT NULL,
  product_id INT NOT NULL,
  jumlah INT NOT NULL,
  harga_satuan DECIMAL(10, 2) NOT NULL,
  subtotal DECIMAL(12, 2) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (order_id) REFERENCES orders(id),
  FOREIGN KEY (product_id) REFERENCES products(id)
);
```

---

## 🚀 Panduan Deployment

### Hosting Online (Shared Hosting)

#### 1. **Choose Hosting Provider**
- Recommended: Niagahoster, Hostinger, Domainesia
- Requirements: PHP 8.0+, MySQL 8.0+

#### 2. **Upload Files**
```bash
# Via FTP/SFTP
# Upload semua file ke public_html folder
# Folder structure harus tetap sama
```

#### 3. **Database Setup**
```bash
# Via cPanel → phpMyAdmin
# Create database dengan nama yang sesuai
# Import database_setup.sql
```

#### 4. **Update Configuration**
Edit `config/database.php`:
```php
$host = 'localhost'; // atau host dari hosting provider
$user = 'username_db'; // username dari cPanel
$pass = 'password_db'; // password dari cPanel
$db = 'nama_database'; // nama database dari cPanel

$conn = mysqli_connect($host, $user, $pass, $db);
```

#### 5. **Set Permissions**
```bash
# Via FTP, set permissions:
# assets/img/uploads/ → 755
# config/ → 755
```

#### 6. **Test Application**
- Buka domain Anda
- Test login dengan admin/password
- Verify all features working

---

## 📸 Screenshot & Demo

### Landing Page
![Landing Page](screenshots/landing_page.png)
- Hero section dengan background image
- Feature showcase
- CTA buttons

### Login Page
![Login Page](screenshots/login_page.png)
- Responsive form
- Email/username input
- Password field
- Register link

### Dashboard
![Dashboard](screenshots/dashboard.png)
- Statistik penjualan
- Pesanan terbaru
- Produk terlaris
- Platform breakdown

### Products Page
![Products](screenshots/products_page.png)
- Product list dengan foto
- Edit & delete buttons
- Add product button
- Stock information

### Orders Page
![Orders](screenshots/orders_page.png)
- Order list dengan status
- Customer information
- Action buttons
- Status badges

### Reports Page
![Reports](screenshots/reports_page.png)
- Filter options (bulan, tahun, platform)
- Sales detail table
- Export buttons (PDF, Excel)
- Summary statistics

### Mobile Responsive
![Mobile View](screenshots/mobile_responsive.png)
- Hamburger menu
- Responsive sidebar
- Touch-friendly buttons
- Optimized layout

---

## 📁 Struktur File

```
UAS-PW1_AD-COLLECTION/
├── config/
│   └── database.php           # Database configuration
├── includes/
│   ├── header.php            # HTML header & CSS
│   ├── sidebar.php           # Navigation sidebar
│   └── footer.php            # Footer component
├── lib/
│   └── PDF.php               # PDF library
├── orders/
│   ├── index.php             # Order list
│   ├── create.php            # Create order form
│   ├── edit.php              # Edit order form
│   ├── store.php             # Store order data
│   ├── update.php            # Update order data
│   └── delete.php            # Delete order
├── products/
│   ├── index.php             # Product list
│   ├── create.php            # Create product form
│   ├── edit.php              # Edit product form
│   ├── store.php             # Store product data
│   ├── update.php            # Update product data
│   └── delete.php            # Delete product
├── reports/
│   ├── index.php             # Reports page
│   ├── export_pdf.php        # PDF export
│   └── export_excel.php      # Excel export
├── assets/
│   ├── img/
│   │   └── uploads/          # Product photos
│   └── css/                  # Custom styles
├── dashboard.php             # Main dashboard
├── landing.php               # Public landing page
├── login.php                 # Login page
├── register.php              # Register page
├── logout.php                # Logout handler
├── database_setup.sql        # Database initial data
└── README.md                 # This file
```

---

## 🔧 Troubleshooting

### Problem: Database Connection Error
**Solution:**
```php
// Check config/database.php
// Verify MySQL is running
// Verify username & password
```

### Problem: 404 Page Not Found
**Solution:**
- Check file paths are correct
- Verify .htaccess if using URL rewriting
- Check file permissions

### Problem: Session Not Working
**Solution:**
```php
// Ensure session_start() at top of file
// Check cookie settings in php.ini
// Clear browser cookies & try again
```

### Problem: Image Upload Not Working
**Solution:**
- Verify assets/img/uploads/ folder exists
- Set folder permissions to 755
- Check file size limits in php.ini

---

## 📋 Testing Checklist

- ✅ Login dengan admin account
- ✅ Register akun baru
- ✅ Create product baru
- ✅ Edit product
- ✅ Delete product
- ✅ Create order
- ✅ Update order status
- ✅ Export PDF report
- ✅ Export Excel report
- ✅ Responsive design mobile
- ✅ Logout & redirect landing
- ✅ Session management

---

## 📝 Catatan Pengembang

### Features Implemented
- ✅ Complete CRUD for Products & Orders
- ✅ Multi-platform support (TikTok, Shopee, Manual)
- ✅ Inventory tracking dengan variasi
- ✅ Sales reporting & export
- ✅ Responsive design
- ✅ Landing page dengan animasi
- ✅ Hamburger menu on mobile
- ✅ Session-based authentication

### Future Enhancements
- Payment gateway integration
- Email notifications
- SMS reminders
- Advanced analytics
- Multi-user roles & permissions
- API endpoints for mobile app
- Real-time notifications

---

## 📞 Kontakt & Support

**Pengembang:**
- Nama: Nazwa Khoerunnisa
- NIM: 23552011093
- Email: nazwa@student.utb.ac.id
- GitHub: https://github.com/username

**Dosen Pembimbing:**
- Nova Agustina, S.T., M.Kom.

---

## 📄 Lisensi

MIT License - Feel free to use this project for educational purposes.

Copyright © 2024 Nazwa Khoerunnisa

---

## 🎓 Mata Kuliah

**Pemrograman Web 1 (3 SKS)**
Universitas Teknologi Bandung - Departemen Bisnis Digital

---

**Last Updated:** January 24, 2026
**Status:** ✅ Complete & Tested

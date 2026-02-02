# AD COLLECTION - Fashion E-Commerce Management System

**Sistem Manajemen Fashion untuk TikTok Shop & Shopee**

![PHP](https://img.shields.io/badge/PHP-8.0+-purple)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-blue)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-green)
![Status](https://img.shields.io/badge/Status-Complete-brightgreen)

---

## 📌 Project Information

| Item | Detail |
|------|--------|
| **Project** | AD COLLECTION |
| **Student** | Nazwa Khoerunnisa |
| **NIM** | 23552011093 |
| **Class** | TIF 23 RP CMS C |
| **University** | Universitas Teknologi Bandung |
| **Subject** | Pemrograman Web 1 (3 SKS) |
| **Lecturer** | Nova Agustina, S.T., M.Kom. |
| **Repository** | https://github.com/NazwaKhoerunnisa/UAS-Pemrograman_Web_1 |

---

**Link Website:** https://adcollection.infinityfree.me/

## 🎯 Project Overview

AD COLLECTION adalah sistem manajemen fashion e-commerce yang complete dengan fitur dashboard, CRUD products & orders, reporting, export PDF/Excel, dan responsive design untuk TikTok Shop & Shopee.

---

## 🖼️ Screenshots

### Landing Page
![Landing Page](AD-COLLECTION/assets/img/uploads/landingpage.jpeg)

### Authentication (Login & Register)
![Login](AD-COLLECTION/assets/img/uploads/login.JPG)

![Register](AD-COLLECTION/assets/img/uploads/register.jpeg)

### Dashboard
![Dashboard](AD-COLLECTION/assets/img/uploads/dashboard.jpeg)

### Products Management
![Produk](AD-COLLECTION/assets/img/uploads/produk.jpeg)

![Tambah Produk](AD-COLLECTION/assets/img/uploads/tambah%20produk.jpeg)

### Orders Management
![Tambah Pesanan](AD-COLLECTION/assets/img/uploads/tambahpesanan.jpeg)

![Detail Pesanan](AD-COLLECTION/assets/img/uploads/pesanan.jpeg)

### Reports & Export
![Laporan](AD-COLLECTION/assets/img/uploads/laporan.jpeg)

![Export PDF](AD-COLLECTION/assets/img/uploads/exportpdf.jpeg)

![Export Excel](AD-COLLECTION/assets/img/uploads/eksportexcell.JPG)

---
## ✨ Key Features

- ✅ Dashboard dengan statistik penjualan real-time
- ✅ Sistem register & login dengan BCRYPT hashing
- ✅ CRUD lengkap untuk produk (6 blouse products)
- ✅ CRUD lengkap untuk pesanan (8 sample orders)
- ✅ Export laporan ke PDF & Excel
- ✅ Multi-platform support (TikTok, Shopee, Manual)
- ✅ Responsive design dengan hamburger menu mobile
- ✅ Session management & security
- ✅ Product image management
- ✅ Order status tracking

---

## 🔐 Login Credentials

```
Username: admin
Password: password
Email: admin@adcollection.com
```

---

## 🚀 Quick Start

### 1. Database Setup
```bash
mysql -u root < AD-COLLECTION/database_setup.sql
```

### 2. Access Application
```
URL: http://localhost/UAS-Pemrograman_Web_1/AD-COLLECTION/
```

### 3. Test Features
- Dashboard
- Products CRUD
- Orders CRUD
- Reports & Export

---

## 📁 Project Structure

```
UAS-Pemrograman_Web_1/
├── README.md                    (This file)
│
└── AD-COLLECTION/               (Main application)
    ├── dashboard.php            (Main dashboard)
    ├── landing.php              (Landing page)
    ├── login.php                (Authentication)
    ├── register.php             (Registration)
    ├── logout.php               (Logout)
    ├── index.php                (Redirect)
    ├── database_setup.sql       (Database)
    │
    ├── config/
    │   └── database.php         (DB connection)
    │
    ├── includes/
    │   ├── header.php           (HTML & CSS)
    │   ├── sidebar.php          (Navigation)
    │   └── footer.php           (Footer)
    │
    ├── products/                (Product CRUD)
    ├── orders/                  (Order CRUD)
    ├── reports/                 (Reports & Export)
    ├── assets/                  (Images & uploads)
    ├── bootstrap/               (Bootstrap files)
    └── lib/                     (PDF library)
```

---

## 🛠️ Technology Stack

- **PHP 8.0+**
- **MySQL 8.0+**
- **Bootstrap 5.3**
- **CSS3 Animations**
- **BCRYPT Password Hashing**
- **MySQLi Prepared Statements**

---

## ✅ Requirements (11/12)

| Requirement | Status |
|-------------|--------|
| A. Backend & Frontend Integrated | ✅ |
| B. Dashboard | ✅ |
| C. Register & Login | ✅ |
| D. Export (PDF & Excel) | ✅ |
| E. CRUD Operations | ✅ |
| F. Session Management | ✅ |
| G. Real Business Case | ✅ |
| H. Online Hosting | 🟡 Ready |
| I. Copyright Footer | ✅ |
| J. GitHub Link | ✅ |
| K. Screenshots & Video | ✅ |
| L. Different Topic | ✅ |

**Score: 11/12 ✅ (92% Complete)**

---

## 📊 Database

**6 Tables:**
- `users` (1 admin account)
- `products` (6 blouse products)
- `product_variations` (6 colors each)
- `orders` (8 sample orders)
- `order_items` (10 sample items)
- `activity_logs` (optional)

---

## 🔐 Security

✅ BCRYPT password hashing  
✅ Prepared statements (SQL injection prevention)  
✅ Session management  
✅ Input validation  
✅ Error logging  

---

## 📱 Responsive Design

- Desktop view dengan full sidebar
- Mobile view dengan hamburger menu
- Touch-friendly interface
- CSS3 animations
- Optimized untuk semua ukuran layar

---

## 📄 License

MIT License - For educational purposes

---

## 👤 Author

**Nazwa Khoerunnisa** (23552011093)  
**Class:** TIF 23 RP CMS C  
**University:** Universitas Teknologi Bandung  
**GitHub:** https://github.com/NazwaKhoerunnisa

---

## 🎓 Course Information

**Subject:** Pemrograman Web 1 (3 SKS)  
**Lecturer:** Nova Agustina, S.T., M.Kom.  
**Type:** UAS Take Home  
**University:** Universitas Teknologi Bandung  

---

## 📞 Contact

- **GitHub:** https://github.com/NazwaKhoerunnisa
- **Email:** nazwa@student.utb.ac.id

---

## 🌐 Deployment

Project ini siap untuk di-deploy ke:
- DigitalOcean ($200 free dari GitHub Student Pack)
- Railway.app (Free tier)
- Infinity Free Hosting (Forever free)
- Shared hosting dengan PHP 8.0+ & MySQL

---

## 📝 Features Detail

### Dashboard
- Statistik penjualan harian
- Pesanan terbaru monitoring
- Produk terlaris dengan foto
- Platform breakdown

### Products Management
- Create, read, update, delete
- 6 blouse products
- 6 color variations per product
- Photo upload & display

### Orders Management
- Create, read, update, delete
- Multi-item per order
- Status tracking (pending → proses → dikirim → selesai)
- Platform selection

### Reports & Export
- Filter by month, year, platform
- Export to PDF
- Export to Excel (CSV)
- Only completed orders (status='selesai')

---

**Status:** ✅ Complete & Ready for Evaluation  
**Last Updated:** January 31, 2026  
**Version:** 1.0 Final Release


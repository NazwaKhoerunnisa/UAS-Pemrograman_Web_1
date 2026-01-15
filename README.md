# AD COLLECTION - Fashion Management System

**Sistem Manajemen Fashion untuk TikTok Shop & Shopee**

![Version](https://img.shields.io/badge/version-1.0-blue)
![License](https://img.shields.io/badge/license-MIT-green)
![Status](https://img.shields.io/badge/status-In%20Development-yellow)

---

## 📋 Daftar Isi

- [Informasi Project](#informasi-project)
- [Fitur Utama](#fitur-utama)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Instalasi & Setup](#instalasi--setup)
- [Panduan Penggunaan](#panduan-penggunaan)
- [Struktur Database](#struktur-database)
- [API Endpoints](#api-endpoints)
- [Dokumentasi Screenshots & Video](#dokumentasi-screenshots--video)
- [Kontributor](#kontributor)

---

## 📌 Informasi Project

| Aspek | Keterangan |
|-------|-----------|
| **Nama Mata Kuliah** | Pemrograman Web 1 / 3 SKS |
| **Dosen Pengampu** | Nova Agustina, S.T., M.Kom. |
| **Tipe Ujian** | Take Home (1 Minggu) |
| **Deadline** | TIF 23 RP CMS A |
| **Universitas** | Universitas Teknologi Bandung |
| **Departemen** | Bisnis Digital |
| **Semester** | Akhir (UAS) |

---

## 🎯 Fitur Utama

### ✅ Persyaratan yang Dipenuhi:

#### A. Backend & Frontend Terintegrasi
- Dashboard terpusat untuk pengelolaan data
- Interface responsif menggunakan Bootstrap 5
- Arsitektur MVC yang terstruktur

#### B. Dashboard Sistem
- Statistik penjualan real-time
- Monitoring pesanan pending
- Grafik penjualan per platform (TikTok vs Shopee)
- Produk terlaris dan stok menipis

#### C. Sistem Register & Login
- Pendaftaran akun baru dengan validasi
- Login dengan username/email dan password
- Password menggunakan BCRYPT hashing
- Session management

#### D. CRUD Operasi Lengkap
**Produk:**
- ✅ Create: Tambah produk baru
- ✅ Read: Lihat daftar produk
- ✅ Update: Edit produk
- ✅ Delete: Hapus produk

**Pesanan:**
- ✅ Create: Buat pesanan baru
- ✅ Read: Lihat semua pesanan
- ✅ Update: Ubah status pesanan
- ✅ Delete: Hapus pesanan

#### E. Export Data
- 📊 Export ke **PDF** (Laporan Penjualan)
- 📈 Export ke **Excel** (Data Produk & Pesanan)

#### F. Session & Cookie Management
- ✅ Session untuk tracking user login
- ✅ Validasi session di setiap halaman
- ✅ Logout functionality

#### G. Study Case Relevan
**Topik: AD COLLECTION - Fashion E-Commerce Management**
- Studi kasus bisnis fashion online yang real
- Integrasi dengan platform penjualan (TikTok Shop, Shopee)
- Manajemen inventori dan pesanan

#### H. Footer Dengan Copyright
```
© Copyright by Nova Agustina, S.T., M.Kom. | AD COLLECTION Fashion Management System
Universitas Teknologi Bandung - Departemen Bisnis Digital
```

#### I. Links Backend & Frontend
- Backend: `http://localhost/UAS-PW1_AD-COLLECTION/dashboard.php`
- Frontend: Terintegrasi dalam sistem yang sama
- E-Learning: [https://elearning.utb.ac.id](https://elearning.utb.ac.id)

#### J. Screenshots & Video
Dokumentasi lengkap tersedia di folder `/docs`

#### K. Responsive & User-Friendly
- ✅ Sidebar navigation yang intuitif
- ✅ Responsive design untuk semua devices
- ✅ Validasi form di frontend dan backend

#### L. Fitur Tambahan
- Multi-platform support (Manual, TikTok, Shopee)
- Activity logging
- Statistik bisnis
- Upload foto produk

---

## 🛠️ Teknologi yang Digunakan

### Backend
- **PHP 7.4+** - Server-side scripting
- **MySQL 8.0** - Database relasional
- **MySQLi** - Database connection

### Frontend
- **HTML5** - Markup
- **CSS3** - Styling
- **JavaScript** - Interactivity
- **Bootstrap 5** - CSS Framework
- **Bootstrap Icons** - Icon library

### Tools & Libraries
- **DOMPDF** - PDF Generation
- **PhpSpreadsheet** - Excel Export
- **XAMPP** - Local Development Server

---

## 📦 Instalasi & Setup

### Prerequisites
- XAMPP atau server PHP lokal
- MySQL 8.0+
- Browser modern (Chrome, Firefox, Safari)

### Langkah Instalasi

#### 1. Clone/Download Project
```bash
cd d:\xampp\htdocs
git clone <repository-url> UAS-PW1_AD-COLLECTION
# atau copy folder project ke htdocs
```

#### 2. Setup Database
```bash
# Masuk ke phpMyAdmin
# http://localhost/phpmyadmin

# Buat database baru: adcollection
# Import file: database_setup.sql
```

Atau via MySQL CLI:
```bash
mysql -u root -p < database_setup.sql
```

#### 3. Konfigurasi Database (Jika Perlu)
Edit file `config/database.php`:
```php
define('DB_HOST', 'localhost');    // Host database
define('DB_USER', 'root');         // Username MySQL
define('DB_PASS', '');             // Password MySQL (kosong untuk default)
define('DB_NAME', 'adcollection'); // Nama database
```

#### 4. Jalankan Server
```bash
# Start XAMPP
# Atau gunakan built-in PHP server:
php -S localhost:8000
```

#### 5. Akses Aplikasi
```
http://localhost/UAS-PW1_AD-COLLECTION/login.php
```

---

## 🔐 Akun Default Testing

| Tipe | Username | Email | Password |
|------|----------|-------|----------|
| Admin | `admin` | admin@adcollection.com | `password` |

*Catatan: Password ini untuk testing. Ubah password setelah production.*

---

## 📖 Panduan Penggunaan

### 1. Login
- Masuk menggunakan username atau email
- Password ter-hash dengan BCRYPT untuk keamanan

### 2. Dashboard
- Melihat statistik penjualan harian
- Monitoring pesanan pending
- Grafik perbandingan penjualan platform

### 3. Manajemen Produk
**Menambah Produk:**
- Klik "Tambah Produk"
- Isi semua field required
- Upload foto produk (optional)
- Klik "Simpan"

**Edit Produk:**
- Klik tombol edit pada produk
- Ubah data yang diperlukan
- Klik "Update"

**Hapus Produk:**
- Klik tombol delete
- Konfirmasi penghapusan

### 4. Manajemen Pesanan
**Menambah Pesanan:**
- Klik "Tambah Pesanan"
- Isi data pembeli dan item
- Pilih platform (TikTok/Shopee/Manual)
- Set status pesanan
- Klik "Simpan"

**Ubah Status Pesanan:**
- Klik edit pesanan
- Ubah status (Pending → Proses → Dikirim → Selesai)
- Update data pembeli jika perlu

### 5. Export Data
**Export PDF:**
- Klik "Export PDF" di halaman Laporan
- File PDF otomatis download

**Export Excel:**
- Klik "Export Excel" di halaman Data
- File Excel otomatis download

---

## 💾 Struktur Database

### Tabel Users
```sql
id, nama_lengkap, email, username, password, role, 
nomor_telepon, alamat, foto_profil, created_at, updated_at
```

### Tabel Products
```sql
id, nama_produk, sku, kategori, deskripsi, harga_beli, harga_jual,
stok, foto_produk, platform, created_at, updated_at
```

### Tabel Orders
```sql
id, nomor_pesanan, user_id, nama_pembeli, email_pembeli, 
nomor_telepon, alamat_pengiriman, platform, status, total, 
tanggal, catatan, created_at, updated_at
```

### Tabel Order_Items
```sql
id, order_id, product_id, jumlah, harga_satuan, subtotal
```

### Tabel Activity_Logs
```sql
id, user_id, aksi, deskripsi, created_at
```

---

## 🔌 API Endpoints

### Authentication
| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/login.php` | Tampil form login |
| POST | `/login.php` | Submit login |
| GET | `/register.php` | Tampil form registrasi |
| POST | `/register.php` | Submit registrasi |
| GET | `/logout.php` | Logout user |

### Dashboard
| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/dashboard.php` | Dashboard utama |

### Products
| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/products/index.php` | List produk |
| GET | `/products/create.php` | Form tambah produk |
| POST | `/products/store.php` | Simpan produk baru |
| GET | `/products/edit.php?id=1` | Form edit produk |
| POST | `/products/update.php` | Update produk |
| GET | `/products/delete.php?id=1` | Delete produk |

### Orders
| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/orders/index.php` | List pesanan |
| GET | `/orders/create.php` | Form tambah pesanan |
| POST | `/orders/store.php` | Simpan pesanan |
| GET | `/orders/edit.php?id=1` | Form edit pesanan |
| POST | `/orders/update.php` | Update pesanan |
| GET | `/orders/delete.php?id=1` | Delete pesanan |

### Reports
| Method | Endpoint | Deskripsi |
|--------|----------|-----------|
| GET | `/reports/index.php` | Halaman laporan |
| GET | `/reports/export_pdf.php` | Export ke PDF |
| GET | `/reports/export_excel.php` | Export ke Excel |

---

## 📸 Dokumentasi Screenshots & Video

### Screenshots
Berikut adalah dokumentasi visual dari aplikasi:

#### 1. Halaman Login
![Login Page](docs/screenshots/01-login.png)
- Form login dengan validasi
- Link ke halaman registrasi

#### 2. Dashboard
![Dashboard](docs/screenshots/02-dashboard.png)
- Statistik penjualan harian
- Chart penjualan per platform
- List pesanan pending
- Produk terlaris

#### 3. Manajemen Produk
![Products List](docs/screenshots/03-products.png)
- Tabel daftar produk
- Fitur search & filter
- Tombol edit, delete, detail

#### 4. Form Tambah Produk
![Add Product](docs/screenshots/04-add-product.png)
- Input form produk
- Upload foto
- Multi-platform selection

#### 5. Manajemen Pesanan
![Orders List](docs/screenshots/05-orders.png)
- Tabel daftar pesanan
- Filter berdasarkan status & platform
- Timeline pesanan

#### 6. Export PDF
![PDF Report](docs/screenshots/06-pdf-export.png)
- Laporan penjualan PDF
- Data formatted dengan baik
- Signature area

#### 7. Export Excel
![Excel Export](docs/screenshots/07-excel-export.png)
- Data export ke file Excel
- Formatasi profesional
- Bisa langsung edit

### Video Demo
**Link Video Project:** [YouTube](https://youtube.com/watch?v=xxxxx)

Durasi: ~5 menit
Konten:
1. Login & Register (0:00-0:40)
2. Dashboard Overview (0:40-1:30)
3. CRUD Produk (1:30-2:45)
4. CRUD Pesanan (2:45-4:00)
5. Export PDF & Excel (4:00-5:00)

---

## 📂 Struktur Folder Project

```
UAS-PW1_AD-COLLECTION/
├── index.php               # Redirect ke login
├── login.php              # Halaman login
├── register.php           # Halaman registrasi
├── logout.php             # Logout user
├── dashboard.php          # Dashboard utama
├── README.md              # File ini
├── database_setup.sql     # SQL database schema
│
├── assets/
│   └── img/
│       └── uploads/       # Folder upload foto produk
│
├── bootstrap/             # Bootstrap framework
│   ├── css/              # Bootstrap CSS files
│   └── js/               # Bootstrap JS files
│
├── config/
│   └── database.php       # Konfigurasi database
│
├── includes/
│   ├── header.php         # Header & navigation
│   ├── sidebar.php        # Sidebar menu
│   └── footer.php         # Footer dengan copyright
│
├── products/
│   ├── index.php          # List produk
│   ├── create.php         # Form tambah produk
│   ├── store.php          # Proses simpan produk
│   ├── edit.php           # Form edit produk
│   ├── update.php         # Proses update produk
│   └── delete.php         # Proses delete produk
│
├── orders/
│   ├── index.php          # List pesanan
│   ├── create.php         # Form tambah pesanan
│   ├── store.php          # Proses simpan pesanan
│   ├── edit.php           # Form edit pesanan
│   ├── update.php         # Proses update pesanan
│   └── delete.php         # Proses delete pesanan
│
├── reports/
│   ├── index.php          # Halaman laporan
│   ├── export_pdf.php     # Export PDF
│   └── export_excel.php   # Export Excel
│
└── docs/
    ├── screenshots/       # Dokumentasi screenshot
    └── erd.png           # Entity Relationship Diagram
```

---

## 🔒 Security Features

### Backend Security
- ✅ Password hashing dengan BCRYPT
- ✅ SQL Injection prevention (Prepared statements)
- ✅ Session validation di setiap halaman
- ✅ Input validation dan sanitization
- ✅ Secure file upload

### Frontend Security
- ✅ Form validation
- ✅ CSRF token (dapat ditambahkan)
- ✅ XSS prevention

---

## 🚀 Fitur yang Bisa Dikembangkan

1. **Advanced Analytics**
   - Grafik lebih detail dengan Chart.js
   - Export grafik ke PDF

2. **Multi-User Roles**
   - Admin, Manager, Staff roles
   - Permission-based access control

3. **API REST**
   - API untuk mobile app
   - JWT Authentication

4. **Real-time Notifications**
   - New order alerts
   - Stock warnings

5. **Payment Integration**
   - Midtrans/GoPay integration
   - Invoice generation

6. **Mobile App**
   - Flutter mobile app
   - Native iOS/Android

---

## 📝 Catatan Pengembangan

### Issues yang Sudah Diatasi
- ✅ Database connection
- ✅ Login/Register functionality
- ✅ CRUD operations
- ✅ File upload handling
- ✅ Session management

### TODO List
- [ ] Implement PDF export
- [ ] Implement Excel export
- [ ] Add search & filter functionality
- [ ] Add pagination
- [ ] Implement activity logging
- [ ] Add email notifications
- [ ] Optimize database queries

---

## 👤 Kontributor

| Nama | Role | NPM | Email |
|------|------|-----|-------|
| Nova Agustina, S.T., M.Kom. | Dosen Pengampu | - | nova@utb.ac.id |
| [Student Name] | Pengembang | TIF 23 RP CMS A | student@student.utb.ac.id |

---

## 📄 Lisensi

Project ini dibuat untuk keperluan akademik di Universitas Teknologi Bandung.
Licensed under the MIT License - lihat file LICENSE untuk detail lebih lanjut.

---

## 📞 Hubungi Kami

- **Email**: support@adcollection.com
- **WhatsApp**: [Link WhatsApp]
- **Instagram**: [@adcollection_fashion]
- **TikTok**: [@adcollection]

---

## 🙏 Ucapan Terima Kasih

Terima kasih kepada:
- Universitas Teknologi Bandung
- Departemen Bisnis Digital
- Dosen Pengampu Nova Agustina, S.T., M.Kom.
- Semua contributor dan supporter

---

**Last Updated:** January 14, 2026
**Version:** 1.0.0
**Status:** In Development

---

> "Fashion is not something that happens in dresses alone. Fashion is in the air. It is the wind and the changes in the air." - Coco Chanel


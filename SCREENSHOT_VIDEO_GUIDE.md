# DOKUMENTASI SCREENSHOT & VIDEO - AD COLLECTION

## 📸 Panduan Mengambil Screenshot

### Tools yang Direkomendasikan
1. **Built-in Windows** - Print Screen
2. **Snipping Tool** - Windows built-in tool
3. **Greenshot** - Free screenshot tool
4. **Nimbus Screenshot** - Browser extension

---

## 📋 Screenshot Checklist

### 1. Landing Page (Public)
**File:** `landing.php`
**Apa yang ditampilkan:**
- [ ] Hero section dengan background image
- [ ] Feature showcase section
- [ ] Statistics display
- [ ] Call-to-action buttons
- [ ] Footer dengan copyright

**Perintah Ambil SS:**
1. Buka: http://localhost/UAS-PW1_AD-COLLECTION/landing.php
2. Scroll ke atas
3. Screenshot full page

**Expected Output:** Halaman cantik dengan background fashion, tombol "Login" prominent

---

### 2. Login Page
**File:** `login.php`
**Apa yang ditampilkan:**
- [ ] Login form dengan username field
- [ ] Password field
- [ ] Remember me checkbox
- [ ] Login button
- [ ] Register link
- [ ] Form validation messages (jika ada error)

**Perintah Ambil SS:**
1. Buka: http://localhost/UAS-PW1_AD-COLLECTION/login.php
2. Screenshot form area

**Expected Output:** Form login yang clean dan responsive

---

### 3. Register Page
**File:** `register.php`
**Apa yang ditampilkan:**
- [ ] Nama lengkap field
- [ ] Email field
- [ ] Username field
- [ ] Password field
- [ ] Confirm password field
- [ ] Nomor telepon field
- [ ] Register button
- [ ] Login link

**Perintah Ambil SS:**
1. Buka: http://localhost/UAS-PW1_AD-COLLECTION/register.php
2. Screenshot full form

**Expected Output:** Form register lengkap dengan semua field

---

### 4. Dashboard (Main)
**File:** `dashboard.php`
**Apa yang ditampilkan:**
- [ ] Welcome message
- [ ] Statistik cards (Penjualan, Produk, Pesanan)
- [ ] Pesanan terbaru table
- [ ] Produk terlaris section dengan foto
- [ ] Platform breakdown

**Perintah Ambil SS:**
1. Login dengan admin/password
2. Redirect otomatis ke dashboard
3. Screenshot full dashboard

**Expected Output:**
- Cards dengan statistik harian
- Tabel pesanan terbaru dengan field: Nomor Pesanan, Nama Pembeli, Status
- Produk terlaris dengan foto produk visible

---

### 5. Products Page - List View
**File:** `products/index.php`
**Apa yang ditampilkan:**
- [ ] Product table dengan columns:
  - SKU
  - Nama produk
  - Kategori
  - Harga jual
  - Stock
  - Foto (thumbnail)
  - Action buttons (Edit, Delete)
- [ ] Add Product button
- [ ] Search/filter options (jika ada)

**Perintah Ambil SS:**
1. Click "Produk" di sidebar
2. Lihat product list
3. Screenshot table dengan beberapa produk
4. Pastikan foto terlihat (highlight ke Produk Terlaris yang punya foto)

**Expected Output:** Tabel produk dengan 6 blouse products visible, foto muncul

---

### 6. Products Page - Create/Edit
**File:** `products/create.php` atau `products/edit.php`
**Apa yang ditampilkan:**
- [ ] Nama produk field
- [ ] SKU field
- [ ] Kategori dropdown
- [ ] Harga beli field
- [ ] Harga jual field
- [ ] Stock field
- [ ] File upload untuk foto
- [ ] Submit button

**Perintah Ambil SS:**
1. Click "Tambah Produk"
2. Screenshot form kosong
3. Atau click Edit di salah satu produk
4. Screenshot form terisi

**Expected Output:** Form create/edit produk dengan semua field visible

---

### 7. Orders Page - List View
**File:** `orders/index.php`
**Apa yang ditampilkan:**
- [ ] Orders table dengan columns:
  - Nomor pesanan
  - Nama pembeli
  - Platform (TikTok/Shopee)
  - Status (badge dengan warna)
  - Total harga
  - Tanggal
  - Action buttons (View, Edit, Delete)
- [ ] Add Order button

**Perintah Ambil SS:**
1. Click "Pesanan" di sidebar
2. Lihat order list
3. Screenshot dengan status badges visible (various colors)

**Expected Output:** Tabel pesanan dengan status badges berwarna (pending=yellow, proses=blue, dikirim=info, selesai=success, batal=danger)

---

### 8. Orders Page - Create
**File:** `orders/create.php`
**Apa yang ditampilkan:**
- [ ] Nomor pesanan field (auto-generated)
- [ ] Customer info (Nama, Email, No Telp, Alamat)
- [ ] Platform selector
- [ ] Add item button untuk product selection
- [ ] Item list dengan product, quantity, harga
- [ ] Total calculation
- [ ] Submit button

**Perintah Ambil SS:**
1. Click "Tambah Pesanan"
2. Screenshot form kosong
3. Jika ada item sudah ditambah, screenshot dengan items visible

**Expected Output:** Form create order dengan customer fields dan item selection area

---

### 9. Reports Page
**File:** `reports/index.php`
**Apa yang ditampilkan:**
- [ ] Filter section:
  - Month dropdown
  - Year dropdown
  - Platform selector
  - Submit filter button
- [ ] Report table dengan columns:
  - Nomor pesanan
  - Nama pembeli
  - Platform
  - Total
  - Tanggal
- [ ] Export buttons (PDF, Excel)
- [ ] Summary statistics

**Perintah Ambil SS:**
1. Click "Laporan" di sidebar
2. Select filter (bulan, tahun, platform)
3. Screenshot report dengan data terlihat
4. Screenshot dengan export buttons visible

**Expected Output:** Report dengan filter options dan export buttons prominent

---

### 10. Mobile Responsive - Hamburger Menu
**File:** Semua pages
**Apa yang ditampilkan:**
1. **Desktop view (normal sidebar visible)**
   - Sidebar with navigation links
   - Full content area

2. **Mobile view (hamburger menu)**
   - Hamburger icon (3 lines) di top-left
   - Content full width
   - Sidebar tersembunyi/off-screen

3. **Mobile view (menu opened)**
   - Sidebar slide in dari kiri
   - Overlay/backdrop visible
   - Menu items clickable

**Perintah Ambil SS Mobile:**

**Cara 1: Resize Browser**
1. Buka dashboard di Chrome
2. Press F12 untuk Developer Tools
3. Click device icon untuk mobile view
4. Select "iPhone 12" atau "Galaxy S21"
5. Screenshot 3 versions:
   - Full page normal
   - Hamburger icon visible
   - Sidebar open (click hamburger)

**Cara 2: Screenshot di HP**
1. Access via: http://192.168.X.X:8000 (ganti IP)
2. Open di HP
3. Screenshot normal view
4. Click hamburger
5. Screenshot menu open

**Expected Output:**
- Screenshot 1: Desktop view dengan sidebar
- Screenshot 2: Mobile view dengan hamburger icon
- Screenshot 3: Mobile view dengan sidebar terbuka

---

### 11. Mobile Responsive - Other Pages
**Apa yang ditampilkan:**
- [ ] Login page di mobile (responsive form)
- [ ] Register page di mobile (responsive form)
- [ ] Product list di mobile (stacked layout)
- [ ] Orders list di mobile (stacked layout)
- [ ] Dashboard di mobile (cards stacked)

**Perintah Ambil SS:**
1. F12 → Mobile view
2. Navigate ke setiap page
3. Screenshot showing responsive layout

**Expected Output:** Form/tables yang responsive, tidak ada horizontal scroll

---

## 🎥 Video Demonstration

### Format Video Recommended
- Resolution: 1280×720 (720p)
- Format: MP4
- Duration: 3-5 minutes
- Narration: Optional (tapi bagus untuk penjelasan)

### Tools untuk Recording
1. **OBS Studio** (Free, professional)
2. **Camtasia** (Paid, user-friendly)
3. **Windows Game Bar** (Built-in, limited)
4. **Greenshot** (Free, simple)
5. **Loom** (Free web-based)

---

## 📹 Video Checklist - Complete Walkthrough (3-5 minutes)

### Timeline Video

**0:00-0:30 - Introduction**
- [ ] Intro slide atau screen showing project title
- [ ] "AD COLLECTION - Fashion E-Commerce Management System"
- [ ] Keterangan: UAS PW1, Nazwa Khoerunnisa, UTB

**0:30-0:45 - Landing Page**
- [ ] Show landing.php
- [ ] Highlight: Hero section, background image, features section
- [ ] Demonstrate: Scroll down dan lihat animations

**0:45-1:15 - Authentication (Register & Login)**
- [ ] Show register.php form
- [ ] Fill form dengan data dummy
- [ ] Click register (pastikan success)
- [ ] Then show login.php
- [ ] Login dengan credentials yang baru dibuat
- [ ] Show redirect ke dashboard

**1:15-1:45 - Dashboard**
- [ ] Show main dashboard
- [ ] Highlight statistics cards (Penjualan, Produk, Pesanan)
- [ ] Scroll down to "Pesanan Terbaru"
- [ ] Show pesanan terbaru table dengan status
- [ ] Scroll to "Produk Terlaris"
- [ ] Highlight bahwa foto produk terlihat
- [ ] Explain breakdown penjualan per platform

**1:45-2:15 - CRUD Operations (Products)**
- [ ] Click "Produk" di sidebar
- [ ] Show product list dengan foto
- [ ] Click "Tambah Produk"
- [ ] Fill form create produk
- [ ] Submit dan show success
- [ ] Click Edit di salah satu produk
- [ ] Edit harga/stock
- [ ] Show update success
- [ ] (Optional) Show delete dan confirm

**2:15-2:45 - CRUD Operations (Orders)**
- [ ] Click "Pesanan" di sidebar
- [ ] Show orders list dengan status badges
- [ ] Highlight status colors (pending, proses, dikirim, selesai)
- [ ] Click "Tambah Pesanan"
- [ ] Fill customer info
- [ ] Add items ke order
- [ ] Calculate total
- [ ] Submit order
- [ ] Show order created

**2:45-3:15 - Reports & Export**
- [ ] Click "Laporan" di sidebar
- [ ] Show filter options (bulan, tahun, platform)
- [ ] Apply filter
- [ ] Show report data
- [ ] Click "Export PDF"
- [ ] Show PDF download success
- [ ] Show preview bahwa PDF generated correctly
- [ ] Click "Export Excel"
- [ ] Show Excel download success

**3:15-3:45 - Mobile Responsiveness**
- [ ] Open browser Developer Tools (F12)
- [ ] Toggle device toolbar untuk mobile view
- [ ] Show dashboard di mobile (hamburger icon visible)
- [ ] Click hamburger
- [ ] Show sidebar slide in
- [ ] Show responsiveness dari products/orders pages
- [ ] Close menu, navigate to lain page

**3:45-4:00 - Logout & Closing**
- [ ] Click menu → Logout
- [ ] Show redirect ke landing page
- [ ] (Optional) Thank you screen

---

## 📹 Alternative: Feature-Specific Videos

Jika ingin buat multiple short videos:

### Video 1: Authentication & Dashboard (2 min)
- Register
- Login
- Dashboard walkthrough

### Video 2: Product Management (1.5 min)
- View products
- Create product
- Edit product

### Video 3: Order Management (1.5 min)
- View orders
- Create order
- Update order status

### Video 4: Reports & Export (1.5 min)
- Filter reports
- Export PDF
- Export Excel

### Video 5: Mobile Responsiveness (1 min)
- Hamburger menu
- Responsive layout
- Mobile navigation

---

## 📸 Screenshot Organization

### Folder Structure
```
screenshots/
├── 1_landing_page.png
├── 2_login_page.png
├── 3_register_page.png
├── 4_dashboard_overview.png
├── 5_dashboard_pesanan_terbaru.png
├── 6_dashboard_produk_terlaris.png
├── 7_products_list.png
├── 8_products_create.png
├── 9_products_edit.png
├── 10_orders_list.png
├── 11_orders_create.png
├── 12_orders_edit.png
├── 13_reports_page.png
├── 14_export_pdf.png
├── 15_export_excel.png
├── 16_mobile_dashboard.png
├── 17_mobile_hamburger_closed.png
├── 18_mobile_hamburger_open.png
├── 19_mobile_products.png
├── 20_mobile_login.png
└── video_demo.mp4
```

---

## 📝 README Integration

Dalam README.md, tambahkan:

```markdown
## 📸 Screenshots

### Landing Page
![Landing Page](screenshots/1_landing_page.png)
*Public-facing landing page dengan hero section dan feature showcase*

### Authentication
![Login](screenshots/2_login_page.png)
*Secure login page dengan session management*

![Register](screenshots/3_register_page.png)
*User registration with validation*

### Dashboard
![Dashboard](screenshots/4_dashboard_overview.png)
*Main admin dashboard dengan statistics dan real-time data*

### Product Management
![Products](screenshots/7_products_list.png)
*Product list dengan CRUD operations*

### Order Management
![Orders](screenshots/10_orders_list.png)
*Order management dengan status tracking*

### Reports & Export
![Reports](screenshots/13_reports_page.png)
*Sales reports dengan filter dan export functionality*

### Mobile Responsive
![Mobile View](screenshots/16_mobile_dashboard.png)
*Responsive design dengan hamburger menu*

## 🎥 Video Demonstration

[Watch Full Demo Video](videos/AD_COLLECTION_DEMO.mp4)

Duration: 4 minutes
- 00:00 - Introduction
- 00:30 - Landing Page & Authentication
- 01:15 - Dashboard Overview
- 01:45 - Product Management
- 02:15 - Order Management
- 02:45 - Reports & Export
- 03:15 - Mobile Responsiveness
- 03:45 - Logout
```

---

## 🎬 Recording Tips

### Quality Tips
1. **Use full HD resolution** (1920×1080 minimum)
2. **Reduce zoom/scaling** untuk lebih jelas
3. **Close unnecessary tabs** untuk clean desktop
4. **Slow down actions** agar mudah diikuti
5. **Highlight important areas** dengan cursor

### Audio Tips (jika ada narration)
1. **Use external mic** untuk better quality
2. **Speak clearly** dan perlahan
3. **Remove background noise** dengan audio editor
4. **Add background music** untuk professional touch

### Editing Tips
1. **Trim unnecessary parts**
2. **Add title card** di awal
3. **Add captions** untuk important features
4. **Add transitions** antar section (subtle)
5. **Speed up boring parts** (loading, scrolling)

---

## 📤 Upload Video

### Recommended Platforms
1. **YouTube** - Free, besar kapasitas, embeddable
2. **Loom** - Free, quick sharing, automatic hosting
3. **Vimeo** - Professional, tapi berbayar
4. **Google Drive** - Free, shareable dengan link

### YouTube Upload Steps
1. Go to https://youtube.com
2. Click upload icon
3. Select video file
4. Fill title & description:
   ```
   Title: AD COLLECTION - Fashion E-Commerce Management System
   Description:
   Complete walkthrough of AD COLLECTION, a fashion 
   e-commerce management system for TikTok Shop & Shopee.
   
   Features demonstrated:
   - User authentication & registration
   - Dashboard with real-time statistics
   - Complete CRUD for products & orders
   - Sales reports with PDF/Excel export
   - Mobile responsive design
   - Multi-platform inventory management
   
   Project: UAS Pemrograman Web 1
   Student: Nazwa Khoerunnisa (23552011093)
   University: Universitas Teknologi Bandung
   ```
5. Set visibility to "Public" atau "Unlisted"
6. Publish
7. Copy share link untuk README

---

## ✅ Checklist Sebelum Submit

### Screenshots
- [ ] Minimal 15 screenshots (berbagai halaman)
- [ ] Screenshot mobile responsiveness
- [ ] Screenshot semua CRUD operations
- [ ] Screenshot export functionality
- [ ] Semua images clear dan readable
- [ ] Images organized dalam folder

### Video
- [ ] Video duration 3-5 minutes
- [ ] All features demonstrated
- [ ] Audio clear (jika ada)
- [ ] Video quality HD (720p minimum)
- [ ] Video hosted di platform shareable

### Documentation
- [ ] README.md updated dengan screenshots
- [ ] README.md include video link
- [ ] Links semua working
- [ ] File structure organized
- [ ] All required information included

---

**Last Updated:** January 24, 2026
**Status:** ✅ Complete Documentation Template

-- Database: adcollection
CREATE DATABASE IF NOT EXISTS adcollection;
USE adcollection;

-- Tabel users (untuk login dan register)
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    nomor_telepon VARCHAR(15),
    alamat TEXT,
    foto_profil VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel products (CRUD Produk)
CREATE TABLE IF NOT EXISTS products (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nama_produk VARCHAR(100) NOT NULL,
    sku VARCHAR(50) UNIQUE NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    deskripsi TEXT,
    harga_beli DECIMAL(10, 2) NOT NULL,
    harga_jual DECIMAL(10, 2) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    foto_produk VARCHAR(255),
    platform ENUM('tiktok', 'shopee', 'manual') DEFAULT 'manual',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel product_variations (untuk variasi produk seperti warna, ukuran)
CREATE TABLE IF NOT EXISTS product_variations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    product_id INT NOT NULL,
    nama_variasi VARCHAR(50) NOT NULL,
    nilai_variasi VARCHAR(50) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel orders (CRUD Pesanan)
CREATE TABLE IF NOT EXISTS orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nomor_pesanan VARCHAR(50) UNIQUE NOT NULL,
    user_id INT,
    nama_pembeli VARCHAR(100) NOT NULL,
    email_pembeli VARCHAR(100),
    nomor_telepon VARCHAR(15),
    alamat_pengiriman TEXT,
    platform ENUM('tiktok', 'shopee', 'manual') DEFAULT 'manual',
    status ENUM('pending', 'proses', 'dikirim', 'selesai', 'batal') DEFAULT 'pending',
    total DECIMAL(12, 2) NOT NULL,
    tanggal DATE NOT NULL,
    catatan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel order_items (detail item dalam pesanan)
CREATE TABLE IF NOT EXISTS order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    jumlah INT NOT NULL,
    harga_satuan DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(12, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel activity_logs (untuk tracking aktivitas)
CREATE TABLE IF NOT EXISTS activity_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    aksi VARCHAR(100),
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert data dummy untuk testing
INSERT INTO users (nama_lengkap, email, username, password, role) VALUES
('Administrator', 'admin@adcollection.com', 'admin', '$2y$10$Prlun718lJbUneCGag5HlO9i29HNvhnMbjjSoCLvSWbrANgLn5Ldu', 'admin');

-- Insert 6 produk blouse
INSERT INTO products (nama_produk, sku, kategori, deskripsi, harga_beli, harga_jual, stok, platform) VALUES
('Kanaya Blouse', 'KB001', 'Blouse', 'Kanaya Blouse berkualitas premium dengan bahan nyaman', 75000, 150000, 120, 'manual'),
('Alesya Blouse', 'AB001', 'Blouse', 'Alesya Blouse desain modern dan elegan', 75000, 150000, 120, 'manual'),
('Arini Blouse', 'AR001', 'Blouse', 'Arini Blouse dengan potongan yang sempurna', 75000, 150000, 120, 'manual'),
('Friska Blouse', 'FR001', 'Blouse', 'Friska Blouse dengan detail unik dan menarik', 75000, 150000, 120, 'manual'),
('Nadlyne Blouse', 'NA001', 'Blouse', 'Nadlyne Blouse untuk penampilan sempurna Anda', 75000, 150000, 120, 'manual'),
('Safana Blouse', 'SA001', 'Blouse', 'Safana Blouse dengan kualitas terbaik', 75000, 150000, 120, 'manual');

-- Insert variasi warna untuk setiap produk (6 warna x 6 produk = 36 variasi)
-- Kanaya Blouse (ID 1)
INSERT INTO product_variations (product_id, nama_variasi, nilai_variasi, stok) VALUES
(1, 'Warna', 'Hitam', 20),
(1, 'Warna', 'Denim', 20),
(1, 'Warna', 'Burgundy', 20),
(1, 'Warna', 'Olive', 20),
(1, 'Warna', 'Cream', 20),
(1, 'Warna', 'Mustard', 20);

-- Alesya Blouse (ID 2)
INSERT INTO product_variations (product_id, nama_variasi, nilai_variasi, stok) VALUES
(2, 'Warna', 'Hitam', 20),
(2, 'Warna', 'Denim', 20),
(2, 'Warna', 'Burgundy', 20),
(2, 'Warna', 'Olive', 20),
(2, 'Warna', 'Cream', 20),
(2, 'Warna', 'Mustard', 20);

-- Arini Blouse (ID 3)
INSERT INTO product_variations (product_id, nama_variasi, nilai_variasi, stok) VALUES
(3, 'Warna', 'Hitam', 20),
(3, 'Warna', 'Denim', 20),
(3, 'Warna', 'Burgundy', 20),
(3, 'Warna', 'Olive', 20),
(3, 'Warna', 'Cream', 20),
(3, 'Warna', 'Mustard', 20);

-- Friska Blouse (ID 4)
INSERT INTO product_variations (product_id, nama_variasi, nilai_variasi, stok) VALUES
(4, 'Warna', 'Hitam', 20),
(4, 'Warna', 'Denim', 20),
(4, 'Warna', 'Burgundy', 20),
(4, 'Warna', 'Olive', 20),
(4, 'Warna', 'Cream', 20),
(4, 'Warna', 'Mustard', 20);

-- Nadlyne Blouse (ID 5)
INSERT INTO product_variations (product_id, nama_variasi, nilai_variasi, stok) VALUES
(5, 'Warna', 'Hitam', 20),
(5, 'Warna', 'Denim', 20),
(5, 'Warna', 'Burgundy', 20),
(5, 'Warna', 'Olive', 20),
(5, 'Warna', 'Cream', 20),
(5, 'Warna', 'Mustard', 20);

-- Safana Blouse (ID 6)
INSERT INTO product_variations (product_id, nama_variasi, nilai_variasi, stok) VALUES
(6, 'Warna', 'Hitam', 20),
(6, 'Warna', 'Denim', 20),
(6, 'Warna', 'Burgundy', 20),
(6, 'Warna', 'Olive', 20),
(6, 'Warna', 'Cream', 20),
(6, 'Warna', 'Mustard', 20);

-- Insert data pesanan
INSERT INTO orders (nomor_pesanan, user_id, nama_pembeli, email_pembeli, nomor_telepon, alamat_pengiriman, platform, status, total, tanggal, catatan) VALUES
('PES001', 1, 'Budi Santoso', 'budi@email.com', '08123456789', 'Jalan Merdeka No.10, Jakarta', 'tiktok', 'selesai', 450000, '2026-01-15', 'Pengiriman JNE'),
('PES002', 1, 'Siti Nurhaliza', 'siti@email.com', '08987654321', 'Jalan Sultan No.5, Bandung', 'shopee', 'dikirim', 300000, '2026-01-18', 'Paket sedang'),
('PES003', 1, 'Ahmad Wijaya', 'ahmad@email.com', '08567890123', 'Jalan Sudirman No.20, Surabaya', 'tiktok', 'proses', 150000, '2026-01-20', 'Tunggu transfer'),
('PES004', 1, 'Rina Puspita', 'rina@email.com', '08456789012', 'Jalan Diponegoro No.15, Medan', 'shopee', 'pending', 300000, '2026-01-22', 'Baru order'),
('PES005', 1, 'Hendra Gunawan', 'hendra@email.com', '08345678901', 'Jalan Ahmad Yani No.8, Yogyakarta', 'manual', 'proses', 600000, '2026-01-21', 'Custom order'),
('PES006', 1, 'Linda Wijaya', 'linda@email.com', '08234567890', 'Jalan Gatot Subroto No.12, Semarang', 'tiktok', 'selesai', 450000, '2026-01-16', 'Sudah diterima'),
('PES007', 1, 'Dwi Prasetyo', 'dwi@email.com', '08123456780', 'Jalan Pemuda No.25, Malang', 'shopee', 'pending', 150000, '2026-01-23', 'Menunggu konfirmasi'),
('PES008', 1, 'Nadia Kusuma', 'nadia@email.com', '08987654320', 'Jalan Diponegoro No.30, Pontianak', 'manual', 'dikirim', 300000, '2026-01-19', 'Expedisi pilihan');

-- Insert order items
INSERT INTO order_items (order_id, product_id, jumlah, harga_satuan, subtotal) VALUES
-- PES001: 3x Kanaya Blouse Hitam
(1, 1, 3, 150000, 450000),

-- PES002: 2x Alesya Blouse Denim
(2, 2, 2, 150000, 300000),

-- PES003: 1x Arini Blouse Burgundy
(3, 3, 1, 150000, 150000),

-- PES004: 2x Friska Blouse Cream
(4, 4, 2, 150000, 300000),

-- PES005: 2x Nadlyne Blouse Olive + 2x Safana Blouse Hitam
(5, 5, 2, 150000, 300000),
(5, 6, 2, 150000, 300000),

-- PES006: 3x Kanaya Blouse Denim
(6, 1, 3, 150000, 450000),

-- PES007: 1x Alesya Blouse Mustard
(7, 2, 1, 150000, 150000),

-- PES008: 2x Arini Blouse Cream
(8, 3, 2, 150000, 300000);

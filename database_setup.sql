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

INSERT INTO products (nama_produk, sku, kategori, deskripsi, harga_beli, harga_jual, stok, platform) VALUES
('Hijab Viscose Polos', 'HV001', 'Hijab', 'Hijab viscose premium polos tersedia berbagai warna', 15000, 35000, 50, 'tiktok'),
('Hijab Motif Bunga', 'HM001', 'Hijab', 'Hijab dengan motif bunga yang indah dan modern', 18000, 42000, 35, 'shopee'),
('Gamis Katun Tebal', 'GK001', 'Gamis', 'Gamis katun tebal nyaman untuk dipakai sehari-hari', 35000, 85000, 20, 'tiktok'),
('Kerudung Anak', 'KA001', 'Hijab Anak', 'Kerudung untuk anak-anak dengan warna cerah', 12000, 28000, 45, 'manual');

INSERT INTO orders (nomor_pesanan, user_id, nama_pembeli, email_pembeli, nomor_telepon, alamat_pengiriman, platform, status, total, tanggal) VALUES
('PES001', 1, 'Budi Santoso', 'budi@email.com', '08123456789', 'Jalan Merdeka No.10, Jakarta', 'tiktok', 'pending', 210000, CURDATE()),
('PES002', 2, 'Siti Nurhaliza', 'siti@email.com', '08987654321', 'Jalan Sultan No.5, Bandung', 'shopee', 'proses', 127000, CURDATE());

INSERT INTO order_items (order_id, product_id, jumlah, harga_satuan, subtotal) VALUES
(1, 1, 3, 35000, 105000),
(1, 3, 1, 85000, 85000),
(2, 2, 2, 42000, 84000),
(2, 4, 1, 28000, 28000);

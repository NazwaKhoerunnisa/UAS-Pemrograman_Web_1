<?php
// landing.php - Landing Page utama sebelum login
session_start();

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AD COLLECTION - Fashion E-Commerce Management System</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-brown: #8B7355;
            --secondary-gold: #C9A97E;
            --cream: #FAF7F2;
            --light-cream: #F5EFE6;
            --dark-brown: #6B5744;
            --text-dark: #3E3E3E;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--cream);
            color: var(--text-dark);
            overflow-x: hidden;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            color: var(--primary-brown);
        }
        
        /* Navbar */
        .navbar {
            background: linear-gradient(135deg, #8B7355 0%, #6B5744 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 15px 30px;
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: #C9A97E !important;
            letter-spacing: 2px;
        }
        
        .navbar-brand small {
            font-size: 11px;
            color: rgba(255,255,255,0.8);
            display: block;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        
        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            margin-left: 15px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .nav-link:hover {
            color: #C9A97E !important;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, rgba(139, 115, 85, 0.7) 0%, rgba(107, 87, 68, 0.7) 100%), 
                        url('https://i.pinimg.com/1200x/9d/b3/99/9db399b3494428f3a047788414e139dc.jpg') center/cover no-repeat;
            color: white;
            padding: 100px 30px;
            text-align: center;
            min-height: 700px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 80%, rgba(201, 169, 126, 0.15) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(201, 169, 126, 0.1) 0%, transparent 50%);
            animation: gradientShift 15s ease infinite;
            pointer-events: none;
        }
        
        @keyframes gradientShift {
            0%, 100% {
                transform: translate(0, 0);
            }
            50% {
                transform: translate(20px, -20px);
            }
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            animation: fadeInUp 1s ease-out;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hero h1 {
            font-size: 48px;
            color: white;
            margin-bottom: 20px;
            font-weight: 700;
            animation: slideInDown 0.8s ease-out;
        }
        
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hero p {
            font-size: 18px;
            color: rgba(255,255,255,0.9);
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            animation: fadeIn 1s ease-out 0.3s both;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        .btn-hero {
            margin: 10px;
            padding: 12px 35px;
            font-weight: 600;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
            animation: slideUp 0.8s ease-out 0.6s both;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .btn-primary-hero {
            background: #C9A97E;
            color: var(--dark-brown);
        }
        
        .btn-primary-hero:hover {
            background: #F4E4C1;
            color: var(--dark-brown);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        
        .btn-secondary-hero {
            background: transparent;
            color: white;
            border: 2px solid white;
        }
        
        .btn-secondary-hero:hover {
            background: white;
            color: var(--primary-brown);
            transform: translateY(-2px);
        }
        
        /* Features Section */
        .features {
            padding: 80px 30px;
            background: white;
        }
        
        .features h2 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 60px;
        }
        
        .feature-card {
            text-align: center;
            padding: 30px;
            border-radius: 15px;
            background: var(--light-cream);
            margin-bottom: 30px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            animation: scaleIn 0.6s ease-out;
        }
        
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .feature-card:nth-child(1) {
            animation-delay: 0.1s;
        }
        
        .feature-card:nth-child(2) {
            animation-delay: 0.2s;
        }
        
        .feature-card:nth-child(3) {
            animation-delay: 0.3s;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(139, 115, 85, 0.15);
        }
        
        .feature-icon {
            font-size: 48px;
            color: var(--secondary-gold);
            margin-bottom: 20px;
            animation: pulse 2s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }
        
        .feature-card h4 {
            font-size: 20px;
            margin-bottom: 15px;
        }
        
        .feature-card p {
            color: #666;
            line-height: 1.6;
            font-size: 14px;
        }
        
        /* Stats Section */
        .stats {
            background: linear-gradient(135deg, #8B7355 0%, #6B5744 100%);
            color: white;
            padding: 60px 30px;
            text-align: center;
        }
        
        .stat-item {
            margin: 30px 0;
            animation: countUp 1s ease-out;
        }
        
        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .stat-number {
            font-family: 'Playfair Display', serif;
            font-size: 48px;
            font-weight: 700;
            color: #C9A97E;
            animation: pulse 2s ease-in-out infinite;
        }
        
        .stat-label {
            font-size: 16px;
            color: rgba(255,255,255,0.9);
        }
        
        /* CTA Section */
        .cta {
            background: linear-gradient(135deg, #C9A97E 0%, #F4E4C1 100%);
            padding: 60px 30px;
            text-align: center;
            border-radius: 15px;
            margin: 60px 30px;
            animation: slideInLeft 0.8s ease-out;
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .cta h2 {
            color: var(--dark-brown);
            margin-bottom: 20px;
        }
        
        .cta p {
            color: var(--dark-brown);
            font-size: 16px;
            margin-bottom: 30px;
        }
        
        .btn-cta {
            background: var(--primary-brown);
            color: white;
            padding: 12px 40px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        .btn-cta:hover {
            background: var(--dark-brown);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        
        /* Footer */
        .footer {
            background: var(--primary-brown);
            color: white;
            padding: 30px;
            text-align: center;
            font-size: 13px;
        }
        
        .footer a {
            color: #C9A97E;
            text-decoration: none;
        }
        
        .footer a:hover {
            text-decoration: underline;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 10px 15px;
            }
            
            .navbar-brand {
                font-size: 18px;
            }
            
            .nav-link {
                margin-left: 0;
                padding: 10px 0 !important;
                font-size: 14px;
            }
            
            .hero {
                padding: 50px 20px;
                min-height: auto;
            }
                        .hero {
                min-height: 500px;
                padding: 60px 20px;
                background: linear-gradient(135deg, rgba(139, 115, 85, 0.65) 0%, rgba(107, 87, 68, 0.65) 100%), 
                            url('https://i.pinimg.com/1200x/9d/b3/99/9db399b3494428f3a047788414e139dc.jpg') center/cover no-repeat;
            }
                        .hero h1 {
                font-size: 28px;
                margin-bottom: 15px;
            }
            
            .hero p {
                font-size: 14px;
                margin-bottom: 20px;
            }
            
            .btn-hero {
                padding: 10px 25px;
                font-size: 14px;
                margin: 5px;
            }
            
            .features {
                padding: 50px 20px;
            }
            
            .features h2 {
                font-size: 24px;
                margin-bottom: 40px;
            }
            
            .feature-card {
                padding: 20px;
                margin-bottom: 20px;
            }
            
            .feature-icon {
                font-size: 36px;
                margin-bottom: 15px;
            }
            
            .feature-card h4 {
                font-size: 16px;
            }
            
            .feature-card p {
                font-size: 12px;
            }
            
            .stats {
                padding: 40px 20px;
            }
            
            .stat-number {
                font-size: 32px;
            }
            
            .stat-label {
                font-size: 13px;
            }
            
            .cta {
                margin: 40px 20px;
                padding: 40px 20px;
                border-radius: 10px;
            }
            
            .cta h2 {
                font-size: 20px;
            }
            
            .cta p {
                font-size: 13px;
            }
        }
        
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 16px;
            }
            
            .hero h1 {
                font-size: 22px;
            }
            
            .hero p {
                font-size: 12px;
            }
            
            .btn-hero {
                padding: 8px 20px;
                font-size: 12px;
                display: block;
                margin: 8px auto;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="landing.php">
                AD COLLECTION
                <small>Fashion Management</small>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#fitur">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>AD COLLECTION</h1>
            <p>Sistem Manajemen Fashion All-in-One untuk TikTok Shop & Shopee</p>
            <p style="font-size: 14px; margin-bottom: 40px;">Kelola Produk, Pesanan, dan Laporan Penjualan dengan Mudah</p>
            <a href="login.php" class="btn-hero btn-primary-hero">
                <i class="bi bi-box-arrow-in-right"></i> Mulai Login
            </a>
            <a href="#fitur" class="btn-hero btn-secondary-hero">
                <i class="bi bi-info-circle"></i> Pelajari Lebih Lanjut
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="fitur">
        <div class="container">
            <h2><i class="bi bi-star-fill"></i> Fitur Unggulan</h2>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <h4>Dashboard Terpadu</h4>
                        <p>Pantau semua statistik penjualan, pesanan pending, dan stok produk dalam satu halaman.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h4>Manajemen Produk</h4>
                        <p>Tambah, edit, dan hapus produk dengan mudah. Kelola stok, harga, kategori, dan foto produk.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-cart3"></i>
                        </div>
                        <h4>Manajemen Pesanan</h4>
                        <p>Kelola semua pesanan dari berbagai platform dalam satu sistem terpusat.</p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <h4>Laporan & Analisis</h4>
                        <p>Buat laporan penjualan, filter berdasarkan platform dan tanggal dengan mudah.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-file-earmark-pdf"></i>
                        </div>
                        <h4>Export PDF & Excel</h4>
                        <p>Ekspor laporan ke PDF atau Excel untuk keperluan dokumentasi dan analisis lebih lanjut.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h4>Keamanan Terjamin</h4>
                        <p>Proteksi data dengan password hashing, SQL injection prevention, dan session security.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">6</div>
                        <div class="stat-label">Produk Blouse</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">36</div>
                        <div class="stat-label">Variasi Warna</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Responsif</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Akses Online</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <div class="cta">
        <h2>Siap Mengelola Bisnis Fashion Anda?</h2>
        <p>Daftar sekarang dan mulai kelola produk & pesanan dengan lebih efisien</p>
        <a href="login.php" class="btn-cta">
            <i class="bi bi-box-arrow-in-right"></i> Login Sekarang
        </a>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; Copyright by Nazwa Khoerunnisa (23552011093) - TIF RP 23 CNS C</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

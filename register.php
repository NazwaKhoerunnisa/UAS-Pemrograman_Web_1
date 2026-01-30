<?php
// register.php - Halaman registrasi
session_start();

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

require_once 'config/database.php';

$page_title = "Register - AD COLLECTION";

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = escape($_POST['nama_lengkap'] ?? '');
    $email = escape($_POST['email'] ?? '');
    $username = escape($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $nomor_telepon = escape($_POST['nomor_telepon'] ?? '');
    $alamat = escape($_POST['alamat'] ?? '');
    
    // Validasi
    if (empty($nama_lengkap) || empty($email) || empty($username) || empty($password)) {
        $error = 'Nama, Email, Username, dan Password harus diisi!';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter!';
    } elseif ($password !== $confirm_password) {
        $error = 'Password dan konfirmasi password tidak cocok!';
    } else {
        // Cek apakah email atau username sudah terdaftar
        $check_query = "SELECT * FROM users WHERE email = '$email' OR username = '$username'";
        $check_result = mysqli_query($conn, $check_query);
        
        if (mysqli_num_rows($check_result) > 0) {
            $error = 'Email atau Username sudah terdaftar!';
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            
            // Insert user baru
            $insert_query = "INSERT INTO users (nama_lengkap, email, username, password, nomor_telepon, alamat) 
                            VALUES ('$nama_lengkap', '$email', '$username', '$hashed_password', '$nomor_telepon', '$alamat')";
            
            if (mysqli_query($conn, $insert_query)) {
                $success = 'Registrasi berhasil! Silakan login dengan akun Anda.';
                // Clear form
                $nama_lengkap = $email = $username = $nomor_telepon = $alamat = '';
            } else {
                $error = 'Gagal mendaftar: ' . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - AD COLLECTION</title>
    
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
            --dark-brown: #6B5744;
            --text-dark: #3E3E3E;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #8B7355 0%, #6B5744 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        
        .register-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 500px;
            padding: 40px;
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .register-header h2 {
            font-family: 'Playfair Display', serif;
            color: var(--primary-brown);
            font-size: 32px;
            margin-bottom: 5px;
        }
        
        .register-header p {
            color: var(--secondary-gold);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .form-control {
            border: 2px solid #e0e0e0;
            padding: 12px;
            font-size: 14px;
            margin-bottom: 15px;
            border-radius: 6px;
        }
        
        .form-control:focus {
            border-color: var(--secondary-gold);
            box-shadow: 0 0 0 0.2rem rgba(201, 169, 126, 0.25);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--primary-brown);
            margin-bottom: 8px;
            font-size: 13px;
        }
        
        .btn-register {
            background: linear-gradient(135deg, #8B7355 0%, #6B5744 100%);
            color: white;
            padding: 12px;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            width: 100%;
            margin-top: 20px;
        }
        
        .btn-register:hover {
            background: linear-gradient(135deg, #6B5744 0%, #4A3F36 100%);
            color: white;
        }
        
        .register-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        
        .register-footer a {
            color: var(--secondary-gold);
            text-decoration: none;
            font-weight: 600;
        }
        
        .register-footer a:hover {
            text-decoration: underline;
        }
        
        .alert {
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        /* Responsive Register */
        @media (max-width: 576px) {
            body {
                padding: 15px;
                min-height: auto;
            }
            
            .register-container {
                max-width: 100%;
                padding: 25px 20px;
                margin: 0;
                border-radius: 12px;
                box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            }
            
            .register-header {
                margin-bottom: 25px;
            }
            
            .register-header h2 {
                font-size: 28px;
                margin-bottom: 8px;
            }
            
            .register-header p {
                font-size: 13px;
            }
            
            .form-label {
                font-size: 13px;
                margin-bottom: 6px;
            }
            
            .form-control {
                padding: 12px;
                font-size: 14px;
                margin-bottom: 12px;
                border-radius: 6px;
            }
            
            .btn-register {
                padding: 12px;
                font-size: 15px;
                margin-top: 10px;
                border-radius: 6px;
            }
            
            .register-footer {
                font-size: 13px;
                margin-top: 18px;
            }
            
            .alert {
                padding: 12px;
                font-size: 13px;
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-header">
            <h2>AD COLLECTION</h2>
            <p>Daftar Akun Baru</p>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle"></i> <?= $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($success)): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle"></i> <?= $success; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <a href="login.php" class="btn btn-sm btn-primary mt-2">Ke Halaman Login</a>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $nama_lengkap ?? ''; ?>" placeholder="Masukkan nama lengkap" required>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $email ?? ''; ?>" placeholder="Masukkan email" required>
            </div>
            
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $username ?? ''; ?>" placeholder="Masukkan username" required>
            </div>
            
            <div class="mb-3">
                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                <input type="tel" class="form-control" id="nomor_telepon" name="nomor_telepon" value="<?= $nomor_telepon ?? ''; ?>" placeholder="Masukkan nomor telepon">
            </div>
            
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat"><?= $alamat ?? ''; ?></textarea>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password (minimal 6 karakter)" required>
            </div>
            
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Konfirmasi password" required>
            </div>
            
            <button type="submit" class="btn btn-register">
                <i class="bi bi-person-plus"></i> Daftar
            </button>
        </form>
        
        <div class="register-footer">
            Sudah punya akun? <a href="login.php">Login di sini</a>

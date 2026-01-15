<?php
// login.php - Halaman login
session_start();

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

require_once 'config/database.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = escape($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Username dan password harus diisi!';
    } else {
        // Query cari user berdasarkan username atau email
        $query = "SELECT * FROM users WHERE username = '$username' OR email = '$username'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            
            // Verifikasi password (menggunakan password_verify untuk hash password)
            if (password_verify($password, $user['password'])) {
                // Set session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                
                header("Location: dashboard.php");
                exit();
            } else {
                $error = 'Username atau password salah!';
            }
        } else {
            $error = 'Username atau password salah!';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AD COLLECTION</title>
    
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
        }
        
        .login-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            padding: 40px;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h2 {
            font-family: 'Playfair Display', serif;
            color: var(--primary-brown);
            font-size: 32px;
            margin-bottom: 5px;
        }
        
        .login-header p {
            color: var(--secondary-gold);
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .form-control {
            border: 2px solid #e0e0e0;
            padding: 12px;
            font-size: 14px;
        }
        
        .form-control:focus {
            border-color: var(--secondary-gold);
            box-shadow: 0 0 0 0.2rem rgba(201, 169, 126, 0.25);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #8B7355 0%, #6B5744 100%);
            color: white;
            padding: 12px;
            font-weight: 600;
            border: none;
            border-radius: 5px;
            width: 100%;
            margin-top: 20px;
        }
        
        .btn-login:hover {
            background: linear-gradient(135deg, #6B5744 0%, #4A3F36 100%);
            color: white;
        }
        
        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        
        .login-footer a {
            color: var(--secondary-gold);
            text-decoration: none;
            font-weight: 600;
        }
        
        .login-footer a:hover {
            text-decoration: underline;
        }
        
        .alert {
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>AD COLLECTION</h2>
            <p>Fashion Management System</p>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-triangle"></i> <?= $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username atau Email</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username atau email" required autofocus>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
            </div>
            
            <button type="submit" class="btn btn-login">
                <i class="bi bi-box-arrow-in-right"></i> Masuk
            </button>
        </form>
        
        <div class="login-footer">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

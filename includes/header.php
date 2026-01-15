<?php
// includes/header.php
// Cek session - komen dulu untuk testing
// if (!isset($_SESSION['user_id'])) {
//     header("Location: ../index.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'AD COLLECTION' ?></title>
    
    <!-- Bootstrap 5 CSS dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts - Playfair Display & Montserrat (seperti Hijab Chic) -->
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
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            color: var(--primary-brown);
        }
        
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #8B7355 0%, #6B5744 100%);
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
        }
        
        .sidebar .brand {
            padding: 25px;
            text-align: center;
            border-bottom: 2px solid rgba(255,255,255,0.1);
        }
        
        .sidebar .brand h4 {
            font-family: 'Playfair Display', serif;
            color: #C9A97E;
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 5px;
            letter-spacing: 2px;
        }
        
        .sidebar .brand small {
            color: rgba(255,255,255,0.7);
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .sidebar .user-info {
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid rgba(255,255,255,0.1);
        }
        
        .sidebar .user-avatar {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #C9A97E 0%, #F4E4C1 100%);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--dark-brown);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        
        .sidebar .user-name {
            color: white;
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 3px;
        }
        
        .sidebar .user-role {
            color: #C9A97E;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.85);
            padding: 14px 25px;
            margin: 8px 15px;
            border-radius: 12px;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 14px;
        }
        
        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #C9A97E 0%, #F4E4C1 100%);
            color: var(--dark-brown);
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(201, 169, 126, 0.3);
        }
        
        .sidebar .nav-link i {
            margin-right: 12px;
            font-size: 18px;
        }
        
        .main-content {
            background-color: var(--cream);
            min-height: 100vh;
            padding: 30px;
        }
        
        .card {
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border-radius: 15px;
            background: white;
        }
        
        .card-header {
            background: linear-gradient(135deg, #8B7355 0%, #C9A97E 100%);
            color: white;
            border: none;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px 25px;
            font-family: 'Playfair Display', serif;
        }
        
        .page-header {
            background: linear-gradient(135deg, #8B7355 0%, #C9A97E 100%);
            color: white;
            padding: 25px 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(139, 115, 85, 0.3);
        }
        
        .page-header h2 {
            color: white;
            font-weight: 700;
            margin-bottom: 5px;
        }
        
        .page-header p {
            color: rgba(255,255,255,0.9);
            margin: 0;
        }
        
        .stat-card {
            border-radius: 15px;
            padding: 25px;
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #8B7355 0%, #C9A97E 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #6B5744 0%, #A88B6A 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(139, 115, 85, 0.3);
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #C9A97E 0%, #F4E4C1 100%);
            border: none;
            color: var(--dark-brown);
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 10px;
        }
        
        .btn-warning:hover {
            background: linear-gradient(135deg, #A88B6A 0%, #C9A97E 100%);
            color: white;
        }
        
        .btn-secondary {
            background: #6c757d;
            border: none;
            color: white;
            padding: 12px 28px;
            border-radius: 10px;
        }
        
        .btn-danger {
            background: #dc3545;
            border: none;
            border-radius: 10px;
        }
        
        .table {
            background: white;
        }
        
        .table thead {
            background: linear-gradient(135deg, #8B7355 0%, #C9A97E 100%);
            color: white;
        }
        
        .table thead th {
            border: none;
            padding: 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }
        
        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }
        
        .table tbody tr:hover {
            background-color: var(--light-cream);
        }
        
        .badge {
            padding: 8px 15px;
            border-radius: 20px;
            font-weight: 500;
            font-size: 12px;
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
        }
        
        .form-control, .form-select {
            border: 2px solid #E8DCC8;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 14px;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-gold);
            box-shadow: 0 0 0 0.2rem rgba(201, 169, 126, 0.25);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--primary-brown);
            margin-bottom: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body>
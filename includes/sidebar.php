<?php
// includes/sidebar.php
$current_page = basename($_SERVER['PHP_SELF']);
$current_folder = basename(dirname($_SERVER['PHP_SELF']));

// Default values untuk testing (nanti akan diganti dengan session)
$user_name = $_SESSION['nama_lengkap'] ?? 'Administrator';
$user_role = $_SESSION['role'] ?? 'admin';
?>
<div class="col-md-2 sidebar p-0">
    <!-- Brand -->
    <div class="brand">
        <h4>AD COLLECTION</h4>
        <small>Admin Dashboard</small>
    </div>
    
    <!-- User Info -->
    <div class="user-info">
        <div class="user-avatar">
            <?= strtoupper(substr($user_name, 0, 2)) ?>
        </div>
        <div class="user-name"><?= $user_name ?></div>
        <div class="user-role"><?= ucfirst($user_role) ?></div>
    </div>

    <!-- Navigation Menu -->
    <nav class="nav flex-column p-3">
        <?php 
        // Tentukan path berdasarkan folder saat ini
        $base_path = ($current_folder == 'includes') ? '../' : (in_array($current_folder, ['products', 'orders', 'reports']) ? '../' : '');
        ?>
        <a href="<?= $base_path ?>dashboard.php" class="nav-link <?= $current_page == 'dashboard.php' ? 'active' : '' ?>">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="<?= $base_path ?>products/index.php" class="nav-link <?= $current_folder == 'products' ? 'active' : '' ?>">
            <i class="bi bi-box-seam"></i> Produk
        </a>
        <a href="<?= $base_path ?>orders/index.php" class="nav-link <?= $current_folder == 'orders' ? 'active' : '' ?>">
            <i class="bi bi-cart3"></i> Pesanan
        </a>
        <a href="<?= $base_path ?>reports/index.php" class="nav-link <?= $current_folder == 'reports' ? 'active' : '' ?>">
            <i class="bi bi-file-earmark-text"></i> Laporan
        </a>
        
        <hr class="border-light my-3 opacity-25">
        
        <a href="<?= $base_path ?>logout.php" class="nav-link text-danger" 
           onclick="return confirm('Yakin ingin logout?')">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </nav>
</div>
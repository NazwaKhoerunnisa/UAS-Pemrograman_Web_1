<?php
// includes/sidebar.php
$current_page = basename($_SERVER['PHP_SELF']);
$current_folder = basename(dirname($_SERVER['PHP_SELF']));

// Default values untuk testing
$user_name = $_SESSION['nama_lengkap'] ?? 'Administrator';
$user_role = $_SESSION['role'] ?? 'admin';
?>

<!-- Sidebar -->
<div class="col-12 col-md-2 sidebar p-0" id="sidebar">
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
            <div>
                <div class="user-name"><?= $user_name ?></div>
                <div class="user-role"><?= ucfirst($user_role) ?></div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="nav flex-column p-3">
            <?php 
            // Tentukan path berdasarkan folder saat ini
            $base_path = ($current_folder == 'includes') ? '../' : (in_array($current_folder, ['products', 'orders', 'reports']) ? '../' : '');
            ?>
            <a href="<?= $base_path ?>dashboard.php" class="nav-link <?= $current_page == 'dashboard.php' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> <span class="nav-text">Dashboard</span>
            </a>
            <a href="<?= $base_path ?>products/index.php" class="nav-link <?= $current_folder == 'products' ? 'active' : '' ?>">
                <i class="bi bi-box-seam"></i> <span class="nav-text">Produk</span>
            </a>
            <a href="<?= $base_path ?>orders/index.php" class="nav-link <?= $current_folder == 'orders' ? 'active' : '' ?>">
                <i class="bi bi-cart3"></i> <span class="nav-text">Pesanan</span>
            </a>
            <a href="<?= $base_path ?>reports/index.php" class="nav-link <?= $current_folder == 'reports' ? 'active' : '' ?>">
                <i class="bi bi-file-earmark-text"></i> <span class="nav-text">Laporan</span>
            </a>
            
            <hr class="border-light my-3 opacity-25">
            
            <a href="<?= $base_path ?>logout.php" class="nav-link text-danger" 
               onclick="return confirm('Yakin ingin logout?')">
                <i class="bi bi-box-arrow-right"></i> <span class="nav-text">Logout</span>
            </a>
        </nav>
    </div>

<script>
// Sidebar Toggle Function
(function() {
    // Wait for DOM to be ready
    function init() {
        const toggleBtn = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        
        if (!toggleBtn || !sidebar || !overlay) {
            console.error('Sidebar elements not found');
            return;
        }
        
        // Ensure sidebar and overlay are not active on load
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        
        // Toggle button - buka/tutup sidebar
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('Toggle clicked');
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });
        
        // Click overlay untuk tutup
        overlay.addEventListener('click', function() {
            closeSidebar();
        });
        
        // Close sidebar when clicking nav links
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                closeSidebar();
            });
        });
        
        // Close sidebar on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeSidebar();
            }
        });
        
        // Helper function to close sidebar
        function closeSidebar() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
        
        // Close sidebar when pressing Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeSidebar();
            }
        });
    }
    
    // Run when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
</script>